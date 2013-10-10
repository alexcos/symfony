<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\CancelVehicleResInput
 */
class CancelVehicleResInput
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehicleResInfo $vehicleResInfo
     */
    public $vehicleResInfo;

    /**
     * @var string $cancelDateTime
     */
    public $cancelDateTime;

    /**
     * @var boolean $waiveFees
     */
    public $waiveFees;

    /**
     * @var integer $locationID
     */
    public $locationID;

    /**
     * @var integer $marketID
     */
    public $marketID;


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
     * Set cancelDateTime
     *
     * @param string $cancelDateTime
     */
    public function setCancelDateTime($cancelDateTime)
    {
        $this->cancelDateTime = $cancelDateTime;
    }

    /**
     * Get cancelDateTime
     *
     * @return string
     */
    public function getCancelDateTime()
    {
        return $this->cancelDateTime;
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

    /**
     * Set locationID
     *
     * @param integer $locationID
     */
    public function setLocationID($locationID)
    {
        $this->locationID = $locationID;
    }

    /**
     * Get locationID
     *
     * @return integer
     */
    public function getLocationID()
    {
        return $this->locationID;
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