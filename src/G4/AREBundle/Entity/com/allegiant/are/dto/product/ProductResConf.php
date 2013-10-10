<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResConf
 */
class ProductResConf
{


    /**
     * @var integer $productResConfID
     */
    public $productResConfID;

    /**
     * @var integer $productResConfTypeID
     */
    public $productResConfTypeID;

    /**
     * @var integer $productResSourceID
     */
    public $productResSourceID;

    /**
     * @var string $confNbr
     */
    public $confNbr;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set productResConfID
     *
     * @param integer $productResConfID
     */
    public function setProductResConfID($productResConfID)
    {
        $this->productResConfID = $productResConfID;
    }

    /**
     * Get productResConfID
     *
     * @return integer
     */
    public function getProductResConfID()
    {
        return $this->productResConfID;
    }

    /**
     * Set productResConfTypeID
     *
     * @param integer $productResConfTypeID
     */
    public function setProductResConfTypeID($productResConfTypeID)
    {
        $this->productResConfTypeID = $productResConfTypeID;
    }

    /**
     * Get productResConfTypeID
     *
     * @return integer
     */
    public function getProductResConfTypeID()
    {
        return $this->productResConfTypeID;
    }

    /**
     * Set productResSourceID
     *
     * @param integer $productResSourceID
     */
    public function setProductResSourceID($productResSourceID)
    {
        $this->productResSourceID = $productResSourceID;
    }

    /**
     * Get productResSourceID
     *
     * @return integer
     */
    public function getProductResSourceID()
    {
        return $this->productResSourceID;
    }

    /**
     * Set confNbr
     *
     * @param string $confNbr
     */
    public function setConfNbr($confNbr)
    {
        $this->confNbr = $confNbr;
    }

    /**
     * Get confNbr
     *
     * @return string
     */
    public function getConfNbr()
    {
        return $this->confNbr;
    }
}