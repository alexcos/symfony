<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightDiscount
 */
class FlightDiscount
{

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent;

    /**
     * @var string $flightRPH
     */
    public $flightRPH;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPriceComponent(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
    }

    /**
     * Set priceComponent
     *
     * @param com\allegiant\are\dto\common\PriceComponent $priceComponent price component
     *
     * @return void
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
     * Set flightRPH
     *
     * @param string $flightRPH
     *
     * @return void     
     */
    public function setFlightRPH($flightRPH)
    {
        $this->flightRPH = $flightRPH;
    }

    /**
     * Get flightRPH
     *
     * @return string 
     */
    public function getFlightRPH()
    {
        return $this->flightRPH;
    }
}