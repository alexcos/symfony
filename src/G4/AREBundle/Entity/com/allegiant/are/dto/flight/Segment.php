<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Segment
 */
class Segment
{


    /**
     * @var com\allegiant\are\dto\flight\Leg $leg
     */
    public $leg;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponentOptional
     */
    public $priceComponentOptional;

    /**
     * @var com\allegiant\are\dto\flight\ClassPriceAndAvail $classPriceAndAvail
     */
    public $classPriceAndAvail;

    /**
     * @var string $flightNbr
     */
    public $flightNbr;

    /**
     * @var string $airlineCode
     */
    public $airlineCode;

    /**
     * @var string $operatorCode
     */
    public $operatorCode;

    /**
     * @var integer $sequenceNum
     */
    public $sequenceNum;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setLeg(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Leg());
        $this->setPriceComponent(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
        $this->setPriceComponentOptional(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
        $this->setClassPriceAndAvail(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\ClassPriceAndAvail());
    }

    /**
     * Set leg
     *
     * @param com\allegiant\are\dto\flight\Leg $leg
     */
    public function setLeg(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Leg $leg)
    {
        $this->leg = $leg;
    }

    /**
     * Get leg
     *
     * @return com\allegiant\are\dto\flight\Leg
     */
    public function getLeg()
    {
        return $this->leg;
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
     * Set classPriceAndAvail
     *
     * @param com\allegiant\are\dto\flight\ClassPriceAndAvail $classPriceAndAvail
     */
    public function setClassPriceAndAvail(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\ClassPriceAndAvail $classPriceAndAvail)
    {
        $this->classPriceAndAvail = $classPriceAndAvail;
    }

    /**
     * Get classPriceAndAvail
     *
     * @return com\allegiant\are\dto\flight\ClassPriceAndAvail
     */
    public function getClassPriceAndAvail()
    {
        return $this->classPriceAndAvail;
    }

    /**
     * Set flightNbr
     *
     * @param string $flightNbr
     */
    public function setFlightNbr($flightNbr)
    {
        $this->flightNbr = $flightNbr;
    }

    /**
     * Get flightNbr
     *
     * @return string
     */
    public function getFlightNbr()
    {
        return $this->flightNbr;
    }

    /**
     * Set airlineCode
     *
     * @param string $airlineCode
     */
    public function setAirlineCode($airlineCode)
    {
        $this->airlineCode = $airlineCode;
    }

    /**
     * Get airlineCode
     *
     * @return string
     */
    public function getAirlineCode()
    {
        return $this->airlineCode;
    }

    /**
     * Set operatorCode
     *
     * @param string $operatorCode
     */
    public function setOperatorCode($operatorCode)
    {
        $this->operatorCode = $operatorCode;
    }

    /**
     * Get operatorCode
     *
     * @return string
     */
    public function getOperatorCode()
    {
        return $this->operatorCode;
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
}