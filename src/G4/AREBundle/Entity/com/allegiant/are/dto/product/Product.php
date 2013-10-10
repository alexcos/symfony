<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\Product
 */
class Product
{


    /**
     * @var com\allegiant\are\dto\product\ProductPA $priceAndAvail
     */
    public $priceAndAvail;

    /**
     * @var integer $productID
     */
    public $productID;

    /**
     * @var boolean $freeSell
     */
    public $freeSell;

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
        $this->setPriceAndAvail(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductPA());
    }

    /**
     * Set priceAndAvail
     *
     * @param com\allegiant\are\dto\product\ProductPA $priceAndAvail
     */
    public function setPriceAndAvail(\G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductPA $priceAndAvail)
    {
        $this->priceAndAvail = $priceAndAvail;
    }

    /**
     * Get priceAndAvail
     *
     * @return com\allegiant\are\dto\product\ProductPA
     */
    public function getPriceAndAvail()
    {
        return $this->priceAndAvail;
    }

    /**
     * Set productID
     *
     * @param integer $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }

    /**
     * Get productID
     *
     * @return integer
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * Set freeSell
     *
     * @param boolean $freeSell
     */
    public function setFreeSell($freeSell)
    {
        $this->freeSell = $freeSell;
    }

    /**
     * Get freeSell
     *
     * @return boolean
     */
    public function getFreeSell()
    {
        return $this->freeSell;
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