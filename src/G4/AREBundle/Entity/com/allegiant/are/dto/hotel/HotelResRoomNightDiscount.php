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
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomNightDiscount
 */
class HotelResRoomNightDiscount
{


    /**
     * @var integer $discountTypeID
     */
    public $discountTypeID;

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
     * Set discountTypeID
     *
     * @param integer $discountTypeID
     */
    public function setDiscountTypeID($discountTypeID)
    {
        $this->discountTypeID = $discountTypeID;
    }

    /**
     * Get discountTypeID
     *
     * @return integer
     */
    public function getDiscountTypeID()
    {
        return $this->discountTypeID;
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