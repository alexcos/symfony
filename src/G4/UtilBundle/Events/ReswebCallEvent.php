<?php
namespace G4\UtilBundle\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * event for resweb calls
 */
class ReswebCallEvent extends G4TimelineEvent
{

    protected $url;

    protected $curlInfo;

    protected $pairKey;

    protected $responseCode;

    /**
     * @param string $manifestId   hash
     * @param string $data         data
     * @param string $class        class
     * @param string $url          url that we call
     * @param string $pairKey      this is a key that is unique per request/response, and it's used to find the response for each request
     * @param string $responseCode header response code
     * @param string $curlInfo     curl info array
     */
    public function __construct($manifestId, $data, $class, $url, $pairKey, $responseCode, $curlInfo = "")
    {
        parent::__construct($manifestId, $data, $class);
        $this->url = $url;
        $this->curlInfo = $curlInfo;
        $this->pairKey = $pairKey;
        $this->responseCode = $responseCode;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getCurlInfo()
    {
        return $this->curlInfo;
    }

    /**
     * @return string
     */
    public function getPairKey()
    {
        return $this->pairKey;
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

}
