<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightVoucherInfoOutput
 */
class GetFlightVoucherInfoOutput
{


    /**
     * @var com\allegiant\are\dto\flight\FlightVoucherInfo $flightVoucherInfo
     */
    public $flightVoucherInfo;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setFlightVoucherInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightVoucherInfo());
    }

    /**
     * Set flightVoucherInfo
     *
     * @param com\allegiant\are\dto\flight\FlightVoucherInfo $flightVoucherInfo
     */
    public function setFlightVoucherInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightVoucherInfo $flightVoucherInfo)
    {
        $this->flightVoucherInfo = $flightVoucherInfo;
    }

    /**
     * Get flightVoucherInfo
     *
     * @return com\allegiant\are\dto\flight\FlightVoucherInfo
     */
    public function getFlightVoucherInfo()
    {
        return $this->flightVoucherInfo;
    }
}