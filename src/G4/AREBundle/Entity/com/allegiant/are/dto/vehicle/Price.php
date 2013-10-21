<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Price
 */
class Price
{


    /**
     * @var com\allegiant\are\dto\vehicle\Cost $cost
     */
    public $cost;

    /**
     * @var com\allegiant\are\dto\vehicle\MarkUp $markUp
     */
    public $markUp;

    /**
     * @var com\allegiant\are\dto\vehicle\Discount $discount
     */
    public $discount;

    /**
     * @var integer $vehicleDurationTypeID
     */
    public $vehicleDurationTypeID;

    /**
     * @var float $unitPrice
     */
    public $unitPrice;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCost(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Cost());
        $this->setMarkUp(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\MarkUp());
        $this->setDiscount(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Discount());
    }

    /**
     * Set cost
     *
     * @param com\allegiant\are\dto\vehicle\Cost $cost
     */
    public function setCost(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Cost $cost)
    {
        $this->cost = $cost;
    }

    /**
     * Get cost
     *
     * @return com\allegiant\are\dto\vehicle\Cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set markUp
     *
     * @param com\allegiant\are\dto\vehicle\MarkUp $markUp
     */
    public function setMarkUp(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\MarkUp $markUp)
    {
        $this->markUp = $markUp;
    }

    /**
     * Get markUp
     *
     * @return com\allegiant\are\dto\vehicle\MarkUp
     */
    public function getMarkUp()
    {
        return $this->markUp;
    }

    /**
     * Set discount
     *
     * @param com\allegiant\are\dto\vehicle\Discount $discount
     */
    public function setDiscount(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Get discount
     *
     * @return com\allegiant\are\dto\vehicle\Discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set vehicleDurationTypeID
     *
     * @param integer $vehicleDurationTypeID
     */
    public function setVehicleDurationTypeID($vehicleDurationTypeID)
    {
        $this->vehicleDurationTypeID = $vehicleDurationTypeID;
    }

    /**
     * Get vehicleDurationTypeID
     *
     * @return integer
     */
    public function getVehicleDurationTypeID()
    {
        return $this->vehicleDurationTypeID;
    }

    /**
     * Set unitPrice
     *
     * @param float $unitPrice
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * Get unitPrice
     *
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }
}