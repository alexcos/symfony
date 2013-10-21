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
 * Exception for when we have no dockets
 */
class NoDocketsException extends G4Exception
{
    //protected $message;
    protected $url;
    protected $error;

    /**
     * Create a new exception for bad resweb data
     *
     * @param string $error The error message
     * @param string $url   The dockets url that doesn't work
     * @param int    $key   The hash Key
     *
     * @return \G4\UtilBundle\Exception\NoDocketsException
     */
    public function __construct($error, $url, $key)
    {
        //$this->message =

        parent::__construct(
            sprintf('%s (%s)', $error, $url),
            $key
        );

        //$this->message = $message;
        $this->error = $error;
        $this->url = $url;
    }

    /**
     * Returns exception message with additional context information.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s (%s)', $this->error, $this->url);
    }

    public function getUrl()
    {
        return $this->url;
    }

}
