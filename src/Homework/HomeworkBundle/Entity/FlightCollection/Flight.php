<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 12:47 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\FlightCollection;

use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection;
use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap;

/** Flight Entity
 *
 * Class Flight
 */
class Flight
{
    /** @var string */
    protected $rph;

    /** @var string */
    protected $carrierCode;

    /** @var string */
    protected $nbr;

    /** @var  string */
    protected $departDate;

    /** @var  integer */
    protected $marketID;

    /** @var  SeatMapCollection */
    protected $seatMap;

    /**
     * Default Constructor
     */
    public function __construct()
    {
        $this->setSeatMap(new SeatMapCollection());
    }

    /**
     * @param SeatMapCollection $seatMap
     */
    public function setSeatMap($seatMap)
    {
        $this->seatMap = $seatMap;
    }

    /**
     * @return SeatMapCollection
     */
    public function getSeatMap()
    {
        return $this->seatMap;
    }

    /**
     * @var string TODO type
     */
    protected $overrideReasonId;

    /**
     * @var string TODO type
     */
    protected $adjustedPrice;

    /**
     * @var stringTODO type
     */
    protected $origItinerary;

    /**
     * @param string $carrierCode
     */
    public function setCarrierCode($carrierCode)
    {
        $this->carrierCode = $carrierCode;
    }

    /**
     * @return string
     */
    public function getCarrierCode()
    {
        return $this->carrierCode;
    }

    /**
     * @param string $departDate
     */
    public function setDepartDate($departDate)
    {
        $this->departDate = $departDate;
    }

    /**
     * @return string
     */
    public function getDepartDate()
    {
        return $this->departDate;
    }

    /**
     * @param string $nbr
     */
    public function setNbr($nbr)
    {
        $this->nbr = $nbr;
    }

    /**
     * @return string
     */
    public function getNbr()
    {
        return $this->nbr;
    }

    /**
     * @param string $rph
     */
    public function setRph($rph)
    {
        $this->rph = $rph;
    }

    /**
     * @return string
     */
    public function getRph()
    {
        return $this->rph;
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
     * @param string $adjustedPrice
     */
    public function setAdjustedPrice($adjustedPrice)
    {
        $this->adjustedPrice = $adjustedPrice;
    }

    /**
     * @return string
     */
    public function getAdjustedPrice()
    {
        return $this->adjustedPrice;
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
     * @param string $overrideReasonId
     */
    public function setOverrideReasonId($overrideReasonId)
    {
        $this->overrideReasonId = $overrideReasonId;
    }

    /**
     * @return string
     */
    public function getOverrideReasonId()
    {
        return $this->overrideReasonId;
    }


    /** Exports entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'rph' => $this->getRph(),
            'carrierCode' => $this->getCarrierCode(),
            'nbr' => $this->getNbr(),
            'departDate' => $this->getDepartDate(),
            'marketID' => $this->getMarketID(),
            'seatMap' => $this->getSeatMap()->toArray(),
            'overrideReasonId' => $this->getOverrideReasonId(),
            'adjustedPrice' => $this->getAdjustedPrice(),
            'carrierCode' => $this->getCarrierCode(),
            'origItinerary' => $this->getOrigItinerary()
        );

        return $outputArray;
    }

    /** Exports entity as Json
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /** Populate class fields from stdClass entity
     *
     * @param stdClass $stdClass
     */
    public function fromStdClass($stdClass)
    {

        if (isset($stdClass->nbr) &&
            isset($stdClass->rph) &&
            isset($stdClass->marketID) &&
            isset($stdClass->seatMap) &&
            is_array($stdClass->seatMap) &&
            //isset($stdClass->overrideReasonId) &&
            //isset($stdClass->adjustedPrice) &&
            isset($stdClass->departDate) &&
            isset($stdClass->carrierCode)
            //isset($stdClass->origItinerary)
        ) {
            $this->setNbr($stdClass->nbr);
            $this->setRph($stdClass->rph);
            $this->setMarketID($stdClass->marketID);
            foreach ($stdClass->seatMap as $seatMapStd) {
                $seatMap = new SeatMap();
                $seatMap->fromStdClass($seatMapStd);
                $this->getSeatMap()->addSeatMap($seatMap);
            }
            //$this->setOverrideReasonId($stdClass->overrideReasonId);
            //$this->setAdjustedPrice($stdClass->adjustedPrice);
            $this->setDepartDate($stdClass->departDate);
            $this->setCarrierCode($stdClass->carrierCode);
            //$this->setOrigItinerary($stdClass->origItinerary);
        }
    }

    /**  Populate class fields from JSON
     *
     * @param string $json
     */
    public function fromJson($json)
    {
        $stdClass = json_decode($json);
        $this->fromStdClass($stdClass);
    }

}