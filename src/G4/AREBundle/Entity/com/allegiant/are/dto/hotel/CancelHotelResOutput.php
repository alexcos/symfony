<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\CancelHotelResOutput
 */
class CancelHotelResOutput
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelResInfo $hotelResInfo
     */
    public $hotelResInfo;

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
}