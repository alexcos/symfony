<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductPA
 */
class ProductPA
{


    /**
     * @var com\allegiant\are\dto\product\Price $price
     */
    public $price;

    /**
     * @var integer $productInvID
     */
    public $productInvID;

    /**
     * @var boolean $refundable
     */
    public $refundable;

    /**
     * @var string $invDate
     */
    public $invDate;

    /**
     * @var string $invTime
     */
    public $invTime;

    /**
     * @var integer $availableQuantity
     */
    public $availableQuantity;

    /**
     * @var integer $ratePlanID
     */
    public $ratePlanID;

    /**
     * @var integer $availCheckMethodID
     */
    public $availCheckMethodID;

    /**
     * @var integer $productInvTypeID
     */
    public $productInvTypeID;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPrice(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\Price());
    }

    /**
     * Set price
     *
     * @param com\allegiant\are\dto\product\Price $price
     */
    public function setPrice(\G4\AREBundle\Entity\com\allegiant\are\dto\product\Price $price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return com\allegiant\are\dto\product\Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set productInvID
     *
     * @param integer $productInvID
     */
    public function setProductInvID($productInvID)
    {
        $this->productInvID = $productInvID;
    }

    /**
     * Get productInvID
     *
     * @return integer
     */
    public function getProductInvID()
    {
        return $this->productInvID;
    }

    /**
     * Set refundable
     *
     * @param boolean $refundable
     */
    public function setRefundable($refundable)
    {
        $this->refundable = $refundable;
    }

    /**
     * Get refundable
     *
     * @return boolean
     */
    public function getRefundable()
    {
        return $this->refundable;
    }

    /**
     * Set invDate
     *
     * @param string $invDate
     */
    public function setInvDate($invDate)
    {
        $this->invDate = $invDate;
    }

    /**
     * Get invDate
     *
     * @return string
     */
    public function getInvDate()
    {
        return $this->invDate;
    }

    /**
     * Set invTime
     *
     * @param string $invTime
     */
    public function setInvTime($invTime)
    {
        $this->invTime = $invTime;
    }

    /**
     * Get invTime
     *
     * @return string
     */
    public function getInvTime()
    {
        return $this->invTime;
    }

    /**
     * Set availableQuantity
     *
     * @param integer $availableQuantity
     */
    public function setAvailableQuantity($availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * Get availableQuantity
     *
     * @return integer
     */
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }

    /**
     * Set ratePlanID
     *
     * @param integer $ratePlanID
     */
    public function setRatePlanID($ratePlanID)
    {
        $this->ratePlanID = $ratePlanID;
    }

    /**
     * Get ratePlanID
     *
     * @return integer
     */
    public function getRatePlanID()
    {
        return $this->ratePlanID;
    }

    /**
     * Set availCheckMethodID
     *
     * @param integer $availCheckMethodID
     */
    public function setAvailCheckMethodID($availCheckMethodID)
    {
        $this->availCheckMethodID = $availCheckMethodID;
    }

    /**
     * Get availCheckMethodID
     *
     * @return integer
     */
    public function getAvailCheckMethodID()
    {
        return $this->availCheckMethodID;
    }

    /**
     * Set productInvTypeID
     *
     * @param integer $productInvTypeID
     */
    public function setProductInvTypeID($productInvTypeID)
    {
        $this->productInvTypeID = $productInvTypeID;
    }

    /**
     * Get productInvTypeID
     *
     * @return integer
     */
    public function getProductInvTypeID()
    {
        return $this->productInvTypeID;
    }
}