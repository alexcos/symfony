<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\Discount
 */
class Discount
{


    /**
     * @var integer $discountID
     */
    public $discountID;

    /**
     * @var boolean $isPercentage
     */
    public $isPercentage;

    /**
     * @var float $value
     */
    public $value;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set discountID
     *
     * @param integer $discountID
     */
    public function setDiscountID($discountID)
    {
        $this->discountID = $discountID;
    }

    /**
     * Get discountID
     *
     * @return integer
     */
    public function getDiscountID()
    {
        return $this->discountID;
    }

    /**
     * Set isPercentage
     *
     * @param boolean $isPercentage
     */
    public function setIsPercentage($isPercentage)
    {
        $this->isPercentage = $isPercentage;
    }

    /**
     * Get isPercentage
     *
     * @return boolean
     */
    public function getIsPercentage()
    {
        return $this->isPercentage;
    }

    /**
     * Set value
     *
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}