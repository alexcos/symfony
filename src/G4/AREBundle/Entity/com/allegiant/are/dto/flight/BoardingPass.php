<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

class BoardingPass
{
public $firstName;
        public $lastName;
        public $itineraryNbr;
        public $seatNbr;
        public $gateNbr;
        public $flightNbr;
        public $boardDateTime;
        public $boardZone;
        public $departDateTime;
        public $departCityState;
        public $departAirportName;
        public $departAirportCode;
        public $arriveDateTime;
        public $arriveCityState;
        public $arriveAirportName;
        public $arriveAirportCode;
        public $isPriorityBoarding;
        public $travelerId;
        public $ticketInfo;
        public $barcodeData;
        public $msg1;
        public $msg2;
        public $msg3;

    public function setArriveAirportCode($arriveAirportCode)
    {
        $this->arriveAirportCode = $arriveAirportCode;
    }

    public function getArriveAirportCode()
    {
        return $this->arriveAirportCode;
    }

    public function setArriveAirportName($arriveAirportName)
    {
        $this->arriveAirportName = $arriveAirportName;
    }

    public function getArriveAirportName()
    {
        return $this->arriveAirportName;
    }

    public function setArriveCityState($arriveCityState)
    {
        $this->arriveCityState = $arriveCityState;
    }

    public function getArriveCityState()
    {
        return $this->arriveCityState;
    }

    public function setArriveDateTime($arriveDateTime)
    {
        $this->arriveDateTime = $arriveDateTime;
    }

    public function getArriveDateTime()
    {
        return $this->arriveDateTime;
    }

    public function setBarcodeData($barcodeData)
    {
        $this->barcodeData = $barcodeData;
    }

    public function getBarcodeData()
    {
        return $this->barcodeData;
    }

    public function setBoardDateTime($boardDateTime)
    {
        $this->boardDateTime = $boardDateTime;
    }

    public function getBoardDateTime()
    {
        return $this->boardDateTime;
    }

    public function setBoardZone($boardZone)
    {
        $this->boardZone = $boardZone;
    }

    public function getBoardZone()
    {
        return $this->boardZone;
    }

    public function setDepartAirportCode($departAirportCode)
    {
        $this->departAirportCode = $departAirportCode;
    }

    public function getDepartAirportCode()
    {
        return $this->departAirportCode;
    }

    public function setDepartAirportName($departAirportName)
    {
        $this->departAirportName = $departAirportName;
    }

    public function getDepartAirportName()
    {
        return $this->departAirportName;
    }

    public function setDepartCityState($departCityState)
    {
        $this->departCityState = $departCityState;
    }

    public function getDepartCityState()
    {
        return $this->departCityState;
    }

    public function setDepartDateTime($departDateTime)
    {
        $this->departDateTime = $departDateTime;
    }

    public function getDepartDateTime()
    {
        return $this->departDateTime;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFlightNbr($flightNbr)
    {
        $this->flightNbr = $flightNbr;
    }

    public function getFlightNbr()
    {
        return $this->flightNbr;
    }

    public function setGateNbr($gateNbr)
    {
        $this->gateNbr = $gateNbr;
    }

    public function getGateNbr()
    {
        return $this->gateNbr;
    }

    public function setIsPriorityBoarding($isPriorityBoarding)
    {
        $this->isPriorityBoarding = $isPriorityBoarding;
    }

    public function getIsPriorityBoarding()
    {
        return $this->isPriorityBoarding;
    }

    public function setItineraryNbr($itineraryNbr)
    {
        $this->itineraryNbr = $itineraryNbr;
    }

    public function getItineraryNbr()
    {
        return $this->itineraryNbr;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setMsg1($msg1)
    {
        $this->msg1 = $msg1;
    }

    public function getMsg1()
    {
        return $this->msg1;
    }

    public function setMsg2($msg2)
    {
        $this->msg2 = $msg2;
    }

    public function getMsg2()
    {
        return $this->msg2;
    }

    public function setMsg3($msg3)
    {
        $this->msg3 = $msg3;
    }

    public function getMsg3()
    {
        return $this->msg3;
    }

    public function setSeatNbr($seatNbr)
    {
        $this->seatNbr = $seatNbr;
    }

    public function getSeatNbr()
    {
        return trim($this->seatNbr);
    }

    public function setTicketInfo($ticketInfo)
    {
        $this->ticketInfo = $ticketInfo;
    }

    public function getTicketInfo()
    {
        return $this->ticketInfo;
    }

    public function setTravelerId($travelerId)
    {
        $this->travelerId = $travelerId;
    }

    public function getTravelerId()
    {
        return $this->travelerId;
    }
}
