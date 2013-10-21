<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTraveler;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResDetail
 */
class ProductResDetail
{


    /**
     * @var array $traveler items of type \G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTraveler
     */
    public $traveler;

    /**
     * @var integer $quantity
     */
    public $quantity;

    /**
     * @var float $unitPrice
     */
    public $unitPrice;

    /**
     * @var integer $guestTypeID
     */
    public $guestTypeID;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->traveler = array();
    }

    /**
     * Add traveler
     *
     * @param ResTraveler $traveler
     */
    public function addTraveler(ResTraveler $traveler)
    {
        $this->traveler[] = $traveler;
    }

    /**
     * Set traveler
     *
     * @param array $items
     */
    public function setTraveler(array $items)
    {
        $this->traveler = $items;
    }

    /**
     * Get traveler
     *
     * @return com\allegiant\are\dto\common\ResTraveler
     */
    public function getTraveler()
    {
        return $this->traveler;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
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
}