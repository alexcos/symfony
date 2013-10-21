<?php

/**
 * Allegiant G4 util package.
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Exception
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for receiving an invalid shopping cart request
 *
 * @author Georgiana Gligor <georgiana@lolaent.com>
 */
class InvalidCartRequest extends G4Exception
{

    /**
     * Class constructor
     *
     * @param mixed  $message The error message
     * @param int    $code    The code number to be sent
     *
     * @access public
     */
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, 'cart', $code);
    }

}
