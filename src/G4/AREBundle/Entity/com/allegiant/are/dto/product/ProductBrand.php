<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductBrand
 */
class ProductBrand
{


    /**
     * @var com\allegiant\are\dto\product\Product $product
     */
    public $product;

    /**
     * @var integer $productBrandID
     */
    public $productBrandID;

    /**
     * @var string $productBrandName
     */
    public $productBrandName;

    /**
     * @var integer $productBrandTypeID
     */
    public $productBrandTypeID;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setProduct(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\Product());
    }

    /**
     * Set product
     *
     * @param com\allegiant\are\dto\product\Product $product
     */
    public function setProduct(\G4\AREBundle\Entity\com\allegiant\are\dto\product\Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get product
     *
     * @return com\allegiant\are\dto\product\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set productBrandID
     *
     * @param integer $productBrandID
     */
    public function setProductBrandID($productBrandID)
    {
        $this->productBrandID = $productBrandID;
    }

    /**
     * Get productBrandID
     *
     * @return integer
     */
    public function getProductBrandID()
    {
        return $this->productBrandID;
    }

    /**
     * Set productBrandName
     *
     * @param string $productBrandName
     */
    public function setProductBrandName($productBrandName)
    {
        $this->productBrandName = $productBrandName;
    }

    /**
     * Get productBrandName
     *
     * @return string
     */
    public function getProductBrandName()
    {
        return $this->productBrandName;
    }

    /**
     * Set productBrandTypeID
     *
     * @param integer $productBrandTypeID
     */
    public function setProductBrandTypeID($productBrandTypeID)
    {
        $this->productBrandTypeID = $productBrandTypeID;
    }

    /**
     * Get productBrandTypeID
     *
     * @return integer
     */
    public function getProductBrandTypeID()
    {
        return $this->productBrandTypeID;
    }
}