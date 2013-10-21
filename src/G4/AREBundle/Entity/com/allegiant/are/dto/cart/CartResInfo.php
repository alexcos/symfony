<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartResInfo
 */
class CartResInfo
{


    /**
     * @var com\allegiant\are\dto\cart\CartResConfNbr $cartResConfNbr
     */
    public $cartResConfNbr;

    /**
     * @var com\allegiant\are\dto\flight\TripResInfo $tripResInfo
     */
    public $tripResInfo;

    /**
     * @var com\allegiant\are\dto\hotel\HotelResInfo $hotelResInfo
     */
    public $hotelResInfo;

    /**
     * @var com\allegiant\are\dto\cart\VehicleResInfo $vehicleResInfo
     */
    public $vehicleResInfo;

    /**
     * @var com\allegiant\are\dto\cart\ProductResInfo $productResInfo
     */
    public $productResInfo;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setCartResConfNbr(new \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartResConfNbr());
        $this->setTripResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\TripResInfo());
        $this->setHotelResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResInfo());
        $this->setVehicleResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResInfo());
        $this->setProductResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResInfo());
    }

    /**
     * Set cartResConfNbr
     *
     * @param com\allegiant\are\dto\cart\CartResConfNbr $cartResConfNbr
     */
    public function setCartResConfNbr(\G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartResConfNbr $cartResConfNbr)
    {
        $this->cartResConfNbr = $cartResConfNbr;
    }

    /**
     * Get cartResConfNbr
     *
     * @return com\allegiant\are\dto\cart\CartResConfNbr
     */
    public function getCartResConfNbr()
    {
        return $this->cartResConfNbr;
    }

    /**
     * Set tripResInfo
     *
     * @param com\allegiant\are\dto\flight\TripResInfo $tripResInfo
     */
    public function setTripResInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\TripResInfo $tripResInfo)
    {
        $this->tripResInfo = $tripResInfo;
    }

    /**
     * Get tripResInfo
     *
     * @return com\allegiant\are\dto\cart\TripResInfo
     */
    public function getTripResInfo()
    {
        return $this->tripResInfo;
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
     * Set vehicleResInfo
     *
     * @param com\allegiant\are\dto\vehicle\VehicleResInfo $vehicleResInfo
     */
    public function setVehicleResInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResInfo $vehicleResInfo)
    {
        $this->vehicleResInfo = $vehicleResInfo;
    }

    /**
     * Get vehicleResInfo
     *
     * @return com\allegiant\are\dto\vehicle\VehicleResInfo
     */
    public function getVehicleResInfo()
    {
        return $this->vehicleResInfo;
    }

    /**
     * Set productResInfo
     *
     * @param com\allegiant\are\dto\product\ProductResInfo $productResInfo
     */
    public function setProductResInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResInfo $productResInfo)
    {
        $this->productResInfo = $productResInfo;
    }

    /**
     * Get productResInfo
     *
     * @return com\allegiant\are\dto\product\ProductResInfo
     */
    public function getProductResInfo()
    {
        return $this->productResInfo;
    }
}