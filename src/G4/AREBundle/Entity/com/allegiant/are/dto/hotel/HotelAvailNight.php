<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailNight
 */
class HotelAvailNight
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelDiscountInfo $discountInfo
     */
    public $discountInfo;

    /**
     * @var integer $ratePlanID
     */
    public $ratePlanID;

    /**
     * @var string $stayDate
     */
    public $stayDate;

    /**
     * @var integer $availCodeID
     */
    public $availCodeID;

    /**
     * @var float $regularPrice
     */
    public $regularPrice;

    /**
     * @var float $totalPrice
     */
    public $totalPrice;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setDiscountInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelDiscountInfo());
    }

    /**
     * Set discountInfo
     *
     * @param com\allegiant\are\dto\hotel\HotelDiscountInfo $discountInfo
     */
    public function setDiscountInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelDiscountInfo $discountInfo)
    {
        $this->discountInfo = $discountInfo;
    }

    /**
     * Get discountInfo
     *
     * @return com\allegiant\are\dto\hotel\HotelDiscountInfo
     */
    public function getDiscountInfo()
    {
        return $this->discountInfo;
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
     * Set stayDate
     *
     * @param string $stayDate
     */
    public function setStayDate($stayDate)
    {
        $this->stayDate = $stayDate;
    }

    /**
     * Get stayDate
     *
     * @return string
     */
    public function getStayDate()
    {
        return $this->stayDate;
    }

    /**
     * Set availCodeID
     *
     * @param integer $availCodeID
     */
    public function setAvailCodeID($availCodeID)
    {
        $this->availCodeID = $availCodeID;
    }

    /**
     * Get availCodeID
     *
     * @return integer
     */
    public function getAvailCodeID()
    {
        return $this->availCodeID;
    }

    /**
     * Set regularPrice
     *
     * @param float $regularPrice
     */
    public function setRegularPrice($regularPrice)
    {
        $this->regularPrice = $regularPrice;
    }

    /**
     * Get regularPrice
     *
     * @return float
     */
    public function getRegularPrice()
    {
        return $this->regularPrice;
    }

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}