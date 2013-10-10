<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput
 */
class BookHotelResInput extends RequestInput
{

    /**
     * @var com\allegiant\are\dto\hotel\HotelResRoom $room
     */
    public $room;

    /**
     * @var string $promoCode
     */
    public $promoCode;

    /**
     * @var integer $cartID
     */
    public $cartID;

    /**
     * @var integer $roomTypeID
     */
    //public $roomTypeID;

    /**
     * @var string $resStartDate
     */
    public $resStartDate;

    /**
     * @var string $resEndDate
     */
    public $resEndDate;

    /**
     * @var integer $marketID
     */
    public $marketID;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setRoom(array());
    }

    /**
     * Set room
     *
     * @param array $room
     */
    public function setRoom(array $room)
    {
        $this->room = $room;
    }

    /**
     * Set room
     *
     * @param com\allegiant\are\dto\hotel\HotelResRoom $room
     */
    public function addRoom(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoom $room)
    {
        $this->room[] = $room;
    }

    /**
     * Get room
     *
     * @return com\allegiant\are\dto\hotel\HotelResRoom
     */
    public function getRoom()
    {
        return $this->room;
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
     * Set cartID
     *
     * @param integer $cartID
     */
    public function setCartID($cartID)
    {
        $this->cartID = $cartID;
    }

    /**
     * Get cartID
     *
     * @return integer
     */
    public function getCartID()
    {
        return $this->cartID;
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
     * Set resStartDate
     *
     * @param string $resStartDate
     */
    public function setResStartDate($resStartDate)
    {
        $this->resStartDate = $resStartDate;
    }

    /**
     * Get resStartDate
     *
     * @return string
     */
    public function getResStartDate()
    {
        return $this->resStartDate;
    }

    /**
     * Set resEndDate
     *
     * @param string $resEndDate
     */
    public function setResEndDate($resEndDate)
    {
        $this->resEndDate = $resEndDate;
    }

    /**
     * Get resEndDate
     *
     * @return string
     */
    public function getResEndDate()
    {
        return $this->resEndDate;
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