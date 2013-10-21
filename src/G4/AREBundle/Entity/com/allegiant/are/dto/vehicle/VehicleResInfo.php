<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResInfo
 */
class VehicleResInfo
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehicleResConf $vehicleResConf
     */
    public $vehicleResConf;

    /**
     * @var integer $idd
     */
    public $idd;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setVehicleResConf(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResConf());
    }

    /**
     * Set vehicleResConf
     *
     * @param com\allegiant\are\dto\vehicle\VehicleResConf $vehicleResConf
     */
    public function setVehicleResConf(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResConf $vehicleResConf)
    {
        $this->vehicleResConf = $vehicleResConf;
    }

    /**
     * Get vehicleResConf
     *
     * @return com\allegiant\are\dto\vehicle\VehicleResConf
     */
    public function getVehicleResConf()
    {
        return $this->vehicleResConf;
    }

    /**
     * Set idd
     *
     * @param integer $idd
     */
    public function setIdd($idd)
    {
        $this->idd = $idd;
    }

    /**
     * Get idd
     *
     * @return integer
     */
    public function getIdd()
    {
        return $this->idd;
    }
}