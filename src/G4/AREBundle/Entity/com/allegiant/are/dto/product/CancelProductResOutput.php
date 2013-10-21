<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\CancelProductResOutput
 */
class CancelProductResOutput
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
     * Class constructor
     *
     * @return void
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
}