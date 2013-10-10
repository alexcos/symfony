<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\GetHotelAvailInput
 */
class GetHotelAvailInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{


    /**
     * @var string $promoCode
     */
    public $promoCode;

    /**
     * @var com\allegiant\are\dto\hotel\RoomTravelerProfile $roomTravelerProfile
     */
    public $roomTravelerProfile;

    /**
     * @var array $hotelID
     */
    public $hotelID;

    /**
     * @var array $roomTypeID
     */
    public $roomTypeID;

    /**
     * @var string $travelStartDate
     */
    public $travelStartDate;

    /**
     * @var string $travelEndDate
     */
    public $travelEndDate;

    /**
     * @var integer $marketID
     */
    public $marketID;

    /**
     * Constructor function
     */
    public function __construct()
    {
        parent::__construct();
        $this->hotelID = array();
        $this->roomTypeID = array();
        $this->setRoomTravelerProfile(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\RoomTravelerProfile());
    }

    /**
     * Set promoCode
     *
     * @param string $promoCode
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;
    }

    /**
     * Get promoCode
     *
     * @return string
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set roomTravelerProfile
     *
     * @param com\allegiant\are\dto\hotel\RoomTravelerProfile $roomTravelerProfile
     */
    public function setRoomTravelerProfile(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\RoomTravelerProfile $roomTravelerProfile)
    {
        $this->roomTravelerProfile[] = $roomTravelerProfile;
    }

    /**
     * Get roomTravelerProfile
     *
     * @return com\allegiant\are\dto\hotel\RoomTravelerProfile
     */
    public function getRoomTravelerProfile()
    {
        return $this->roomTravelerProfile;
    }

    /**
     * Set hotelID
     *
     * @param array $hotelID
     */
    public function setHotelID($hotelID)
    {
        $this->hotelID[] = $hotelID;
    }

    /**
     * Get hotelID
     *
     * @return array
     */
    public function getHotelID()
    {
        return $this->hotelID;
    }

    /**
     * adds $roomTypeID to the list of the ones used
     *
     * @param integer $roomTypeID
     */
    public function setRoomTypeID($roomTypeID)
    {
        $this->roomTypeID[] = $roomTypeID;
    }

    /**
     * Get roomTypeID
     *
     * @return array
     */
    public function getRoomTypeID()
    {
        return $this->roomTypeID;
    }

    /**
     * Set travelStartDate
     *
     * @param string $travelStartDate
     */
    public function setTravelStartDate($travelStartDate)
    {
        $this->travelStartDate = $travelStartDate;
    }

    /**
     * Get travelStartDate
     *
     * @return string
     */
    public function getTravelStartDate()
    {
        return $this->travelStartDate;
    }

    /**
     * Set travelEndDate
     *
     * @param string $travelEndDate
     */
    public function setTravelEndDate($travelEndDate)
    {
        $this->travelEndDate = $travelEndDate;
    }

    /**
     * Get travelEndDate
     *
     * @return string
     */
    public function getTravelEndDate()
    {
        return $this->travelEndDate;
    }

    /**
     * Set marketID
     *
     * @param integer $marketID
     */
    public function setMarketID($marketID)
    {
        $this->marketID = $marketID;
    }

    /**
     * Get marketID
     *
     * @return integer
     */
    public function getMarketID()
    {
        return $this->marketID;
    }
}