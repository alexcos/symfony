<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\ModifyVehicleResOutput
 */
class ModifyVehicleResOutput
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehicleResInfo $vehicleResInfo
     */
    public $vehicleResInfo;

    /**
     * @var string $modifyDateTime
     */
    public $modifyDateTime;


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
}