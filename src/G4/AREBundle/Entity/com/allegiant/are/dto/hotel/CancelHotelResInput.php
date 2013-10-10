<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\CancelHotelResInput
 */
class CancelHotelResInput
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelResInfo $hotelResInfo
     */
    public $hotelResInfo;

    /**
     * @var string $cancelDateTime
     */
    public $cancelDateTime;

    /**
     * @var boolean $waiveFees
     */
    public $waiveFees;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setHotelResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResInfo());
    }

    /**
     * Set hotelResInfo
     *
     * @param com\allegiant\are\dto\hotel\HotelResInfo $hotelResInfo
     */
    public function setHotelResInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResInfo $hotelResInfo)
    {
        $this->hotelResInfo = $hotelResInfo;
    }

    /**
     * Get hotelResInfo
     *
     * @return com\allegiant\are\dto\hotel\HotelResInfo
     */
    public function getHotelResInfo()
    {
        return $this->hotelResInfo;
    }

    /**
     * Set cancelDateTime
     *
     * @param string $cancelDateTime
     */
    public function setCancelDateTime($cancelDateTime)
    {
        $this->cancelDateTime = $cancelDateTime;
    }

    /**
     * Get cancelDateTime
     *
     * @return string
     */
    public function getCancelDateTime()
    {
        return $this->cancelDateTime;
    }

    /**
     * Set waiveFees
     *
     * @param boolean $waiveFees
     */
    public function setWaiveFees($waiveFees)
    {
        $this->waiveFees = $waiveFees;
    }

    /**
     * Get waiveFees
     *
     * @return boolean
     */
    public function getWaiveFees()
    {
        return $this->waiveFees;
    }
}