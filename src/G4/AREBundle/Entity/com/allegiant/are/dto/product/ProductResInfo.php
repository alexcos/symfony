<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResInfo
 */
class ProductResInfo
{


    /**
     * @var com\allegiant\are\dto\product\ProductResConf $productResConf
     */
    public $productResConf;

    /**
     * @var integer $productResID
     */
    public $productResID;

    /**
     * @var string $comment
     */
    public $comment;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setProductResConf(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResConf());
    }

    /**
     * Set productResConf
     *
     * @param com\allegiant\are\dto\product\ProductResConf $productResConf
     */
    public function setProductResConf(\G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResConf $productResConf)
    {
        $this->productResConf = $productResConf;
    }

    /**
     * Get productResConf
     *
     * @return com\allegiant\are\dto\product\ProductResConf
     */
    public function getProductResConf()
    {
        return $this->productResConf;
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
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}