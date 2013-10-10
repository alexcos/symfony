<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightDiscountsOutput
 */
class GetFlightDiscountsOutput
{


    /**
     * @var com\allegiant\are\dto\flight\FlightDiscount $flightDiscount
     */
    public $flightDiscount;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setFlightDiscount(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightDiscount());
    }

    /**
     * Set flightDiscount
     *
     * @param com\allegiant\are\dto\flight\FlightDiscount $flightDiscount
     */
    public function setFlightDiscount(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightDiscount $flightDiscount)
    {
        $this->flightDiscount = $flightDiscount;
    }

    /**
     * Get flightDiscount
     *
     * @return com\allegiant\are\dto\flight\FlightDiscount
     */
    public function getFlightDiscount()
    {
        return $this->flightDiscount;
    }
}