<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResDetail;
use G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResSpecialRequest;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductRes
 *
 * @see http://50.57.78.111:7074/resweb/cart?xsd=3
 */
class ProductRes
{
    /**
     * @var array $productResDetail items of type com\allegiant\are\dto\product\ProductResDetail
     */
    public $productResDetail;

    /**
     * @var com\allegiant\are\dto\product\ProductResSpecialRequest $specialRequest
     */
    public $specialRequest;

    /**
     * @var integer $productResID
     */
    public $productResID;

    /**
     * @var float $totalPrice
     */
    public $totalPrice;

    /**
     * @var integer $quantity
     */
    public $quantity;

    /**
     * @var integer $originalProductInvID
     */
    public $originalProductInvID;

    /**
     * @var integer $originalRatePlanID
     */
    public $originalRatePlanID;

    /**
     * @var string $resDate
     */
    public $resDate;

    /**
     * @var string $resTime
     */
    public $resTime;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->productResDetail = array();
    }

    /**
     * Add productResDetail
     *
     * @param G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResDetail $item
     */
    public function addProductResDetail(ProductResDetail $item)
    {
        $this->productResDetail[] = $item;
    }

    /**
     * Set productResDetail
     *
     * @param array $items items of type G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResDetail
     */
    public function setProductResDetail(array $items)
    {
        $this->productResDetail = $items;
    }

    /**
     * Get productResDetail
     *
     * @return com\allegiant\are\dto\product\ProductResDetail
     */
    public function getProductResDetail()
    {
        return $this->productResDetail;
    }

    /**
     * Add specialRequest
     *
     * @param com\allegiant\are\dto\product\ProductResSpecialRequest $specialRequest
     */
    public function addSpecialRequest(ProductResSpecialRequest $specialRequest)
    {
        $this->specialRequest[] = $specialRequest;
    }

    /**
     * Set specialRequest
     *
     * @param array $items
     */
    public function setSpecialRequest(array $items)
    {
        $this->specialRequest = $items;
    }

    /**
     * Get specialRequest
     *
     * @return com\allegiant\are\dto\product\ProductResSpecialRequest
     */
    public function getSpecialRequest()
    {
        return $this->specialRequest;
    }

    /**
     * Set productResID
     *
     * @param integer $productResID
     */
    public function setProductResID($productResID)
    {
        $this->productResID = $productResID;
    }

    /**
     * Get productResID
     *
     * @return integer
     */
    public function getProductResID()
    {
        return $this->productResID;
    }

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
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
     * Set originalProductInvID
     *
     * @param integer $originalProductInvID
     */
    public function setOriginalProductInvID($originalProductInvID)
    {
        $this->originalProductInvID = $originalProductInvID;
    }

    /**
     * Get originalProductInvID
     *
     * @return integer
     */
    public function getOriginalProductInvID()
    {
        return $this->originalProductInvID;
    }

    /**
     * Set originalRatePlanID
     *
     * @param integer $originalRatePlanID
     */
    public function setOriginalRatePlanID($originalRatePlanID)
    {
        $this->originalRatePlanID = $originalRatePlanID;
    }

    /**
     * Get originalRatePlanID
     *
     * @return integer
     */
    public function getOriginalRatePlanID()
    {
        return $this->originalRatePlanID;
    }

    /**
     * Set resDate
     *
     * @param string $resDate
     */
    public function setResDate($resDate)
    {
        $this->resDate = $resDate;
    }

    /**
     * Get resDate
     *
     * @return string
     */
    public function getResDate()
    {
        return $this->resDate;
    }

    /**
     * Set resTime
     *
     * @param string $resTime
     */
    public function setResTime($resTime)
    {
        $this->resTime = $resTime;
    }

    /**
     * Get resTime
     *
     * @return string
     */
    public function getResTime()
    {
        return $this->resTime;
    }
}