<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailGuestCount
 */
class HotelAvailGuestCount
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelAvailNight $night
     */
    public $night;

    /**
     * @var integer $numGuests
     */
    public $numGuests;

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
        $this->setNight(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailNight());
    }

    /**
     * Set night
     *
     * @param com\allegiant\are\dto\hotel\HotelAvailNight $night
     */
    public function setNight(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailNight $night)
    {
        $this->night = $night;
    }

    /**
     * Get night
     *
     * @return com\allegiant\are\dto\hotel\HotelAvailNight
     */
    public function getNight()
    {
        return $this->night;
    }

    /**
     * Set numGuests
     *
     * @param integer $numGuests
     */
    public function setNumGuests($numGuests)
    {
        $this->numGuests = $numGuests;
    }

    /**
     * Get numGuests
     *
     * @return integer
     */
    public function getNumGuests()
    {
        return $this->numGuests;
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