<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\Price
 */
class Price
{


    /**
     * @var com\allegiant\are\dto\product\Cost $cost
     */
    public $cost;

    /**
     * @var com\allegiant\are\dto\product\MarkUp $markUp
     */
    public $markUp;

    /**
     * @var com\allegiant\are\dto\product\Discount $discount
     */
    public $discount;

    /**
     * @var integer $guestTypeID
     */
    public $guestTypeID;

    /**
     * @var float $unitPrice
     */
    public $unitPrice;

    /**
     * @var integer $minAge
     */
    public $minAge;

    /**
     * @var integer $maxAge
     */
    public $maxAge;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCost(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\Cost());
        $this->setMarkUp(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\MarkUp());
        $this->setDiscount(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\Discount());
    }

    /**
     * Set cost
     *
     * @param com\allegiant\are\dto\product\Cost $cost
     */
    public function setCost(\G4\AREBundle\Entity\com\allegiant\are\dto\product\Cost $cost)
    {
        $this->cost = $cost;
    }

    /**
     * Get cost
     *
     * @return com\allegiant\are\dto\product\Cost
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set markUp
     *
     * @param com\allegiant\are\dto\product\MarkUp $markUp
     */
    public function setMarkUp(\G4\AREBundle\Entity\com\allegiant\are\dto\product\MarkUp $markUp)
    {
        $this->markUp = $markUp;
    }

    /**
     * Get markUp
     *
     * @return com\allegiant\are\dto\product\MarkUp
     */
    public function getMarkUp()
    {
        return $this->markUp;
    }

    /**
     * Set discount
     *
     * @param com\allegiant\are\dto\product\Discount $discount
     */
    public function setDiscount(\G4\AREBundle\Entity\com\allegiant\are\dto\product\Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Get discount
     *
     * @return com\allegiant\are\dto\product\Discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set guestTypeID
     *
     * @param integer $guestTypeID
     */
    public function setGuestTypeID($guestTypeID)
    {
        $this->guestTypeID = $guestTypeID;
    }

    /**
     * Get guestTypeID
     *
     * @return integer
     */
    public function getGuestTypeID()
    {
        return $this->guestTypeID;
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

    /**
     * Set minAge
     *
     * @param integer $minAge
     */
    public function setMinAge($minAge)
    {
        $this->minAge = $minAge;
    }

    /**
     * Get minAge
     *
     * @return integer
     */
    public function getMinAge()
    {
        return $this->minAge;
    }

    /**
     * Set maxAge
     *
     * @param integer $maxAge
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = $maxAge;
    }

    /**
     * Get maxAge
     *
     * @return integer
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }
}