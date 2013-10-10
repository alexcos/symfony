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
class ReswebSystemException extends G4Exception
{

    /**
     * Create a new exception for resweb PROD_001 Fatal - Unable to process your request
     *
     * @param string $message The message
     * @param string $manifestId     The results that did not pass
     * @param string $code    The key used to identify the request
     *
     * @return \G4\UtilBundle\Exception\ReswebSystemException
     */
    public function __construct($message, $manifestId, $code)
    {
        parent::__construct($message, $manifestId, $code);
    }

}
