<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightDiscountsInput
 */
class GetFlightDiscountsInput
{


    /**
     * @var com\allegiant\are\dto\flight\Flight $flight
     */
    public $flight;

    /**
     * @var string $travelStartDate
     */
    public $travelStartDate;

    /**
     * @var string $travelEndDate
     */
    public $travelEndDate;

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
        $this->flight = $flight;
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

    /**
     * Set travelStartDate
     *
     * @param string $travelStartDate
     */
    public function setTravelStartDate($travelStartDate)
    {
        $this->travelStartDate = $travelStartDate;
    }

    /**
     * Get travelStartDate
     *
     * @return string
     */
    public function getTravelStartDate()
    {
        return $this->travelStartDate;
    }

    /**
     * Set travelEndDate
     *
     * @param string $travelEndDate
     */
    public function setTravelEndDate($travelEndDate)
    {
        $this->travelEndDate = $travelEndDate;
    }

    /**
     * Get travelEndDate
     *
     * @return string
     */
    public function getTravelEndDate()
    {
        return $this->travelEndDate;
    }
}