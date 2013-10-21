<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.hotel
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\ModifyHotelResInput
 */
class ModifyHotelResInput
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelResRoom $room
     */
    public $room;

    /**
     * @var integer $cartID
     */
    public $cartID;

    /**
     * @var integer $hotelResID
     */
    public $hotelResID;

    /**
     * @var integer $marketID
     */
    public $marketID;

    /**
     * @var integer $hotelID
     */
    public $hotelID;

    /**
     * @var string $resStartDate
     */
    public $resStartDate;

    /**
     * @var string $resEndDate
     */
    public $resEndDate;

    /**
     * @var float $totalPrice
     */
    public $totalPrice;

    /**
     * @var string $modifyDateTime
     */
    public $modifyDateTime;

    /**
     * @var boolean $waiveFees
     */
    public $waiveFees;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setRoom(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoom());
    }

    /**
     * Set room
     *
     * @param com\allegiant\are\dto\hotel\HotelResRoom $room
     */
    public function setRoom(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoom $room)
    {
        $this->room = $room;
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
     * Set hotelResID
     *
     * @param integer $hotelResID
     */
    public function setHotelResID($hotelResID)
    {
        $this->hotelResID = $hotelResID;
    }

    /**
     * Get hotelResID
     *
     * @return integer
     */
    public function getHotelResID()
    {
        return $this->hotelResID;
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

    /**
     * Set modifyDateTime
     *
     * @param string $modifyDateTime
     */
    public function setModifyDateTime($modifyDateTime)
    {
        $this->modifyDateTime = $modifyDateTime;
    }

    /**
     * Get modifyDateTime
     *
     * @return string
     */
    public function getModifyDateTime()
    {
        return $this->modifyDateTime;
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