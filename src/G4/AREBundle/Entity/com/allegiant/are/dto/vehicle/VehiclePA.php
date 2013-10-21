<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehiclePA
 */
class VehiclePA
{


    /**
     * @var com\allegiant\are\dto\vehicle\Price $price
     */
    public $price;

    /**
     * @var integer $vehicleInvID
     */
    public $vehicleInvID;

    /**
     * @var integer $ratePlanID
     */
    public $ratePlanID;

    /**
     * @var integer $availCheckMethodID
     */
    public $availCheckMethodID;

    /**
     * @var string $pickupDateTime
     */
    public $pickupDateTime;

    /**
     * @var string $dropOffDateTime
     */
    public $dropOffDateTime;

    /**
     * @var integer $availableQuantity
     */
    public $availableQuantity;

    /**
     * @var float $totalAmount
     */
    public $totalAmount;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPrice(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Price());
    }

    /**
     * Set price
     *
     * @param com\allegiant\are\dto\vehicle\Price $price
     */
    public function setPrice(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Price $price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return com\allegiant\are\dto\vehicle\Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set vehicleInvID
     *
     * @param integer $vehicleInvID
     */
    public function setVehicleInvID($vehicleInvID)
    {
        $this->vehicleInvID = $vehicleInvID;
    }

    /**
     * Get vehicleInvID
     *
     * @return integer
     */
    public function getVehicleInvID()
    {
        return $this->vehicleInvID;
    }

    /**
     * Set ratePlanID
     *
     * @param integer $ratePlanID
     */
    public function setRatePlanID($ratePlanID)
    {
        $this->ratePlanID = $ratePlanID;
    }

    /**
     * Get ratePlanID
     *
     * @return integer
     */
    public function getRatePlanID()
    {
        return $this->ratePlanID;
    }

    /**
     * Set availCheckMethodID
     *
     * @param integer $availCheckMethodID
     */
    public function setAvailCheckMethodID($availCheckMethodID)
    {
        $this->availCheckMethodID = $availCheckMethodID;
    }

    /**
     * Get availCheckMethodID
     *
     * @return integer
     */
    public function getAvailCheckMethodID()
    {
        return $this->availCheckMethodID;
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
     * Set availableQuantity
     *
     * @param integer $availableQuantity
     */
    public function setAvailableQuantity($availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * Get availableQuantity
     *
     * @return integer
     */
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }

    /**
     * Set totalAmount
     *
     * @param float $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * Get totalAmount
     *
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }
}