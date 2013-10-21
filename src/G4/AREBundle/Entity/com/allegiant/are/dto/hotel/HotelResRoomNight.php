<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomNight
 */
class HotelResRoomNight
{


    /**
     * @var integer $ratePlanID
     */
    public $ratePlanID;

    /**
     * @var string $resDate
     */
    public $resDate;

    /**
     * @var float $quotedPrice
     */
    public $quotedPrice;

        public $discountID = array();

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set resDate
     *
     * @param string $resDate
     */
    public function setResDate($resDate)
    {
        $this->resDate = $resDate;
    }

    /**
     * Get resDate
     *
     * @return string
     */
    public function getResDate()
    {
        return $this->resDate;
    }

    /**
     * Set quotedPrice
     *
     * @param float $quotedPrice
     */
    public function setQuotedPrice($quotedPrice)
    {
        $this->quotedPrice = $quotedPrice;
    }

    /**
     * Get quotedPrice
     *
     * @return float
     */
    public function getQuotedPrice()
    {
        return $this->quotedPrice;
    }
}