<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTravelerModify
 */
class FlightTravelerModify extends FlightTraveler
{
    public $state;
    public $flightTravelerId;
    public $checkInStatus;
    public $seatAssignment;
    public $bag;
    public $priorityBoardingInfo;


    /**
     * Constructor function
     */
    public function __construct()
    {
        parent::__construct();
        $this->seatAssignment = '';
        $this->bag = '';

    }
}