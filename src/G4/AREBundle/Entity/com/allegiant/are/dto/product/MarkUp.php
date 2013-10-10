<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\MarkUp
 */
class MarkUp
{


    /**
     * @var integer $markUpTypeID
     */
    public $markUpTypeID;

    /**
     * @var boolean $isPercentage
     */
    public $isPercentage;

    /**
     * @var float $value
     */
    public $value;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Set markUpTypeID
     *
     * @param integer $markUpTypeID
     */
    public function setMarkUpTypeID($markUpTypeID)
    {
        $this->markUpTypeID = $markUpTypeID;
    }

    /**
     * Get markUpTypeID
     *
     * @return integer
     */
    public function getMarkUpTypeID()
    {
        return $this->markUpTypeID;
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