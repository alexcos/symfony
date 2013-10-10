<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatMap
 */
class SeatMap
{


    /**
     * @var com\allegiant\are\dto\flight\Seat $seat
     */
    public $seat;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setSeat(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Seat());
    }

    /**
     * Set seat
     *
     * @param com\allegiant\are\dto\flight\Seat $seat
     */
    public function setSeat(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Seat $seat)
    {
        $this->seat = $seat;
    }

    /**
     * Get seat
     *
     * @return com\allegiant\are\dto\flight\Seat
     */
    public function getSeat()
    {
        return $this->seat;
    }
}