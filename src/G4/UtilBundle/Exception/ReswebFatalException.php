<?php
/**
 * Checkin process exception
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Exception
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for the checkin process
 */
class ReswebFatalException extends G4Exception
{
    private $data = null;

    /**
     * __construct
     *
     * @param string    $data       The error message
     * @param string    $manifestId The key/hash that identifies the request
     * @param int       $code       The http error code
     * @param Exception $previous   Previous error if any
     *
     * @access public
     * @return void
     */
    public function __construct($data, $manifestId, $code = 0, \Exception $previous = null)
    {
        parent::__construct('The process encountered a system exception.', $manifestId, $code, $previous);
        $this->setData($data);
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return ($this->data);
    }

    /**
     * Returns exception message with additional context information.
     *
     * @return string
     */
    public function __toString()
    {
        return ('The checkin process cannot proceed.');
    }



}
