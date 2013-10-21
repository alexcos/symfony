<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\ClassPriceAndAvail
 */
class ClassPriceAndAvail
{

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent;

    /**
     * @var string $classOfService
     */
    public $classOfService;

    /**
     * @var integer $currentAvail
     */
    public $currentAvail;

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
     * Set classOfService
     *
     * @param string $classOfService class of service
     *
     * @return void
     */
    public function setClassOfService($classOfService)
    {
        $this->classOfService = $classOfService;
    }

    /**
     * Get classOfService
     *
     * @return string 
     */
    public function getClassOfService()
    {
        return $this->classOfService;
    }

    /**
     * Set currentAvail
     *
     * @param integer $currentAvail current availability
     *
     * @return void     
     */
    public function setCurrentAvail($currentAvail)
    {
        $this->currentAvail = $currentAvail;
    }

    /**
     * Get currentAvail
     *
     * @return integer 
     */
    public function getCurrentAvail()
    {
        return $this->currentAvail;
    }
}