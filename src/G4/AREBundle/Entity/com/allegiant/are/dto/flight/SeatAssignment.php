<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatAssignment
 */
class SeatAssignment
{
    /**
     * @var string $flightNbr
     */
    public $flightNbr;

    /**
     * @var date $departDate
     */
    public $departDate;

    /**
     * @var string $type
     */
    public $type;

    /**
     * @var string $row
     */
    public $row;

    /**
     * @var string $col
     */
    public $col;


}