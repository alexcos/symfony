<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ModifyProductResInput
 */
class ModifyProductResInput
{


    /**
     * @var com\allegiant\are\dto\product\ProductRes $productRes
     */
    public $productRes;

    /**
     * @var string $modifyDateTime
     */
    public $modifyDateTime;

    /**
     * @var boolean $waiveFees
     */
    public $waiveFees;

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
        $this->setProductRes(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductRes());
    }

    /**
     * Set productRes
     *
     * @param com\allegiant\are\dto\product\ProductRes $productRes
     */
    public function setProductRes(\G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductRes $productRes)
    {
        $this->productRes = $productRes;
    }

    /**
     * Get productRes
     *
     * @return com\allegiant\are\dto\product\ProductRes
     */
    public function getProductRes()
    {
        return $this->productRes;
    }

    /**
     * Set modifyDateTime
     *
     * @param string $modifyDateTime
     */
    public function setModifyDateTime($modifyDateTime)
    {
        $this->modifyDateTime = $modifyDateTime;
    }

    /**
     * Get modifyDateTime
     *
     * @return string
     */
    public function getModifyDateTime()
    {
        return $this->modifyDateTime;
    }

    /**
     * Set waiveFees
     *
     * @param boolean $waiveFees
     */
    public function setWaiveFees($waiveFees)
    {
        $this->waiveFees = $waiveFees;
    }

    /**
     * Get waiveFees
     *
     * @return boolean
     */
    public function getWaiveFees()
    {
        return $this->waiveFees;
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