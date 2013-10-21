<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.common
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes
 */
class PayLoadAttributes
{

    /**
     * @var integer $bookingTypeID
     */
    public $bookingTypeID;

    /**
     * @var integer $bookingChannelID
     */
    public $bookingChannelID;

    /**
     * @var string $transactionIdentifier
     */
    public $transactionIdentifier;

    /**
     * @var float $version
     */
    public $version;

    /**
     * @var string $timeStamp
     */
    public $timeStamp;



    /**
     * _class constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Set bookingTypeID
     *
     * @param integer $bookingTypeID booking type identifier
     *
     * @return void
     */
    public function setBookingTypeID($bookingTypeID)
    {
        $this->bookingTypeID = $bookingTypeID;
    }

    /**
     * Get bookingTypeID
     *
     * @return integer
     */
    public function getBookingTypeID()
    {
        return $this->bookingTypeID;
    }

    /**
     * Set bookingChannelID
     *
     * @param integer $bookingChannelID booking channel identifier
     *
     * @return void
     */
    public function setBookingChannelID($bookingChannelID)
    {
        $this->bookingChannelID = $bookingChannelID;
    }

    /**
     * Get bookingChannelID
     *
     * @return integer
     */
    public function getBookingChannelID()
    {
        return $this->bookingChannelID;
    }

    /**
     * Set transactionIdentifier
     *
     * @param string $transactionIdentifier transaction identifier
     *
     * @return void
     */
    public function setTransactionIdentifier($transactionIdentifier)
    {
        $this->transactionIdentifier = $transactionIdentifier;
    }

    /**
     * Get transactionIdentifier
     *
     * @return string
     */
    public function getTransactionIdentifier()
    {
        return $this->transactionIdentifier;
    }

    /**
     * Set version
     *
     * @param float $version version
     *
     * @return void
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Get version
     *
     * @return float
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set timeStamp
     *
     * @param string $timeStamp timestamp
     *
     * @return void
     */
    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

    /**
     * Get timeStamp
     *
     * @return string
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * @param array $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * There is no 'property' field in the class definition because at the moment
     * only .167 resweb knows about this field, and adding it will make json_encode add it to the request
     * and the older versions of resweb will reject the request because of the unknown property
     * @return array
     */
    public function getProperty()
    {
        if (isset($this->property)) {
            return $this->property;
        }

        return array();
    }


}