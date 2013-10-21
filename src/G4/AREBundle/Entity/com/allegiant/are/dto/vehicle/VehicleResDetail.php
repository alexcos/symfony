<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResDetail
 */
class VehicleResDetail
{


    /**
     * @var  $TravelerRPHs
     */
    public $TravelerRPHs;

    /**
     * @var integer $quantity
     */
    public $quantity;

    /**
     * @var integer $guestTypeID
     */
    public $guestTypeID;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set TravelerRPHs
     *
     * @param string $travelerRPHs
     */
    public function setTravelerRPHs($travelerRPHs)
    {
        $this->TravelerRPHs = $travelerRPHs;
    }

    /**
     * Get TravelerRPHs
     *
     * @return string
     */
    public function getTravelerRPHs()
    {
        return $this->TravelerRPHs;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set guestTypeID
     *
     * @param integer $guestTypeID
     */
    public function setGuestTypeID($guestTypeID)
    {
        $this->guestTypeID = $guestTypeID;
    }

    /**
     * Get guestTypeID
     *
     * @return integer
     */
    public function getGuestTypeID()
    {
        return $this->guestTypeID;
    }
}