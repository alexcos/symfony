<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use G4\AREBundle\Entity\com\allegiant\are\dto\flight\BoardingPass;

class FlightTravelerCheckInResult
{

    const _RESULT_CODE_SUCCESS = 'SUCCESS';

    /**
     * @var BoardingPass
     */
    public $boardingPass;
    public $journeyId;
    public $flightTravelerId;
    public $resultCode;

    /**
     * @param BoardingPass $boardingPass
     */
    public function setBoardingPass(BoardingPass $boardingPass)
    {
        $this->boardingPass = $boardingPass;
    }

    /**
     * @return BoardingPass
     */
    public function getBoardingPass()
    {
        return $this->boardingPass;
    }

    public function setFlightTravelerId($flightTravelerId)
    {
        $this->flightTravelerId = $flightTravelerId;
    }

    public function getFlightTravelerId()
    {
        return $this->flightTravelerId;
    }

    public function setJourneyId($journeyId)
    {
        $this->journeyId = $journeyId;
    }

    public function getJourneyId()
    {
        return $this->journeyId;
    }

    public function setResultCode($resultCode)
    {
        $this->resultCode = $resultCode;
    }

    public function getResultCode()
    {
        return $this->resultCode;
    }
}
