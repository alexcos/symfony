<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightVoucherInfo
 */
class FlightVoucherInfo
{


    /**
     * @var com\allegiant\are\dto\flight\Filter $departAirport
     */
    public $departAirport;

    /**
     * @var com\allegiant\are\dto\flight\Filter $arrriveAirport
     */
    public $arrriveAirport;

    /**
     * @var com\allegiant\are\dto\flight\Filter $classOfService
     */
    public $classOfService;

    /**
     * @var integer $voucherTypeID
     */
    public $voucherTypeID;

    /**
     * @var string $travelStartDate
     */
    public $travelStartDate;

    /**
     * @var string $travelEndDate
     */
    public $travelEndDate;

    /**
     * @var string $flightVoucherNbr
     */
    public $flightVoucherNbr;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setDepartAirport(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter());
        $this->setArrriveAirport(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter());
        $this->setClassOfService(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter());
    }

    /**
     * Set departAirport
     *
     * @param com\allegiant\are\dto\flight\Filter $departAirport
     */
    public function setDepartAirport(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter $departAirport)
    {
        $this->departAirport = $departAirport;
    }

    /**
     * Get departAirport
     *
     * @return com\allegiant\are\dto\flight\Filter
     */
    public function getDepartAirport()
    {
        return $this->departAirport;
    }

    /**
     * Set arrriveAirport
     *
     * @param com\allegiant\are\dto\flight\Filter $arrriveAirport
     */
    public function setArrriveAirport(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter $arrriveAirport)
    {
        $this->arrriveAirport = $arrriveAirport;
    }

    /**
     * Get arrriveAirport
     *
     * @return com\allegiant\are\dto\flight\Filter
     */
    public function getArrriveAirport()
    {
        return $this->arrriveAirport;
    }

    /**
     * Set classOfService
     *
     * @param com\allegiant\are\dto\flight\Filter $classOfService
     */
    public function setClassOfService(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter $classOfService)
    {
        $this->classOfService = $classOfService;
    }

    /**
     * Get classOfService
     *
     * @return com\allegiant\are\dto\flight\Filter
     */
    public function getClassOfService()
    {
        return $this->classOfService;
    }

    /**
     * Set voucherTypeID
     *
     * @param integer $voucherTypeID
     */
    public function setVoucherTypeID($voucherTypeID)
    {
        $this->voucherTypeID = $voucherTypeID;
    }

    /**
     * Get voucherTypeID
     *
     * @return integer
     */
    public function getVoucherTypeID()
    {
        return $this->voucherTypeID;
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