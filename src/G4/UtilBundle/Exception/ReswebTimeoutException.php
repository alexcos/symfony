<?php
/**
 * PHP version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Exception
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for resweb timeout
 */
class ReswebTimeoutException extends G4Exception
{
    private $reqUrl;
    private $reqBody;

    /**
     * Create a new exception for resweb timeout
     *
     * @param string $exMsg      The error message
     * @param string $reqUrl     The url that timedout
     * @param int    $reqBody    The request body
     * @param string $serviceKey The key
     * @param string $hash       Search hash, for logging
     * @param int    $code       The error code
     *
     * @access public
     * @return \G4\UtilBundle\Exception\ReswebTimeoutException
     */
    public function __construct($exMsg, $reqUrl, $reqBody, $serviceKey, $hash, $code=0)
    {
        parent::__construct(
            sprintf(
                '%s, Service key: %s, url: %s',
                $exMsg,
                $serviceKey,
                $reqUrl
            ),
            $hash,
            $code
        );
        $this->setJson($reqBody);
        $this->reqUrl = $reqUrl;
        $this->reqBody = $reqBody;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return ($this->reqUrl);
    }

    /**
     * Returns exception message with additional context information.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            'Empty resweb response for url %s, sent `%s`',
            $this->reqUrl,
            $this->reqBody
        );
    }

    /**
     * toArray
     *
     * @access public
     * @return array
     */
    public function toArray()
    {
        $toArray = array(
            'url' => $this->reqUrl,
            'body' => $this->reqBody,
        );
        return array_merge(parent::toArray(), $toArray);
    }

}
