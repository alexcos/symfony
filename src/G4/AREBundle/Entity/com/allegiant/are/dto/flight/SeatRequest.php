<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatRequest
 */
class SeatRequest
{
    /**
     * @var com\allegiant\are\dto\flight\SeatAssignment $seat
     */
    public $seat;

    /**
     * @var integer $flightTravelerId
     */
    public $flightTravelerId;

	/**
     * Constructor function
     */
    public function __construct($data = null)
    {
        $this->setSeat(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatAssignment());
    }

	/**
     * Set seat
     *
     * @param com\allegiant\are\dto\flight\SeatAssignment $seat
     */
    public function setSeat(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatAssignment $seat)
    {
        $this->seat = $seat;
    }
}