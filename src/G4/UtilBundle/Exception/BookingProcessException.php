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
 * Exception for the booking process
 */
class BookingProcessException extends \Exception
{

    private $data = null;

    public function __construct($data, $code = 0, $previous = null)
    {
        parent::__construct('The booking process cannot proceed.', $code, $previous);
        $this->setData($data);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

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
        return('The booking process cannot proceed.');
    }

}
