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
 * Exception for not detecting the contents of the PUT request
 */
class PutContentsNotFoundException extends G4Exception
{
    /**
     * @var string The key at which we search for data
     */
    private $key;

    /**
     * Class constructor
     *
     * @param mixed  $message The error message
     * @param string $manifestId     The Request Body key
     *
     * @access public
     * @return void
     */
    public function __construct($message, $manifestId)
    {
        parent::__construct($message, $manifestId);
    }
}
