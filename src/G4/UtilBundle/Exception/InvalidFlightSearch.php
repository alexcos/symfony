<?php
/**
 * Allegiant G4 util package.
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Exception
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for receiving an invalid search request
 *
 * @author Serban Bajdechi <serban@lolaent.com>
 */
class InvalidSearchSearch extends G4Exception
{
    /**
     * Class constructor
     *
     * @param mixed $message The error message
     *
     * @access public
     */
    public function __construct($message)
    {
        parent::__construct($message, 'search');
    }
}
