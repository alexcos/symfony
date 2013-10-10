<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelDiscountInfo
 */
class HotelDiscountInfo
{


    /**
     * @var integer $discountID
     */
    public $discountID;

    /**
     * @var boolean $isGift
     */
    public $isGift;

    /**
     * @var float $value
     */
    public $value;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set discountID
     *
     * @param integer $discountID
     */
    public function setDiscountID($discountID)
    {
        $this->discountID = $discountID;
    }

    /**
     * Get discountID
     *
     * @return integer
     */
    public function getDiscountID()
    {
        return $this->discountID;
    }

    /**
     * Set isGift
     *
     * @param boolean $isGift
     */
    public function setIsGift($isGift)
    {
        $this->isGift = $isGift;
    }

    /**
     * Get isGift
     *
     * @return boolean
     */
    public function getIsGift()
    {
        return $this->isGift;
    }

    /**
     * Set value
     *
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}