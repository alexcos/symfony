<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\JourneySet
 */
class JourneySet
{


    /**
     * @var com\allegiant\are\dto\flight\Journey $journey
     */
    public $journey;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponentOptional
     */
    public $priceComponentOptional;

    /**
     * @var string $requestRPH
     */
    public $requestRPH;


    /**
     * Constructor function
     */
    public function __construct()
    {
        //$this->setJourney(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Journey());
        $this->setPriceComponent(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
        $this->setPriceComponentOptional(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
    }

    /**
     * Set journey
     *
     * @param com\allegiant\are\dto\flight\Journey $journey
     */
    public function setJourney($journey) //\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Journey
    {
        $this->journey[] = $journey;
    }

    /**
     * Get journey
     *
     * @return com\allegiant\are\dto\flight\Journey
     */
    public function getJourney()
    {
        return $this->journey;
    }

    /**
     * Set priceComponent
     *
     * @param com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public function setPriceComponent(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $priceComponent)
    {
        $this->priceComponent[] = $priceComponent;
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
        $this->priceComponentOptional[] = $priceComponentOptional;
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
     * Set requestRPH
     *
     * @param string $requestRPH
     */
    public function setRequestRPH($requestRPH)
    {
        $this->requestRPH = $requestRPH;
    }

    /**
     * Get requestRPH
     *
     * @return string
     */
    public function getRequestRPH()
    {
        return $this->requestRPH;
    }
}