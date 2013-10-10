<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;


/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Flight
 */
class Flight
{

    /**
     * @var com\allegiant\are\dto\flight\SeatMap $seatMap
     */
    public $seatMap;

    /**
     * @var string $rph
     */
    public $rph;

    /**
     * @var string $carrierCode
     */
    public $carrierCode;

    /**
     * @var string $nbr
     */
    public $nbr;

    /**
     * @var string $departDate
     */
    public $departDate;

    /**
     * @var int $marketID
     */
    public $marketID;

    /**
     * @var int $overrideReasonId
     */
    public $overrideReasonId;

    /**
     * @var int $adjustedPrice
     */
    public $adjustedPrice;

    /**
     * @var string $origItinerary
     */
    public $origItinerary;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setSeatMap(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatMap());
    }

    /**
     * Set seatMap
     *
     * @param com\allegiant\are\dto\flight\SeatMap $seatMap seat map
     *
     * @return void
     */
    public function setSeatMap($seatMap)
    {
        $this->seatMap = $seatMap;
    }

    /**
     * Get seatMap
     *
     * @return com\allegiant\are\dto\flight\SeatMap
     */
    public function getSeatMap()
    {
        return $this->seatMap;
    }

    /**
     * Set rph
     *
     * @param string $rph
     *
     * @return void
     */
    public function setRph($rph)
    {
        $this->rph = $rph;
    }

    /**
     * Get rph
     *
     * @return string
     */
    public function getRph()
    {
        return $this->rph;
    }

    /**
     * Set carrierCode
     *
     * @param string $carrierCode carrier code
     *
     * @return void
     */
    public function setCarrierCode($carrierCode)
    {
        $this->carrierCode = $carrierCode;
    }

    /**
     * Get carrierCode
     *
     * @return string
     */
    public function getCarrierCode()
    {
        return $this->carrierCode;
    }

    /**
     * Set nbr
     *
     * @param string $nbr
     *
     * @return void
     */
    public function setNbr($nbr)
    {
        $this->nbr = $nbr;
    }

    /**
     * Get nbr
     *
     * @return string
     */
    public function getNbr()
    {
        return $this->nbr;
    }

    /**
     * Set departDate
     *
     * @param string $departDate departure date
     *
     * @return void
     */
    public function setDepartDate($departDate)
    {
        $this->departDate = $departDate;
    }

    /**
     * Get departDate
     *
     * @return string
     */
    public function getDepartDate()
    {
        return $this->departDate;
    }

    /**
     * @param int $adjustedPrice
     */
    public function setAdjustedPrice($adjustedPrice)
    {
        $this->adjustedPrice = $adjustedPrice;
    }

    /**
     * @return int
     */
    public function getAdjustedPrice()
    {
        return $this->adjustedPrice;
    }

    /**
     * @param int $marketID
     */
    public function setMarketID($marketID)
    {
        $this->marketID = $marketID;
    }

    /**
     * @return int
     */
    public function getMarketID()
    {
        return $this->marketID;
    }

    /**
     * @param string $origItinerary
     */
    public function setOrigItinerary($origItinerary)
    {
        $this->origItinerary = $origItinerary;
    }

    /**
     * @return string
     */
    public function getOrigItinerary()
    {
        return $this->origItinerary;
    }

    /**
     * @param int $overrideReasonId
     */
    public function setOverrideReasonId($overrideReasonId)
    {
        $this->overrideReasonId = $overrideReasonId;
    }

    /**
     * @return int
     */
    public function getOverrideReasonId()
    {
        return $this->overrideReasonId;
    }



}
