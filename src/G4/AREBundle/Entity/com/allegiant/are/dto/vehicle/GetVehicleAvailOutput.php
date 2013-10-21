<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\GetVehicleAvailOutput
 */
class GetVehicleAvailOutput
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehicleClass $vehicleClass
     */
    public $vehicleClass;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setVehicleClass(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleClass());
    }

    /**
     * Set vehicleClass
     *
     * @param com\allegiant\are\dto\vehicle\VehicleClass $vehicleClass
     */
    public function setVehicleClass(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleClass $vehicleClass)
    {
        $this->vehicleClass = $vehicleClass;
    }

    /**
     * Get vehicleClass
     *
     * @return com\allegiant\are\dto\vehicle\VehicleClass
     */
    public function getVehicleClass()
    {
        return $this->vehicleClass;
    }
}