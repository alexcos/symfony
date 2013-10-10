<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\ModifyVehicleResInput
 */
class ModifyVehicleResInput
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehicleRes $vehicleRes
     */
    public $vehicleRes;

    /**
     * @var string $modifyDateTime
     */
    public $modifyDateTime;

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
        $this->setVehicleRes(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleRes());
    }

    /**
     * Set vehicleRes
     *
     * @param com\allegiant\are\dto\vehicle\VehicleRes $vehicleRes
     */
    public function setVehicleRes(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleRes $vehicleRes)
    {
        $this->vehicleRes = $vehicleRes;
    }

    /**
     * Get vehicleRes
     *
     * @return com\allegiant\are\dto\vehicle\VehicleRes
     */
    public function getVehicleRes()
    {
        return $this->vehicleRes;
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