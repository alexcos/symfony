<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.hotel
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomNightCost
 */
class HotelResRoomNightCost
{


    /**
     * @var integer $roomCostTypeID
     */
    public $roomCostTypeID;

    /**
     * @var integer $guestCount
     */
    public $guestCount;

    /**
     * @var float $amount
     */
    public $amount;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set roomCostTypeID
     *
     * @param integer $roomCostTypeID
     */
    public function setRoomCostTypeID($roomCostTypeID)
    {
        $this->roomCostTypeID = $roomCostTypeID;
    }

    /**
     * Get roomCostTypeID
     *
     * @return integer
     */
    public function getRoomCostTypeID()
    {
        return $this->roomCostTypeID;
    }

    /**
     * Set guestCount
     *
     * @param integer $guestCount
     */
    public function setGuestCount($guestCount)
    {
        $this->guestCount = $guestCount;
    }

    /**
     * Get guestCount
     *
     * @return integer
     */
    public function getGuestCount()
    {
        return $this->guestCount;
    }

    /**
     * Set amount
     *
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
}