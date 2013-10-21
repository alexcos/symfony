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
class SeatRequiredException extends G4Exception
{
    protected $error;

    /**
     * Create a new exception for bad resweb data
     *
     * @param string $key The key
     *
     * @return \G4\UtilBundle\Exception\SeatRequiredException
     */
    public function __construct($key)
    {
        $this->error = 'Travelers are required to purchase a seat';
        parent::__construct($this->error, $key);
    }

    /**
     * Returns exception message with additional context information.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->error;
    }

}
