<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleSearchCriteria
 */
class VehicleSearchCriteria
{
    /**
     * Optional param to use for future feature
     *
     * @var array $promoCode
     */
    public $promoCode;

    /**
     * @var integer $vehicleTypeID
     */
    public $vehicleTypeID;

    /**
     * @var integer $vehicleClassID
     */
    public $vehicleClassID;

    /**
     * @var string $pickupDateTime
     */
    public $pickupDateTime;

    /**
     * @var string $dropOffDateTime
     */
    public $dropOffDateTime;

    /**
     * @var integer $pickupLocationID
     */
    public $pickupLocationID;

    /**
     * @var integer $dropOffLocationID
     */
    public $dropOffLocationID;

    /**
     * @var integer $marketID
     */
    public $marketID;

    /**
     * @var integer $paxCount
     */
    public $paxCount;

    /**
     * @var integer $bagCount
     */
    public $bagCount;

    /**
     * __construct
     */
    public function __construct()
    {
        // properly initialize the array members
        $this->promoCode = array();
        $this->vehicleTypeID = array();
        $this->vehicleClassID = array();
    }

    /**
     * Set promoCode
     *
     * @param integer $promoCode The promo code to be added in the list
     *
     * @return void
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode[] = $promoCode;
    }

    /**
     * Get promoCode
     *
     * @return array 
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Add given $vehicleTypeID to the list
     *
     * @param integer $vehicleTypeID vehicle type identifier
     *
     * @return void
     */
    public function setVehicleTypeID($vehicleTypeID)
    {
        $this->vehicleTypeID[] = $vehicleTypeID;
    }

    /**
     * Get vehicleTypeID
     *
     * @return array 
     */
    public function getVehicleTypeID()
    {
        return $this->vehicleTypeID;
    }

    /**
     * Add provided $vehicleClassID to the list
     *
     * @param integer $vehicleClassID vehicle class identifier
     *
     * @return void
     */
    public function setVehicleClassID($vehicleClassID)
    {
        $this->vehicleClassID[] = $vehicleClassID;
    }

    /**
     * Get vehicleClassID
     *
     * @return array 
     */
    public function getVehicleClassID()
    {
        return $this->vehicleClassID;
    }

    /**
     * Set pickupDateTime
     *
     * @param string $pickupDateTime datetime representation of the pickup moment
     *
     * @return void
     */
    public function setPickupDateTime($pickupDateTime)
    {
        $this->pickupDateTime = $pickupDateTime;
    }

    /**
     * Get pickupDateTime
     *
     * @return string 
     */
    public function getPickupDateTime()
    {
        return $this->pickupDateTime;
    }

    /**
     * Set dropOffDateTime
     *
     * @param string $dropOffDateTime atetime representation of the dropoff moment
     *
     * @return void
     */
    public function setDropOffDateTime($dropOffDateTime)
    {
        $this->dropOffDateTime = $dropOffDateTime;
    }

    /**
     * Get dropOffDateTime
     *
     * @return string 
     */
    public function getDropOffDateTime()
    {
        return $this->dropOffDateTime;
    }

    /**
     * Set pickupLocationID
     *
     * @param integer $pickupLocationID location identifier for the pickup place
     *
     * @return void
     */
    public function setPickupLocationID($pickupLocationID)
    {
        $this->pickupLocationID = $pickupLocationID;
    }

    /**
     * Get pickupLocationID
     *
     * @return integer 
     */
    public function getPickupLocationID()
    {
        return $this->pickupLocationID;
    }

    /**
     * Set dropOffLocationID
     *
     * @param integer $dropOffLocationID location identifier of the dropoff place
     *
     * @return void
     */
    public function setDropOffLocationID($dropOffLocationID)
    {
        $this->dropOffLocationID = $dropOffLocationID;
    }

    /**
     * Get dropOffLocationID
     *
     * @return integer 
     */
    public function getDropOffLocationID()
    {
        return $this->dropOffLocationID;
    }

    /**
     * Set marketID
     *
     * @param integer $marketID market identifier
     *
     * @return void
     */
    public function setMarketID($marketID)
    {
        $this->marketID = $marketID;
    }

    /**
     * Get marketID
     *
     * @return integer 
     */
    public function getMarketID()
    {
        return $this->marketID;
    }

    /**
     * Set paxCount
     * "PAX is also known as "pack per person". The term ended up being designation for "unit per person."
     * It now applies to everything such as hotel rooms, seats on flights and restaurants meals.
     *
     * Read more: http://wiki.answers.com/Q/What_is_the_meaning_of_pax#ixzz1gVTVwBF0"
     *
     * @param integer $paxCount the number of packs per person
     *
     * @return void
     */
    public function setPaxCount($paxCount)
    {
        $this->paxCount = $paxCount;
    }

    /**
     * Get paxCount
     *
     * @return integer 
     */
    public function getPaxCount()
    {
        return $this->paxCount;
    }

    /**
     * Set bagCount
     *
     * @param integer $bagCount the number of bags
     *
     * @return void
     */
    public function setBagCount($bagCount)
    {
        $this->bagCount = $bagCount;
    }

    /**
     * Get bagCount
     *
     * @return integer 
     */
    public function getBagCount()
    {
        return $this->bagCount;
    }

}