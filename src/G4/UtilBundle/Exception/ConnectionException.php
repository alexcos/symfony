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
 * Exception for connection problems
 */
class ConnectionException extends G4Exception
{

    /**
     * __construct 
     * 
     * @param string    $message  The error message
     * @param string    $key      The key/hash that identifies the request
     * @param int       $code     The error code
     * @param Exception $previous Previous error if any
     * 
     * @access public
     * @return void
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, '', $code, $previous);
    }

}
