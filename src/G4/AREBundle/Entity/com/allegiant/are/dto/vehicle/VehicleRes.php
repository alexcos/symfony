<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleRes
 */
class VehicleRes
{

    /**
     * @var com\allegiant\are\dto\common\ResTraveler $driver
     */
    public $driver;

    /**
     * @var integer $bagCount
     */
    public $bagCount;

    /**
     * @var integer $paxCount
     */
    public $paxCount;

    /**
     * @var com\allegiant\are\dto\vehicle\VehicleResSpecialRequest $specialRequest
     */
    public $specialRequest;

    /**
     * @var com\allegiant\are\dto\vehicle\VehiclePA $pricingAndAvail
     */
    public $pricingAndAvail;

    /**
     * @var integer $vehicleResID
     */
    public $vehicleResID;

    /**
     * @var string $dropOffDateTime
     */
    public $dropOffDateTime;

    /**
     * @var integer $dropOffLocationID
     */
    public $dropOffLocationID;

    /**
     * @var string $pickupDateTime
     */
    public $pickupDateTime;

    /**
     * @var integer $pickupLocationID
     */
    public $pickupLocationID;


    /**
     * @var float $overrideTotalAmount
     */
    public $overrideTotalAmount;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPricingAndAvail(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehiclePA());
        $this->setDriver(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTraveler());
        $this->setSpecialRequest(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResSpecialRequest());
    }

    /**
     * Set pricingAndAvail
     *
     * @param com\allegiant\are\dto\vehicle\VehiclePA $pricingAndAvail
     */
    public function setPricingAndAvail($pricingAndAvail) //\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehiclePA
    {
        $this->pricingAndAvail = $pricingAndAvail;
    }

    /**
     * Get pricingAndAvail
     *
     * @return com\allegiant\are\dto\vehicle\VehiclePA
     */
    public function getPricingAndAvail()
    {
        return $this->pricingAndAvail;
    }

    /**
     * Set driver
     *
     * @param com\allegiant\are\dto\common\ResTraveler $driver
     */
    public function setDriver(\G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTraveler $driver)
    {
        $this->driver[] = $driver;
    }

    /**
     * Get driver
     *
     * @return com\allegiant\are\dto\common\ResTraveler
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set specialRequest
     *
     * @param com\allegiant\are\dto\vehicle\VehicleResSpecialRequest $specialRequest
     */
    public function setSpecialRequest(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResSpecialRequest $specialRequest)
    {
        $this->specialRequest = $specialRequest;
    }

    /**
     * Get specialRequest
     *
     * @return com\allegiant\are\dto\vehicle\VehicleResSpecialRequest
     */
    public function getSpecialRequest()
    {
        return $this->specialRequest;
    }

    /**
     * Set vehicleResID
     *
     * @param integer $vehicleResID
     */
    public function setVehicleResID($vehicleResID)
    {
        $this->vehicleResID = $vehicleResID;
    }

    /**
     * Get vehicleResID
     *
     * @return integer
     */
    public function getVehicleResID()
    {
        return $this->vehicleResID;
    }

    /**
     * Set pickupDateTime
     *
     * @param string $pickupDateTime
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
     * @param string $dropOffDateTime
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
     * @param integer $pickupLocationID
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
     * @param integer $dropOffLocationID
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
     * Set bagCount
     *
     * @param integer $bagCount
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

    /**
     * Set paxCount
     *
     * @param integer $paxCount
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
     * Set overrideTotalAmount
     *
     * @param float $overrideTotalAmount
     */
    public function setOverrideTotalAmount($overrideTotalAmount)
    {
        $this->overrideTotalAmount = $overrideTotalAmount;
    }

    /**
     * Get overrideTotalAmount
     *
     * @return float
     */
    public function getOverrideTotalAmount()
    {
        return $this->overrideTotalAmount;
    }
}