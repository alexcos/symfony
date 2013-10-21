<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\BookVehicleResInput
 */
class BookVehicleResInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{

    /**
     * @var integer $marketID
     */
    public $marketID;

    /**
     * @var integer $cartID
     */
    public $cartID;

    /**
     * @var com\allegiant\are\dto\vehicle\VehicleRes $VehicleRes
     */
    public $vehicleRes;


    /**
     * @var string $bookingDateTime
     */
    public $bookingDateTime;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setVehicleRes(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleRes());
    }

    /**
     * Set VehicleRes
     *
     * @param com\allegiant\are\dto\vehicle\VehicleRes $vehicleRes
     */
    public function setVehicleRes(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleRes $vehicleRes)
    {
        $this->vehicleRes = $vehicleRes;
    }

    /**
     * Get VehicleRes
     *
     * @return com\allegiant\are\dto\vehicle\VehicleRes
     */
    public function getVehicleRes()
    {
        return $this->vehicleRes;
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
     * Set bookingDateTime
     *
     * @param string $bookingDateTime
     */
    public function setBookingDateTime($bookingDateTime)
    {
        $this->bookingDateTime = $bookingDateTime;
    }

    /**
     * Get bookingDateTime
     *
     * @return string
     */
    public function getBookingDateTime()
    {
        return $this->bookingDateTime;
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