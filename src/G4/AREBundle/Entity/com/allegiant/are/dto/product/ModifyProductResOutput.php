<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ModifyProductResOutput
 */
class ModifyProductResOutput
{


    /**
     * @var com\allegiant\are\dto\product\ProductResInfo $productResInfo
     */
    public $productResInfo;

    /**
     * @var string $modifyDateTime
     */
    public $modifyDateTime;


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
}