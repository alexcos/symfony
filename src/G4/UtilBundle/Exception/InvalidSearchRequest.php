<?php

/**
 * Allegiant G4 util package.
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Exception
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for receiving an invalid shopping search request
 *
 * @author Serban Bajdechi <serban@lolaent.com>
 */
class InvalidSearchRequest extends G4Exception
{

    /**
     * Class constructor
     *
     * @param mixed  $message The error message
     * @param string $key     The Request Body key
     *
     * @access public
     */
    public function __construct($message)
    {
        parent::__construct($message, 'search');
    }

}
