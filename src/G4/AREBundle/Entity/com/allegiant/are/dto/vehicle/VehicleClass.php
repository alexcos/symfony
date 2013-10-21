<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleClass
 */
class VehicleClass
{


    /**
     * @var com\allegiant\are\dto\vehicle\VehiclePA $pricingAndAvail
     */
    public $pricingAndAvail;

    /**
     * @var integer $idd
     */
    public $idd;

    /**
     * @var integer $vehicleTypeID
     */
    public $vehicleTypeID;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var integer $maxPaxAllowed
     */
    public $maxPaxAllowed;

    /**
     * @var integer $maxPaxRecommended
     */
    public $maxPaxRecommended;

    /**
     * @var integer $maxBags
     */
    public $maxBags;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPricingAndAvail(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehiclePA());
    }

    /**
     * Set pricingAndAvail
     *
     * @param com\allegiant\are\dto\vehicle\VehiclePA $pricingAndAvail
     */
    public function setPricingAndAvail(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehiclePA $pricingAndAvail)
    {
        $this->pricingAndAvail = $pricingAndAvail;
    }

    /**
     * Get pricingAndAvail
     *
     * @return com\allegiant\are\dto\vehicle\VehiclePA
     */
    public function getPricingAndAvail()
    {
        return $this->pricingAndAvail;
    }

    /**
     * Set idd
     *
     * @param integer $idd
     */
    public function setIdd($idd)
    {
        $this->idd = $idd;
    }

    /**
     * Get idd
     *
     * @return integer
     */
    public function getIdd()
    {
        return $this->idd;
    }

    /**
     * Set vehicleTypeID
     *
     * @param integer $vehicleTypeID
     */
    public function setVehicleTypeID($vehicleTypeID)
    {
        $this->vehicleTypeID = $vehicleTypeID;
    }

    /**
     * Get vehicleTypeID
     *
     * @return integer
     */
    public function getVehicleTypeID()
    {
        return $this->vehicleTypeID;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxPaxAllowed
     *
     * @param integer $maxPaxAllowed
     */
    public function setMaxPaxAllowed($maxPaxAllowed)
    {
        $this->maxPaxAllowed = $maxPaxAllowed;
    }

    /**
     * Get maxPaxAllowed
     *
     * @return integer
     */
    public function getMaxPaxAllowed()
    {
        return $this->maxPaxAllowed;
    }

    /**
     * Set maxPaxRecommended
     *
     * @param integer $maxPaxRecommended
     */
    public function setMaxPaxRecommended($maxPaxRecommended)
    {
        $this->maxPaxRecommended = $maxPaxRecommended;
    }

    /**
     * Get maxPaxRecommended
     *
     * @return integer
     */
    public function getMaxPaxRecommended()
    {
        return $this->maxPaxRecommended;
    }

    /**
     * Set maxBags
     *
     * @param integer $maxBags
     */
    public function setMaxBags($maxBags)
    {
        $this->maxBags = $maxBags;
    }

    /**
     * Get maxBags
     *
     * @return integer
     */
    public function getMaxBags()
    {
        return $this->maxBags;
    }
}