<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\GetHotelAvailOutput
 */
class GetHotelAvailOutput
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelAvail $hotel
     */
    public $hotel;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setHotel(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvail());
    }

    /**
     * Set hotel
     *
     * @param com\allegiant\are\dto\hotel\HotelAvail $hotel
     */
    public function setHotel(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvail $hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * Get hotel
     *
     * @return com\allegiant\are\dto\hotel\HotelAvail
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}