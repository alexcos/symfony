<?php
/**
 * PHP version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Exception
 * @author   Sebi Chis <sebi@cloudtroopers.ro>
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for resweb timeout
 */
class ReswebVoucherException extends G4Exception
{

    private $data = null;

    /**
     * Create a new exception for resweb timeout when booking cart
     *
     * @param stdclass   $data       The message
     * @param string     $manifestId The results that did not pass
     * @param string     $code       The key used to identify the request
     * @param \Exception $previous   Previous error if any
     *
     * @return \G4\UtilBundle\Exception\ReswebVoucherException
     */
    public function __construct($data, $manifestId, $code = 0, \Exception $previous = null)
    {
        parent::__construct('Validate Voucher cannot proceed', $manifestId, $code, $previous);
        $this->setData($data);
    }

    /**
     * Set data
     *
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get data
     *
     * @return string $data
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
        return ('Validate Voucher cannot proceed.');
    }

}
