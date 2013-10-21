<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightVoucherInfoInput
 */
class GetFlightVoucherInfoInput
{


    /**
     * @var string $flightVoucherNbr
     */
    public $flightVoucherNbr;

    /**
     * Constructor function
     */
    public function __construct()
    {
    }

    /**
     * Set flightVoucherNbr
     *
     * @param string $flightVoucherNbr
     */
    public function setFlightVoucherNbr($flightVoucherNbr)
    {
        $this->flightVoucherNbr = $flightVoucherNbr;
    }

    /**
     * Get flightVoucherNbr
     *
     * @return string
     */
    public function getFlightVoucherNbr()
    {
        return $this->flightVoucherNbr;
    }
}