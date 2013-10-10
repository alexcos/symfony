<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetSeatMapsInput
 */
class GetSeatMapsInput
{


    /**
     * @var com\allegiant\are\dto\flight\Flight $flight
     */
    public $flight;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setFlight(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Flight());
    }

    /**
     * Set flight
     *
     * @param com\allegiant\are\dto\flight\Flight $flight
     */
    public function setFlight(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Flight $flight)
    {
        $this->flight = array($flight);
    }

    /**
     * Get flight
     *
     * @return com\allegiant\are\dto\flight\Flight
     */
    public function getFlight()
    {
        return $this->flight;
    }
}