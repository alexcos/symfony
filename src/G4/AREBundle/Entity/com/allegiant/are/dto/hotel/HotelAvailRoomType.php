<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailRoomType
 */
class HotelAvailRoomType
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelAvailGuestCount $guestCount
     */
    public $guestCount;

    /**
     * @var integer $roomTypeID
     */
    public $roomTypeID;

    /**
     * @var integer $availCodeID
     */
    public $availCodeID;

    /**
     * @var integer $numQualified
     */
    public $numQualified;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setGuestCount(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailGuestCount());
    }

    /**
     * Set guestCount
     *
     * @param com\allegiant\are\dto\hotel\HotelAvailGuestCount $guestCount
     */
    public function setGuestCount(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelAvailGuestCount $guestCount)
    {
        $this->guestCount = $guestCount;
    }

    /**
     * Get guestCount
     *
     * @return com\allegiant\are\dto\hotel\HotelAvailGuestCount
     */
    public function getGuestCount()
    {
        return $this->guestCount;
    }

    /**
     * Set roomTypeID
     *
     * @param integer $roomTypeID
     */
    public function setRoomTypeID($roomTypeID)
    {
        $this->roomTypeID = $roomTypeID;
    }

    /**
     * Get roomTypeID
     *
     * @return integer
     */
    public function getRoomTypeID()
    {
        return $this->roomTypeID;
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
     * Set numQualified
     *
     * @param integer $numQualified
     */
    public function setNumQualified($numQualified)
    {
        $this->numQualified = $numQualified;
    }

    /**
     * Get numQualified
     *
     * @return integer
     */
    public function getNumQualified()
    {
        return $this->numQualified;
    }
}