<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\Cost
 */
class Cost
{


    /**
     * @var integer $costTypeID
     */
    public $costTypeID;

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
     * Set costTypeID
     *
     * @param integer $costTypeID
     */
    public function setCostTypeID($costTypeID)
    {
        $this->costTypeID = $costTypeID;
    }

    /**
     * Get costTypeID
     *
     * @return integer
     */
    public function getCostTypeID()
    {
        return $this->costTypeID;
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