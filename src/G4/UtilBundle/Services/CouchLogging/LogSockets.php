<?php
namespace G4\UtilBundle\Services\CouchLogging;
/**
 * Created by JetBrains PhpStorm.
 * User: dev
 * Date: 5/3/12
 * Time: 11:57 AM
 * To change this template use File | Settings | File Templates.
 */
class LogSockets extends CouchLogging implements CouchLoggingInterface
{

    /**
     * @param string $data   data to write in the couch server
     * @param bool   $needId weather we need the response of the couch server
     *
     * @return response|null
     */
    public function writeLog($data,$needId = false)
    {
        $headers = array("Content-type: application/json");

        $response = $this->sendHttpData($this->serverUrl, "POST", $headers, "", $data, $needId);

        if ($needId) {
            return self::getIdFromHttpResponse($response);
        } else {
            return null;
        }
    }

    /**
     * @return bool
     */
    public function createDatabase()
    {
        $auth   = $this->container->getParameter('couch_user') .":".$this->container->getParameter('couch_pass');

        $response = $this->sendHttpData($this->serverUrl, "PUT", array("Content-type: application/json"), $auth, "{;}", true);
        $responseData = self::getDataFromHttpResponse($response);
        $responseArr = json_decode($responseData, true);

        if (isset($responseArr['error'])) {
            switch($responseArr['error'])
            {
                case "unauthorized": throw new \Exception("You are not authorised to create couch database @ " . $this->serverUrl . " using auth: " .$auth);
            }
        }

        //now we create the view for the timeline
        $response = $this->sendHttpData($this->serverUrl, "PUT", array("Content-type: application/json"), $auth, $this->viewTimelineJson, true, "_design/manifest_id");

    }


    /**
     * @param string  $url          url to post into
     * @param string  $method       GET|POST|PUT|DELETE
     * @param array   $headers      headers to pass
     * @param array   $auth         authentication
     * @param string  $data         data to post
     * @param boolean $needResponse set true if we need to get the response
     * @param string  $afterPath    path after the url
     *
     * @return mixed
     */
    public function sendHttpData($url, $method, $headers, $auth, $data, $needResponse=false, $afterPath = "")
    {
        $errno = 0;
        $errstr = "";
        $urlArray = parse_url($url);

        if ($urlArray===false) {
            throw new \Exception(sprintf("Malformed Couch url %s", $url));
        }

        $eoln = "\r\n";
        $dataToWrite = "";

        $dataToWrite .= $method . " ".$urlArray['path'] . $afterPath ." HTTP/1.1" .$eoln;
        $dataToWrite .= "Host: ".$urlArray['host'] .$eoln;
        if ($auth!="") {
            $dataToWrite .= "Authorization: Basic " . base64_encode($auth) .  $eoln;
        }
        foreach ($headers as $header) {
            $dataToWrite .= $header .$eoln;
        }
        $dataToWrite .= "Content-Length: ".strlen($data) .$eoln.$eoln;
        $dataToWrite .= $data .$eoln.$eoln;

        $fp = fsockopen($urlArray['host'], $urlArray['port'], $errno, $errstr, 5);
        if (!$fp) {
            throw new \Exception(sprintf("Cannot create socket", $url));
        }

        //echo $dataToWrite;
        fwrite($fp, $dataToWrite);


        $response = null;
        if ($needResponse) {
            $response = "";
//            while (!feof($fp)) {
//                $buf = fgets($fp, 128);
//                $response .= $buf;
//                file_put_contents("/tmp/a.txt", $buf, FILE_APPEND);
//            }

            //read the headers first
            $lineContent = '';
            $body = '';
            $rawHeaders = '';

            // Remove leading empty lines, and read the first line
            while ((($line = fgets($fp)) !== false ) && (($lineContent = rtrim($line)) === '' ));

            do {
                $rawHeaders .= $lineContent . "\r\n";

                // Extract header values
                if (preg_match('(^HTTP/(?P<version>\d+\.\d+)\s+(?P<status>\d+))S', $lineContent, $match)) {
                    $headers['version'] = $match['version'];
                    $headers['status']  = (int) $match['status'];
                } else {
                    @list($key, $value) = explode(':', $lineContent, 2);
                    $headers[strtolower($key)] = ltrim($value);
                }
            } while ((($line = fgets($fp)) !== false) && (($lineContent = rtrim($line)) !== '' ));

            //now the body, till the content-length end
            $bytesToRead = (int) ( isset( $headers['content-length'] ) ? $headers['content-length'] : 0 );

            // Read body only as specified by chunk sizes, everything else
            // are just footnotes, which are not relevant for us.
            while ($bytesToRead > 0) {
                $body .= $read = fgets($fp, $bytesToRead + 1);
                $bytesToRead -= strlen($read);
            }

            $response = $rawHeaders . $body;
        }

        fclose($fp);

        return $response;
    }

    /**
     * parses couch http response and return the ID of the new entry
     *
     * @param string $response
     *
     * @return string
     */
    public static function getIdFromHttpResponse($response)
    {
        $searchKey = "Location: ";
        $searchPos = strpos($response, $searchKey);
        $retUrl = substr($response, $searchPos + strlen($searchKey), strpos($response, "\r", $searchPos)-$searchPos-strlen($searchKey));

        $newId = substr($retUrl, strrpos($retUrl, "/")+1);

        return $newId;
    }

    /**
     * fetches only data from the http response
     *
     * @param string $response
     *
     * @return string $data
     */
    public static function getDataFromHttpResponse($response)
    {
        $eoln = "\r\n";

        $dataPos = strpos($response, $eoln.$eoln);

        return substr($response, $dataPos+4);
    }


}
