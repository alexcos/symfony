<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Schedule
 */
class Schedule
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var com\allegiant\are\dto\flight\FlightTimeComponent $scheduledTimes
     */
    private $scheduledTimes;

    /**
     * @var com\allegiant\are\dto\flight\FlightTimeComponent $actualTimes
     */
    private $actualTimes;

    /**
     * @var com\allegiant\are\dto\flight\FlightEstimatedTimeComponent $estimatedTimes
     */
    private $estimatedTimes;

    /**
     * @var com\allegiant\are\dto\flight\FlightGate $flightGate
     */
    private $flightGate;

    /**
     * @var com\allegiant\are\dto\flight\Airport $schDepartAirport
     */
    private $schDepartAirport;

    /**
     * @var com\allegiant\are\dto\flight\Airport $schArriveAirport
     */
    private $schArriveAirport;

    /**
     * @var com\allegiant\are\dto\flight\Airport $actDepartAirport
     */
    private $actDepartAirport;

    /**
     * @var com\allegiant\are\dto\flight\Airport $actArriveAirport
     */
    private $actArriveAirport;

    /**
     * @var string $divert
     */
    private $divert;

    /**
     * @var string $flightStatus
     */
    private $flightStatus;

    /**
     * @var string $cancelReason
     */
    private $cancelReason;


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
     * Set scheduledTimes
     *
     * @param com\allegiant\are\dto\flight\FlightTimeComponent $scheduledTimes
     */
    public function setScheduledTimes(\com\allegiant\are\dto\flight\FlightTimeComponent $scheduledTimes)
    {
        $this->scheduledTimes = $scheduledTimes;
    }

    /**
     * Get scheduledTimes
     *
     * @return com\allegiant\are\dto\flight\FlightTimeComponent 
     */
    public function getScheduledTimes()
    {
        return $this->scheduledTimes;
    }

    /**
     * Set actualTimes
     *
     * @param com\allegiant\are\dto\flight\FlightTimeComponent $actualTimes
     */
    public function setActualTimes(\com\allegiant\are\dto\flight\FlightTimeComponent $actualTimes)
    {
        $this->actualTimes = $actualTimes;
    }

    /**
     * Get actualTimes
     *
     * @return com\allegiant\are\dto\flight\FlightTimeComponent 
     */
    public function getActualTimes()
    {
        return $this->actualTimes;
    }

    /**
     * Set estimatedTimes
     *
     * @param com\allegiant\are\dto\flight\FlightEstimatedTimeComponent $estimatedTimes
     */
    public function setEstimatedTimes(\com\allegiant\are\dto\flight\FlightEstimatedTimeComponent $estimatedTimes)
    {
        $this->estimatedTimes = $estimatedTimes;
    }

    /**
     * Get estimatedTimes
     *
     * @return com\allegiant\are\dto\flight\FlightEstimatedTimeComponent 
     */
    public function getEstimatedTimes()
    {
        return $this->estimatedTimes;
    }

    /**
     * Set flightGate
     *
     * @param com\allegiant\are\dto\flight\FlightGate $flightGate
     */
    public function setFlightGate(\com\allegiant\are\dto\flight\FlightGate $flightGate)
    {
        $this->flightGate = $flightGate;
    }

    /**
     * Get flightGate
     *
     * @return com\allegiant\are\dto\flight\FlightGate 
     */
    public function getFlightGate()
    {
        return $this->flightGate;
    }

    /**
     * Set schDepartAirport
     *
     * @param com\allegiant\are\dto\flight\Airport $schDepartAirport
     */
    public function setSchDepartAirport(\com\allegiant\are\dto\flight\Airport $schDepartAirport)
    {
        $this->schDepartAirport = $schDepartAirport;
    }

    /**
     * Get schDepartAirport
     *
     * @return com\allegiant\are\dto\flight\Airport 
     */
    public function getSchDepartAirport()
    {
        return $this->schDepartAirport;
    }

    /**
     * Set schArriveAirport
     *
     * @param com\allegiant\are\dto\flight\Airport $schArriveAirport
     */
    public function setSchArriveAirport(\com\allegiant\are\dto\flight\Airport $schArriveAirport)
    {
        $this->schArriveAirport = $schArriveAirport;
    }

    /**
     * Get schArriveAirport
     *
     * @return com\allegiant\are\dto\flight\Airport 
     */
    public function getSchArriveAirport()
    {
        return $this->schArriveAirport;
    }

    /**
     * Set actDepartAirport
     *
     * @param com\allegiant\are\dto\flight\Airport $actDepartAirport
     */
    public function setActDepartAirport(\com\allegiant\are\dto\flight\Airport $actDepartAirport)
    {
        $this->actDepartAirport = $actDepartAirport;
    }

    /**
     * Get actDepartAirport
     *
     * @return com\allegiant\are\dto\flight\Airport 
     */
    public function getActDepartAirport()
    {
        return $this->actDepartAirport;
    }

    /**
     * Set actArriveAirport
     *
     * @param com\allegiant\are\dto\flight\Airport $actArriveAirport
     */
    public function setActArriveAirport(\com\allegiant\are\dto\flight\Airport $actArriveAirport)
    {
        $this->actArriveAirport = $actArriveAirport;
    }

    /**
     * Get actArriveAirport
     *
     * @return com\allegiant\are\dto\flight\Airport 
     */
    public function getActArriveAirport()
    {
        return $this->actArriveAirport;
    }

    /**
     * Set divert
     *
     * @param string $divert
     */
    public function setDivert($divert)
    {
        $this->divert = $divert;
    }

    /**
     * Get divert
     *
     * @return string 
     */
    public function getDivert()
    {
        return $this->divert;
    }

    /**
     * Set flightStatus
     *
     * @param string $flightStatus
     */
    public function setFlightStatus($flightStatus)
    {
        $this->flightStatus = $flightStatus;
    }

    /**
     * Get flightStatus
     *
     * @return string 
     */
    public function getFlightStatus()
    {
        return $this->flightStatus;
    }

    /**
     * Set cancelReason
     *
     * @param string $cancelReason
     */
    public function setCancelReason($cancelReason)
    {
        $this->cancelReason = $cancelReason;
    }

    /**
     * Get cancelReason
     *
     * @return string 
     */
    public function getCancelReason()
    {
        return $this->cancelReason;
    }
}