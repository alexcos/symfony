<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ExclusionPolicy("none")
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\DepartArriveRequest
 */
class DepartArriveRequest
{

    /**
     * @var string $rph
     */
    public $rph;

    /**
     * @var com\allegiant\are\dto\common\DepartArriveRequestType $type
     */
    public $type;

    /**
     * @var boolean $departBased
     */
    public $departBased;

    /**
     * @var string $requestDate
     */
    public $requestDate;

    /**
     * @var integer $requestDateMinusDays how many days before chosen departure date we should search?
     */
    public $requestDateMinusDays;

    /**
     * @var integer $requestDatePlusDays how many days after chosen arrival date we should search
     */
    public $requestDatePlusDays;

    /**
     * @var string $requestTime
     */
    public $requestTime;

    /**
     * @var integer $requestTimeMinusMinutes
     */
    public $requestTimeMinusMinutes;

    /**
     * @var integer $requestTimePlusMinutes
     */
    public $requestTimePlusMinutes;

    /**
     * @var string $departAirport
     */
    public $departAirport;

    /**
     * @var string $arriveAirport
     */
    public $arriveAirport;

    /**
     * @var float $maxDurationHours
     */
    public $maxDurationHours;

    /**
     * @var int $marketID
     */
    public $marketID;

    /** @Exclude */
    private $enumDepartArriveRequestType;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->enumDepartArriveRequestType = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightEnum("DepartArriveRequestType");
        //$this->enum = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightEnum();
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
        $this->rph = (string) $rph;
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
     * Set type
     *
     * @param string $type type
     *
     * @return void
     */
    public function setType($type)
    {
        if ($this->enumDepartArriveRequestType->check($type)) {
            $this->type = $type;

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get type
     *
     * @return com\allegiant\are\dto\common\DepartArriveRequestType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set departBased
     *
     * @param boolean $departBased departure based
     *
     * @return void     
     */
    public function setDepartBased($departBased)
    {
        $this->departBased = (bool) $departBased;
    }

    /**
     * Get departBased
     *
     * @return boolean 
     */
    public function getDepartBased()
    {
        return $this->departBased;
    }

    /**
     * Set requestDate
     *
     * @param string $requestDate request date
     *
     * @return void     
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = date('Y-m-d', strtotime($requestDate));
    }

    /**
     * Get requestDate
     *
     * @return string 
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * Set requestDateMinusDays
     *
     * @param integer $requestDateMinusDays request date minus days
     *
     * @return void
     */
    public function setRequestDateMinusDays($requestDateMinusDays)
    {
        $this->requestDateMinusDays = (int) $requestDateMinusDays;
    }

    /**
     * Get requestDateMinusDays
     *
     * @return integer 
     */
    public function getRequestDateMinusDays()
    {
        return $this->requestDateMinusDays;
    }

    /**
     * Set requestDatePlusDays
     *
     * @param integer $requestDatePlusDays request date plus days
     *
     * @return void
     */
    public function setRequestDatePlusDays($requestDatePlusDays)
    {
        $this->requestDatePlusDays = (int) $requestDatePlusDays;
    }

    /**
     * Get requestDatePlusDays
     *
     * @return integer 
     */
    public function getRequestDatePlusDays()
    {
        return $this->requestDatePlusDays;
    }

    /**
     * Set requestTime
     *
     * @param string $requestTime request time
     *
     * @return void
     */
    public function setRequestTime($requestTime)
    {
        $this->requestTime = date('H:i:s', strtotime($requestTime));
    }

    /**
     * Get requestTime
     *
     * @return string 
     */
    public function getRequestTime()
    {
        return $this->requestTime;
    }

    /**
     * Set requestTimeMinusMinutes
     *
     * @param integer $requestTimeMinusMinutes request time minus minutes
     *
     * @return void     
     */
    public function setRequestTimeMinusMinutes($requestTimeMinusMinutes)
    {
        $this->requestTimeMinusMinutes = (int) $requestTimeMinusMinutes;
    }

    /**
     * Get requestTimeMinusMinutes
     *
     * @return integer 
     */
    public function getRequestTimeMinusMinutes()
    {
        return $this->requestTimeMinusMinutes;
    }

    /**
     * Set requestTimePlusMinutes
     *
     * @param integer $requestTimePlusMinutes request time plus minutes
     *
     * @return void
     */
    public function setRequestTimePlusMinutes($requestTimePlusMinutes)
    {
        $this->requestTimePlusMinutes = (int) $requestTimePlusMinutes;
    }

    /**
     * Get requestTimePlusMinutes
     *
     * @return integer 
     */
    public function getRequestTimePlusMinutes()
    {
        return $this->requestTimePlusMinutes;
    }

    /**
     * Set departAirport
     *
     * @param string $departAirport departure airport
     *
     * @return void
     */
    public function setDepartAirport($departAirport)
    {
        $this->departAirport = $departAirport;
    }

    /**
     * Get departAirport
     *
     * @return string 
     */
    public function getDepartAirport()
    {
        return $this->departAirport;
    }

    /**
     * Set arriveAirport
     *
     * @param string $arriveAirport arrival airport
     *
     * @return void
     */
    public function setArriveAirport($arriveAirport)
    {
        $this->arriveAirport = $arriveAirport;
    }

    /**
     * Get arriveAirport
     *
     * @return string 
     */
    public function getArriveAirport()
    {
        return $this->arriveAirport;
    }

    /**
     * Set maxDurationHours
     *
     * @param float $maxDurationHours maximum duration, expressed in hours
     *
     * @return void
     */
    public function setMaxDurationHours($maxDurationHours)
    {
        $this->maxDurationHours = (float) $maxDurationHours;
    }

    /**
     * Get maxDurationHours
     *
     * @return float 
     */
    public function getMaxDurationHours()
    {
        return $this->maxDurationHours;
    }

     /**
     * Set marketID
     *
     * @param int $marketID market identifier
     *
     * @return void
     */
    public function setMarketID($marketID)
    {
        $this->marketID = (int) $marketID;
    }

    /**
     * Get marketID
     *
     * @return int 
     */
    public function getMarketID()
    {
        return $this->marketID;
    }
}