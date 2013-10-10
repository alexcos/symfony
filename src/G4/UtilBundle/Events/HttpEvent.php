<?php
namespace G4\UtilBundle\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * event for resweb calls
 */
class HttpEvent extends G4TimelineEvent
{
    protected $url;

    protected $pairKey;

    protected $responseCode;

    /**
     * @param string $manifestId   hash
     * @param string $data         data
     * @param string $class        class
     * @param string $url          url that was accessed
     * @param string $pairKey      this is a key that is unique per request/response, and it's used to find the response for each request
     * @param string $responseCode header response code
     */
    public function __construct($manifestId, $data, $class, $url, $pairKey, $responseCode = 0)
    {
        parent::__construct($manifestId, $data, $class);
        $this->url = $url;
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
