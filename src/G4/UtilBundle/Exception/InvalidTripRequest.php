<?php

/**
 * Allegiant G4 util package.
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Exception
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for receiving an invalid trip request for the online check-in
 *
 * @author Georgiana Gligor <georgiana@lolaent.com>
 */
class InvalidTripRequest extends G4Exception
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
        parent::__construct($message, 'cart');
    }

}
