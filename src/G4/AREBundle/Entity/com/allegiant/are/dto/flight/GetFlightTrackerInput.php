<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightTrackerInput
 */
class GetFlightTrackerInput
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var com\allegiant\are\dto\cart\FlightInput $flight
     */
    private $flight;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set flight
     *
     * @param com\allegiant\are\dto\cart\FlightInput $flight
     */
    public function setFlight(\com\allegiant\are\dto\cart\FlightInput $flight)
    {
        $this->flight = $flight;
    }

    /**
     * Get flight
     *
     * @return com\allegiant\are\dto\cart\FlightInput 
     */
    public function getFlight()
    {
        return $this->flight;
    }
}