<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\CancelProductResInput
 */
class CancelProductResInput
{


    /**
     * @var com\allegiant\are\dto\product\ProductResInfo $productResInfo
     */
    public $productResInfo;

    /**
     * @var string $cancelDateTime
     */
    public $cancelDateTime;

    /**
     * @var integer $cancelTypeID
     */
    public $cancelTypeID;

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
     * Constructor
     */
    public function __construct()
    {
        $this->setProductResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResInfo());
    }

    /**
     * Set productResInfo
     *
     * @param com\allegiant\are\dto\product\ProductResInfo $productResInfo
     */
    public function setProductResInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResInfo $productResInfo)
    {
        $this->productResInfo = $productResInfo;
    }

    /**
     * Get productResInfo
     *
     * @return com\allegiant\are\dto\product\ProductResInfo
     */
    public function getProductResInfo()
    {
        return $this->productResInfo;
    }

    /**
     * Set cancelDateTime
     *
     * @param string $cancelDateTime
     */
    public function setCancelDateTime($cancelDateTime)
    {
        $this->cancelDateTime = $cancelDateTime;
    }

    /**
     * Get cancelDateTime
     *
     * @return string
     */
    public function getCancelDateTime()
    {
        return $this->cancelDateTime;
    }

    /**
     * Set cancelTypeID
     *
     * @param integer $cancelTypeID
     */
    public function setCancelTypeID($cancelTypeID)
    {
        $this->cancelTypeID = $cancelTypeID;
    }

    /**
     * Get cancelTypeID
     *
     * @return integer
     */
    public function getCancelTypeID()
    {
        return $this->cancelTypeID;
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