<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvail
 */
class HotelAvail
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelAvailRoomType $roomType
     */
    public $roomType;

    /**
     * @var integer $hotelID
     */
    public $hotelID;

    /**
     * @var integer $childAge
     */
    public $childAge;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setRoomType(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailRoomType());
    }

    /**
     * Set roomType
     *
     * @param com\allegiant\are\dto\hotel\HotelAvailRoomType $roomType
     */
    public function setRoomType(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailRoomType $roomType)
    {
        $this->roomType = $roomType;
    }

    /**
     * Get roomType
     *
     * @return com\allegiant\are\dto\hotel\HotelAvailRoomType
     */
    public function getRoomType()
    {
        return $this->roomType;
    }

    /**
     * Set hotelID
     *
     * @param integer $hotelID
     */
    public function setHotelID($hotelID)
    {
        $this->hotelID = $hotelID;
    }

    /**
     * Get hotelID
     *
     * @return integer
     */
    public function getHotelID()
    {
        return $this->hotelID;
    }

    /**
     * Set childAge
     *
     * @param integer $childAge
     */
    public function setChildAge($childAge)
    {
        $this->childAge = $childAge;
    }

    /**
     * Get childAge
     *
     * @return integer
     */
    public function getChildAge()
    {
        return $this->childAge;
    }
}