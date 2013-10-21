<?php
namespace G4\UtilBundle\Services;

use \Symfony\Component\DependencyInjection\ContainerAware;
/**
 * class that only deals with timeline logging.
 */
class TimelineLogging extends ContainerAware
{
    // sequential logging id
    public static $no = 0;

    /**
     * The current running kernel
     *
     * @var AppKernel
     * @access private
     */
    private $kernel = null;

    /**
     * Url of the server
     *
     * @var string
     */
    private $server = null;

    /**
     * Silo
     *
     * @var string $silo
     */
    private $silo;

    /**
     * @var timelineLogger
     */
    private $timelineLoggerService = null;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->timelineLoggerService = "g4_logging_timeline_default_service";
    }

    /**
     * @return AppKernel|null|string
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * initialize params for logger
     */
    public function init()
    {
        $this->logTimeline  = $this->container->getParameter('g4_timeline_log');  //this variable defines if we log to timeline
        $this->silo   = $this->container->getParameter('g4_silo');
    }

    /**
     * @return null|string
     */
    public function getServer()
    {
        return $this->getTimelineLogger()->getServerUrl();
    }

    /**
     * Return the default debug logger service
     *
     * @return mixed
     */
    public function getTimelineLogger()
    {
        $defaultLoggingService = $this->container->getParameter($this->timelineLoggerService);
        $timelineLogger = $this->container->get($defaultLoggingService);

        return $timelineLogger;
    }

    /**
     * @param string  $hash      Hash
     * @param string  $reqType   request type
     * @param array   $dataIn    data array
     * @param array   $className data array
     * @param boolean $returnId  set true if we need to get the id of the new entity
     *
     * @return bool
     */
    public function timelineLog($hash, $reqType, $dataIn ,$className, $returnId=false)
    {
        if (!$this->logTimeline) {
            return true;
        }

        $data = $dataIn;
        $data["bundle"] = $className;
        $data["manifest_id"]=$hash; //done
        $data["cart_id"]=$hash; //done
        $data["session_id"]=$hash; //done
        $data["timestamp"]=microtime(true); //done
        $data["referrer"] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'UnknownReferrer'; //
        $data["silo"]=$this->silo;
        $data["machine"] = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'UnknownHost';
        $data["type"]=$reqType;
        $data['no'] = sprintf(
            '%s-%s',
            ++self::$no,
            isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'UnknownUri'
        );

        $newId = $this->getTimelineLogger()->writeLog(json_encode($data), $returnId);

        return $newId;
    }


    /*------------------------ methods to log different sources ------------------------*/

    /**
     * @param string $hash    Hash key
     * @param mixed  $request Request
     * @param string $name    Name
     * @param string $url     Url
     * @param string $pairKey key used to find identify for each request
     *
     * @return string|null
     */
    public function timelineLogResWebRequest($hash, $request, $name, $url, $pairKey)
    {
        $data["url"] = $url;
        $data["pairKey"] = $pairKey;
        $data["http_request"] = $request;

        return $this->timelineLog($hash, "RESWEB_IN_REQUEST", $data, $name);
    }

    /**
     * @param string $hash     Hash key
     * @param mixed  $request  Request
     * @param string $name     Name
     * @param string $url      Url
     * @param string $pairKey  key used to identify response for each request
     * @param string $curlInfo Curl info
     *
     * @return string|null
     */
    public function timelineLogResWebResponse($hash, $request, $name, $url, $pairKey, $curlInfo)
    {
        $data["url"] = $url;
        $data["pairKey"] = $pairKey;
        $data["http_response"] = $request;
        $data["curl_info"] = $curlInfo;

        return $this->timelineLog($hash, "RESWEB_RESPONSE", $data, $name);
    }

    /**
     * INCOMING HTTP REQUEST
     * @param string $hash    Hash key
     * @param mixed  $request Request
     * @param string $name    Name
     * @param string $url     Url
     * @param string $pairKey key used to find identify for each request
     *
     * @return string|null
     */
    public function timelineLogSymfIn($hash, $request, $name, $url, $pairKey)
    {
        $data["url"] = $url;
        $data["pairKey"] = $pairKey;
        $data["http_request"] = $request;

        return $this->timelineLog($hash, "SYMF_IN_REQUEST", $data, $name);
    }

    /**
     * OUTGOING HTTP REQUEST
     * @param string $hash    Hash key
     * @param mixed  $request Request
     * @param string $name    Name
     * @param string $url     Url
     * @param string $pairKey key used to find identify for each request
     *
     * @return string|null
     */
    public function timelineLogSymfOut($hash, $request, $name, $url, $pairKey)
    {
        $data["url"] = $url;
        $data["pairKey"] = $pairKey;
        $data["http_response"] = $request;

        return $this->timelineLog($hash, "SYMF_OUT_REQUEST", $data, $name);
    }

    /**
     * INCOMING HTTP REQUEST
     * @param string $hash    Hash key
     * @param mixed  $request Request
     * @param string $name    Name
     * @param string $url     Url
     * @param string $pairKey key used to find identify for each request
     *
     * @return string|null
     */
    public function timelineLogAjaxIn($hash, $request, $name, $url, $pairKey)
    {
        $data["url"] = $url;
        $data["pairKey"] = $pairKey;
        $data["http_request"] = $request;

        return $this->timelineLog($hash, "AJAX_IN_REQUEST", $data, $name);
    }

    /**
     * OUTGOING HTTP REQUEST
     * @param string $hash    Hash key
     * @param mixed  $request Request
     * @param string $name    Name
     * @param string $url     Url
     * @param string $pairKey key used to find identify for each request
     *
     * @return string|null
     */
    public function timelineLogAjaxOut($hash, $request, $name, $url, $pairKey)
    {
        $data["url"] = $url;
        $data["pairKey"] = $pairKey;
        $data["http_response"] = $request;

        return $this->timelineLog($hash, "AJAX_OUT_REQUEST", $data, $name);
    }

    /**
     * @param string $hash     The hash key
     * @param mixed  $manifest The manifest file
     * @param string $name     The name
     *
     * @return bool
     */
    public function timelineLogManifest($hash, $manifest, $name)
    {
        $data['manifest'] = $manifest;

        return $this->timelineLog($hash, "MANIFEST", $data, $name);
    }

    /**
     * @param string $hash    The hash key
     * @param mixed  $booking The manifest file
     * @param string $name    The name
     *
     * @return bool
     */
    public function timelineLogBooking($hash, $booking, $name)
    {
        $data['booking'] = $booking;

        $decodedBooking = json_decode($booking);
        $data['booking_human_readable']['flight_departing'] = $booking->departing->id;
        if (isset($booking->returning->id)) {
            $data['booking_human_readable']['flight_returning'] = $booking->returning->id;
        }

        return $this->timelineLog($hash, "BOOKING", $data, $name);
    }

    /**
     * @param string $hash  Hash key
     * @param mixed  $value Value
     * @param string $name  Name
     *
     * @return string|null
     */
    public function timelineLogMCWrite($hash, $value, $name)
    {
        $data["data"] = $value;

//        return $this->timelineLog($hash, "MEMCACHE_WRITE", $data, $name);
    }

    /**
     * @param string $hash  Hash key
     * @param mixed  $value Value
     * @param string $name  Name
     *
     * @return string|null
     */
    public function timelineLogMCRead($hash, $value, $name)
    {
        $data["data"] = $value;

//        $this->timelineLog($hash, "MEMCACHE_READ", $data, $name);
    }

}
