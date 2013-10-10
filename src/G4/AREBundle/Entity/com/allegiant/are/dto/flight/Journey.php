<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Journey
 */
class Journey
{


    /**
     * @var com\allegiant\are\dto\flight\Segment $segment
     */
    public $segment;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent;

    /**
     * @var array $priceComponentOptional items of type com\allegiant\are\dto\common\PriceComponent
     */
    public $priceComponentOptional;

    /**
     * @var array $flightTraveler items of type com\allegiant\are\dto\flight\FlightTraveler
     */
    public $flightTraveler;

    /**
     * @var integer $sequenceNum
     */
    public $sequenceNum;

    /**
     * @var string $vendorName
     */
    public $vendorName;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setSegment(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Segment());
        $this->setPriceComponent(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
        $this->priceComponentOptional = array();
        $this->flightTraveler = array();
    }

    /**
     * Set segment
     *
     * @param com\allegiant\are\dto\flight\Segment $segment
     */
    public function setSegment(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Segment $segment)
    {
        $this->segment = $segment;
    }

    /**
     * Get segment
     *
     * @return com\allegiant\are\dto\flight\Segment
     */
    public function getSegment()
    {
        return $this->segment;
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
     * Add priceComponentOptional
     *
     * @param com\allegiant\are\dto\common\PriceComponent $priceComponentOptional
     */
    public function addPriceComponentOptional(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $priceComponentOptional)
    {
        $this->priceComponentOptional[] = $priceComponentOptional;
    }

    /**
      * Set priceComponentOptional
      *
      * @param array $items
      */
     public function setPriceComponentOptional(array $items)
     {
         $this->priceComponentOptional = $items;
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
     * Set flightTraveler
     *
     * @param com\allegiant\are\dto\flight\FlightTraveler $flightTraveler
     */
    public function addFlightTraveler(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTraveler $flightTraveler)
    {
        $this->flightTraveler[] = $flightTraveler;
    }

    /**
     * Set flightTraveler
     *
     * @param array $items
     */
    public function setFlightTraveler(array $items)
    {
        $this->flightTraveler = $items;
    }

    /**
     * Get flightTraveler
     *
     * @return com\allegiant\are\dto\flight\FlightTraveler
     */
    public function getFlightTraveler()
    {
        return $this->flightTraveler;
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
     * Set vendorName
     *
     * @param string $vendorName
     */
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;
    }

    /**
     * Get vendorName
     *
     * @return string
     */
    public function getVendorName()
    {
        return $this->vendorName;
    }
}