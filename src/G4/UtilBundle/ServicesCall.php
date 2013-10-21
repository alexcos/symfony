<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle
 */

namespace G4\UtilBundle;

use G4\UtilBundle\Exception\NoServicesToExecuteException;
use G4\UtilBundle\Exception\ServiceNotExecutedException;

/**
 * ServicesCall
 */
class ServicesCall
{

    private $_curlDebug = false;
    private $_requestURL = false;
    private $_lastJSON   = null;
    public $error;
    public $cookies = '';
    /**
     * @var array $services
     */
    private $services;

    /**
     * @var array $results
     */
    private $results;

    /**
     * @var array $errors
     */
    private $errors;

    /**
     * @var array $infos
     */
    private $infos;

    /**
     * __construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $error["set"]=false;
        $error["message"]="";

        $this->services = array();
        $this->results = array();
        $this->errors = array();
        $this->infos = array();
    }

    /**
     * Close handles if they haven't been closed already
     */
    public function __destruct()
    {
        if (! count($this->services)) {
            return;
        }

        foreach ($this->services as $ch) {
            curl_close($ch);
        }
    }

    /**
     * setRequestURL
     *
     * @param string $url url
     *
     * @access public
     * @return void
     */
    public function setRequestURL($url)
    {
        $this->_requestURL = $url;
    }

    /**
     * getRequestURL
     *
     * @access public
     * @return string
     */
    public function getRequestURL()
    {
        return $this->_requestURL;
    }

    /**
     * Enable debug mode
     *
     * @access public
     * @return void
     */
    public function enableDebug()
    {
        $this->_curlDebug = true;
    }

    /**
     * Disable debugging
     *
     * @access public
     * @return void
     */
    public function disableDebug()
    {
        $this->_curlDebug = false;
    }

    /**
     * Generate a key to be used as index in the $this->services collection from given $url
     *
     * @param string $url the url to be used
     *
     * @return string
     */
    public function prepareKey($url)
    {
        return md5($url);
    }

    /**
     * Add to the execution pool a service initialized with the given parameters.
     * The service will be accessed using GET method.
     *
     * @param string  $url     The request URL
     * @param integer $timeout Number of seconds to wait for a response
     * @param array   $headers List of request header strings
     * @param string  $key     The key to identify the service being executed
     *
     * @return void
     *
     * @access public
     * @todo abstract parameters list into an object, possibly one already in Symfony2
     * @todo add parameters validation (ex. $url must be a valid URL)
     * @todo prettify $content passing to the service
     */
    public function addGet($url, $timeout = 5, array $headers = array(), $key = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_VERBOSE, false); // @todo use $this->_curlDebug instead
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookies);

        if (is_null($key)) {
            $key = $this->prepareKey($url);
        }

        $this->services[$key] = $ch;
    }

    /**
     * Add to the execution pool a service initialized with the given parameters.
     * The service will be accessed using POST method.
     *
     * @param string  $url     The request URL
     * @param integer $timeout Number of seconds to wait for a response
     * @param array   $headers List of request header strings
     * @param string  $content The request body
     * @param string  $key     The key to identify the service being executed
     *
     * @return void
     *
     * @access public
     * @todo abstract parameters list into an object, possibly one already in Symfony2
     * @todo add parameters validation (ex. $url must be a valid URL)
     */
    public function addPost($url, $timeout = 5, array $headers = array(), $content = '', $key = null)
    {
        if (is_array($content)) {
            $content = $this->queryStringEncode($content);
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_VERBOSE, false); // @todo use $this->_curlDebug instead
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookies);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_POST, 1);

        if (is_null($key)) {
            $key = $this->prepareKey($url);
        }

        $this->services[$key] = $ch;
    }

    /**
     * Encodes the given data into a query string format
     * @param array $data - array of string elements to be encoded
     *
     * @return string - encoded request
     */
    private function queryStringEncode($data)
    {
            $req = "";
            foreach ($data as $key => $value) {
                    $req .= $key . '=' . urlencode(stripslashes($value)) . '&';
            }
            // Cut the last '&'
            $req=substr($req, 0, strlen($req)-1);

            return $req;
    }

    /**
     * Add to the execution pool a service initialized with the given parameters.
     * The service will be accessed using PUT method.
     *
     * @param string  $url     The request URL
     * @param integer $timeout Number of seconds to wait for a response
     * @param array   $headers List of request header strings
     * @param string  $content The request body
     * @param string  $key     The key to identify the service being executed
     *
     * @return void
     *
     * @access public
     * @todo abstract parameters list into an object, possibly one already in Symfony2
     * @todo add parameters validation (ex. $url must be a valid URL)
     */
    public function addPut($url, $timeout = 5, array $headers = array(), $content = '', $key = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        //curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_VERBOSE, false); // @todo use $this->_curlDebug instead
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookies);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        if (is_null($key)) {
            $key = $this->prepareKey($url);
        }

        $this->services[$key] = $ch;
    }

    /**
     * Add to the execution pool a service initialized with the given parameters.
     * The service will be accessed using POST method.
     *
     * @param string  $url     The request URL
     * @param integer $timeout Number of seconds to wait for a response
     * @param array   $headers List of request header strings
     * @param string  $key     The key to identify the service being executed
     *
     * @return void
     *
     * @access public
     * @todo abstract parameters list into an object, possibly one already in Symfony2
     * @todo add parameters validation (ex. $url must be a valid URL)
     */
    public function addDelete($url, $timeout = 5, array $headers = array(), $key = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_VERBOSE, false); // @todo use $this->_curlDebug instead
        curl_setopt($ch, CURLOPT_POST, 0);

        if (is_null($key)) {
            $key = $this->prepareKey($url);
        }

        $this->services[$key] = $ch;
    }

    /**
     * Fetch error number after executing the request
     *
     * @param string $key index in the execution pool list
     *
     * @access public
     * @return integer
     */
    public function getErrorNo($key)
    {
        if (! isset($this->errors[$key])) {
            throw new ServiceNotExecutedException(sprintf('Service at key %s key has not been executed.', $key));
        }

        return ($this->errors[$key]);
    }

    /**
     * Fetch info array after executing the request
     *
     * @param string $key index in the execution pool list
     *
     * @return mixed
     * @throws ServiceNotExecutedException
     */
    public function getInfoNo($key)
    {
        if (! isset($this->infos[$key])) {
            throw new ServiceNotExecutedException(sprintf('Service at key %s key has not been executed.', $key));
        }

        return ($this->infos[$key]);
    }

    /**
     * Fetches the data from the handles in $this->services and returns it.
     *
     * @throws NoServicesToExecuteException
     *
     * @return array
     */
    public function execute()
    {
        if (! count($this->services)) {
            throw new NoServicesToExecuteException();
        }

        $results = array();

        $masterHandle = curl_multi_init();
        foreach ($this->services as $key => $ch) {
            curl_multi_add_handle($masterHandle, $ch);
        }

        $active = null;
        do {
            $mrc = curl_multi_exec($masterHandle, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($masterHandle) != -1) {
                do {
                    $mrc = curl_multi_exec($masterHandle, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }

        foreach ($this->services as $key => $ch) {
            $mrc = curl_multi_getcontent($ch);
            $results[$key] = $mrc;
        }

        //close the handles
        foreach ($this->services as $key => $ch) {
            $this->errors[$key] = curl_errno($ch); // for success it will be CURLE_OK === 0
            $this->infos[$key] = curl_getinfo($ch);
            curl_multi_remove_handle($masterHandle, $ch);
            unset($this->services[$key]); // remove from execution pool
        }
        curl_multi_close($masterHandle);

        return ($results);
    }

    /**
     * Obtain the list of services currently in the execution pool
     *
     * @return array
     *
     * @access public
     */
    public function getServices()
    {
        return ($this->services);
    }

    /**
     * Make the call out to the Java back end service
     * Allowed $fieldString to be empty, so we can call url-only services like
     *      http://skunkworks.lolaent.com/meta/resweb/Market/GSOSFB.json
     *
     * @param string $fieldString object to be converted to JSON
     *
     * @todo make the content-type overridable, remove the hardcoding
     *
     * @access public
     * @return The results of the CURL call
     */
    public function jsonRequest($fieldString = '')
    {
        $this->_lastJSON = $fieldString;

        if (!$this->_requestURL) {
            $this->error = 'URL  has not been set [servicesCall 1]';

            return $this->error;
        }

        if ($this->_curlDebug) {
            print "URL: " . $this->_requestURL . "<P>POST: $fieldString<P>\n\n";
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $this->_requestURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookies);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldString);
        curl_setopt($ch, CURLOPT_POST, 1);

        $results = curl_exec($ch);

        if (curl_errno($ch)) {
            if ($this->_curlDebug) {
                print "curl error: " . curl_error($ch) . "<P>\n\n";
            }
            $this->error = curl_error($ch);

            return false;
        } else {
            curl_close($ch);
        }

        if ($this->_curlDebug) {
            print "results: <pre>";
            print_r(json_decode($results));
            print "</pre>";
        }

        return $results;
    }


    /**
     * Proxy method for the jsonRequest method, where the name of the parameter to be used is "search"
     *
     * @param string $fieldString
     *
     * @return The results of the curl call
     */
    public function jsonSearchRequest($fieldString = '')
    {
        return $this->jsonRequest('search=' . $fieldString);
    }



    /**
     * getLastJSON
     *
     * @access public
     * @return string or null
     */
    public function getLastJSON()
    {
        return $this->_lastJSON;
    }

    function setCookies(array $cookies){
        $this->cookies = NULL;
        foreach ($cookies as $field => $value) {
            $this->cookies .= sprintf("%s=%s; ", $field, $value);
        }
    }

    /**
     * @param string $url       Request url
     * @param string $data      Request body
     * @param array  $headers   custom headers
     * @param string $method    Request Method
     * @param string $auth      authentification information
     * @param string $afterPath After Path
     *
     * @throws \Exception
     * @internal param bool $needResponse
     */
    public function oneWayRequest($url, $data, $headers=array(), $method="POST", $auth="", $afterPath = "")
    {
        $urlArray = parse_url($url);

        if ($urlArray===false) {
            throw new \Exception(sprintf("Malformed url %s", $url));
        }

        if (!isset($urlArray['port'])) {
            $urlArray['port'] = 80;
        }

        $eoln = "\r\n";
        $dataToWrite = "";

        if (!isset($urlArray['query'])) {
            $urlArray['port'] = 80;
        }

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

        $time = microtime();
        fwrite($fp, $dataToWrite);
        $dtime = microtime()-$time;
        fclose($fp);
    }
}
