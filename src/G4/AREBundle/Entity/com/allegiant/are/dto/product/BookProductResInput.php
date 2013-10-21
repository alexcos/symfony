<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;
use G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductRes;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\BookProductResInput
 */
class BookProductResInput extends RequestInput
{

    /**
     * @var com\allegiant\are\dto\product\ProductRes $productRes
     */
    public $productRes;

    /**
     * @var string $bookingDateTime
     */
    public $bookingDateTime;

    /**
     * @var integer $cartID
     */
    public $cartID;

    /**
     * @var integer $locationID
     */
    public $locationID;

    /**
     * @var integer $marketID
     */
    public $marketID;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setProductRes(new ProductRes());
    }

    /**
     * Set productRes
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductRes $productRes
     */
    public function setProductRes(ProductRes $productRes)
    {
        $this->productRes = $productRes;
    }

    /**
     * Get productRes
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductRes
     */
    public function getProductRes()
    {
        return $this->productRes;
    }

    /**
     * Set bookingDateTime
     *
     * @param string $bookingDateTime
     */
    public function setBookingDateTime($bookingDateTime)
    {
        $this->bookingDateTime = $bookingDateTime;
    }

    /**
     * Get bookingDateTime
     *
     * @return string
     */
    public function getBookingDateTime()
    {
        return $this->bookingDateTime;
    }

    /**
     * Set cartID
     *
     * @param integer $cartID
     */
    public function setCartID($cartID)
    {
        $this->cartID = $cartID;
    }

    /**
     * Get cartID
     *
     * @return integer
     */
    public function getCartID()
    {
        return $this->cartID;
    }

    /**
     * Set locationID
     *
     * @param integer $locationID
     */
    public function setLocationID($locationID)
    {
        $this->locationID = $locationID;
    }

    /**
     * Get locationID
     *
     * @return integer
     */
    public function getLocationID()
    {
        return $this->locationID;
    }

    /**
     * Set marketID
     *
     * @param integer $marketID
     */
    public function setMarketID($marketID)
    {
        $this->marketID = $marketID;
    }

    /**
     * Get marketID
     *
     * @return integer
     */
    public function getMarketID()
    {
        return $this->marketID;
    }
}