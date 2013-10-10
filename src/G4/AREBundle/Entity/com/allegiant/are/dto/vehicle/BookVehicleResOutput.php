<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\BookVehicleResOutput
 */
class BookVehicleResOutput
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehicleResInfo $vehicleResInfo
     */
    public $vehicleResInfo;

    /**
     * @var string $bookingDateTime
     */
    public $bookingDateTime;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setVehicleResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResInfo());
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
}