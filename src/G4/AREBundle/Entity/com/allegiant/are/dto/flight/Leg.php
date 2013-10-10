<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Leg
 */
class Leg
{
    /**
     * @var com\allegiant\are\dto\flight\Equipment $equipment
     */
    public $equipment;

    /**
     * @var com\allegiant\are\dto\common\Airport $departAirport
     */
    public $departAirport;

    /**
     * @var com\allegiant\are\dto\common\Airport $arriveAirport
     */
    public $arriveAirport;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponentOptional
     */
    public $priceComponentOptional;

    /**
     * @var integer $sequenceNum
     */
    public $sequenceNum;

    /**
     * @var string $departTerminal
     */
    public $departTerminal;

    /**
     * @var string $departDateTime
     */
    public $departDateTime;

    /**
     * @var string $arriveTerminal
     */
    public $arriveTerminal;

    /**
     * @var string $arriveDateTime
     */
    public $arriveDateTime;

    /**
     * @var integer $miles
     */
    public $miles;

    /**
     * @var integer $duration
     */
    public $duration;

    /**
     * @var boolean $disembarkAtArrival
     */
    public $disembarkAtArrival;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setEquipment(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Equipment());
        $this->setDepartAirport(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Airport());
        $this->setArriveAirport(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Airport());
        $this->setPriceComponent(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
        $this->setPriceComponentOptional(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
    }

    /**
     * Set equipment
     *
     * @param com\allegiant\are\dto\flight\Equipment $equipment
     */
    public function setEquipment(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Equipment $equipment)
    {
        $this->equipment = $equipment;
    }

    /**
     * Get equipment
     *
     * @return com\allegiant\are\dto\flight\Equipment
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Set departAirport
     *
     * @param com\allegiant\are\dto\common\Airport $departAirport
     */
    public function setDepartAirport(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Airport $departAirport)
    {
        $this->departAirport = $departAirport;
    }

    /**
     * Get departAirport
     *
     * @return com\allegiant\are\dto\common\Airport
     */
    public function getDepartAirport()
    {
        return $this->departAirport;
    }

    /**
     * Set arriveAirport
     *
     * @param com\allegiant\are\dto\common\Airport $arriveAirport
     */
    public function setArriveAirport(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Airport $arriveAirport)
    {
        $this->arriveAirport = $arriveAirport;
    }

    /**
     * Get arriveAirport
     *
     * @return com\allegiant\are\dto\common\Airport
     */
    public function getArriveAirport()
    {
        return $this->arriveAirport;
    }

    /**
     * Set priceComponent
     *
     * @param com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public function setPriceComponent(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $priceComponent)
    {
        $this->priceComponent = $priceComponent;
    }

    /**
     * Get priceComponent
     *
     * @return com\allegiant\are\dto\common\PriceComponent
     */
    public function getPriceComponent()
    {
        return $this->priceComponent;
    }

    /**
     * Set priceComponentOptional
     *
     * @param com\allegiant\are\dto\common\PriceComponent $priceComponentOptional
     */
    public function setPriceComponentOptional(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $priceComponentOptional)
    {
        $this->priceComponentOptional = $priceComponentOptional;
    }

    /**
     * Get priceComponentOptional
     *
     * @return com\allegiant\are\dto\common\PriceComponent
     */
    public function getPriceComponentOptional()
    {
        return $this->priceComponentOptional;
    }

    /**
     * Set sequenceNum
     *
     * @param integer $sequenceNum
     */
    public function setSequenceNum($sequenceNum)
    {
        $this->sequenceNum = $sequenceNum;
    }

    /**
     * Get sequenceNum
     *
     * @return integer
     */
    public function getSequenceNum()
    {
        return $this->sequenceNum;
    }

    /**
     * Set departTerminal
     *
     * @param string $departTerminal
     */
    public function setDepartTerminal($departTerminal)
    {
        $this->departTerminal = $departTerminal;
    }

    /**
     * Get departTerminal
     *
     * @return string
     */
    public function getDepartTerminal()
    {
        return $this->departTerminal;
    }

    /**
     * Set departDateTime
     *
     * @param string $departDateTime
     */
    public function setDepartDateTime($departDateTime)
    {
        $this->departDateTime = $departDateTime;
    }

    /**
     * Get departDateTime
     *
     * @return string
     */
    public function getDepartDateTime()
    {
        return $this->departDateTime;
    }

    /**
     * Set arriveTerminal
     *
     * @param string $arriveTerminal
     */
    public function setArriveTerminal($arriveTerminal)
    {
        $this->arriveTerminal = $arriveTerminal;
    }

    /**
     * Get arriveTerminal
     *
     * @return string
     */
    public function getArriveTerminal()
    {
        return $this->arriveTerminal;
    }

    /**
     * Set arriveDateTime
     *
     * @param string $arriveDateTime
     */
    public function setArriveDateTime($arriveDateTime)
    {
        $this->arriveDateTime = $arriveDateTime;
    }

    /**
     * Get arriveDateTime
     *
     * @return string
     */
    public function getArriveDateTime()
    {
        return $this->arriveDateTime;
    }

    /**
     * Set miles
     *
     * @param integer $miles
     */
    public function setMiles($miles)
    {
        $this->miles = $miles;
    }

    /**
     * Get miles
     *
     * @return integer
     */
    public function getMiles()
    {
        return $this->miles;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set disembarkAtArrival
     *
     * @param boolean $disembarkAtArrival
     */
    public function setDisembarkAtArrival($disembarkAtArrival)
    {
        $this->disembarkAtArrival = $disembarkAtArrival;
    }

    /**
     * Get disembarkAtArrival
     *
     * @return boolean
     */
    public function getDisembarkAtArrival()
    {
        return $this->disembarkAtArrival;
    }
}