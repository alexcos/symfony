<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\GetVehicleAvailInput
 */
class GetVehicleAvailInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehicleSearchCriteria $searchCriteria
     */
    public $searchCriteria;


    /**
     * __construct
     */
    public function __construct()
    {
        $this->setSearchCriteria(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleSearchCriteria());
    }

    /**
     * Set searchCriteria
     *
     * @param com\allegiant\are\dto\vehicle\VehicleSearchCriteria $searchCriteria
     */
    public function setSearchCriteria(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleSearchCriteria $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * Get searchCriteria
     *
     * @return com\allegiant\are\dto\vehicle\VehicleSearchCriteria
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }
}