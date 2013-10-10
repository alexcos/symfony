<?php
namespace G4\UtilBundle\Services\CouchLogging;
/**
 * Created by JetBrains PhpStorm.
 * User: dev
 * Date: 5/3/12
 * Time: 11:56 AM
 * To change this template use File | Settings | File Templates.
 */
class LogCurl extends CouchLogging implements CouchLoggingInterface
{

    private static $masterHandle = null;

    /**
     * @param string $data   data to write in the couch server
     * @param bool   $needId weather we need the response of the couch server
     *
     * @return response|null
     */
    public function writeLog($data,$needId = false)
    {
        $headers = array("Content-type: application/json");

        $response = $this->sendCurlData($this->serverUrl, "POST", $headers, "", $data, $needId);

        if ($needId) {
            $responseArr = json_decode($response, true);

            return $responseArr['id'];
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

        $response = $this->sendCurlData($this->serverUrl, "PUT", array("Content-type: application/json"), $auth, "{;}", true);
        $responseArr = json_decode($response, true);

        if (isset($responseArr['error'])) {
            switch($responseArr['error'])
            {
                case "unauthorized": throw new \Exception("You are not authorised to create couch database @ " . $this->serverUrl . " using auth: " .$auth);
            }
        }

        //now we create the view for the timeline
        $response = $this->sendCurlData($this->serverUrl, "PUT", array("Content-type: application/json"), $auth, $this->viewTimelineJson, true, "_design/manifest_id");

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
    public function sendCurlData($url, $method, $headers, $auth, $data, $needResponse=false, $afterPath = "")
    {
        $ch = curl_init($url . $afterPath);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if (strlen($auth)>0) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $auth);
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        if (!self::$masterHandle) {
            self::$masterHandle = curl_multi_init();
        }
        curl_multi_add_handle(self::$masterHandle, $ch);
        $active = null;
        do {
            $mrc = curl_multi_exec(self::$masterHandle, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            $mrc = curl_multi_exec(self::$masterHandle, $active);
        }

        $response = null;
        if ($needResponse) {
            $response = curl_multi_getcontent($ch);
        }

        curl_multi_remove_handle(self::$masterHandle, $ch);

        //echo $response;

        return $response;
    }
}
