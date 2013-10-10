<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoom
 */
class HotelResRoom
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelResRoomNight $night
     */
    public $night;

    /**
     * @var com\allegiant\are\dto\common\ResTraveler $occupant
     */
    public $occupant;

    /**
     * @var com\allegiant\are\dto\hotel\HotelResRoomSpecialRequest $specialRequest
     */
    //public $specialRequest;

    public $roomTypeID;

    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->setNight(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomNight());
        //$this->setOccupant(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTraveler());
        //$this->setSpecialRequest(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomSpecialRequest());
    }

    /**
     * Set roomTypeID
     *
     * @param int $roomTypeID
     */
    public function setRoomTypeID($roomTypeID)
    {
        $this->roomTypeID = $roomTypeID;
    }

    /**
     * Get roomTypeID
     *
     * @return roomTypeID
     */
    public function getRoomTypeID()
    {
        return $this->roomTypeID;
    }


    /**
     * Add night
     *
     * @param com\allegiant\are\dto\hotel\HotelResRoomNight $night
     */
    public function addNight(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomNight $night)
    {
        $this->night[] = $night;
    }

    /**
     * Set night
     *
     * @param com\allegiant\are\dto\hotel\HotelResRoomNight $night
     */
    public function setNight($night)
    {
        $this->night = $night;
    }


    /**
     * Get night
     *
     * @return com\allegiant\are\dto\hotel\HotelResRoomNight
     */
    public function getNight()
    {
        return $this->night;
    }

    /**
     * Set occupant
     *
     * @param com\allegiant\are\dto\common\ResTraveler $occupant
     */
    public function setOccupant($occupant)
    {
        $this->occupant = $occupant;
    }

    /**
     * Add occupant
     *
     * @param com\allegiant\are\dto\common\ResTraveler $occupant
     */
    public function addOccupant(\G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTraveler $occupant)
    {
        $this->occupant[] = $occupant;
    }


    /**
     * Get occupant
     *
     * @return com\allegiant\are\dto\common\ResTraveler
     */
    public function getOccupant()
    {
        return $this->occupant;
    }

    /**
     * Set specialRequest
     *
     * @param com\allegiant\are\dto\hotel\HotelResRoomSpecialRequest $specialRequest
     */
    public function setSpecialRequest(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomSpecialRequest $specialRequest)
    {
        $this->specialRequest = $specialRequest;
    }

    /**
     * Get specialRequest
     *
     * @return com\allegiant\are\dto\hotel\HotelResRoomSpecialRequest
     */
    public function getSpecialRequest()
    {
        return $this->specialRequest;
    }
}