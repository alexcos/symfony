<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\GetProductAvailOutput
 */
class GetProductAvailOutput
{


    /**
     * @var com\allegiant\are\dto\product\ProductBrand $productBrand
     */
    public $productBrand;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setProductBrand(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductBrand());
    }

    /**
     * Set productBrand
     *
     * @param com\allegiant\are\dto\product\ProductBrand $productBrand
     */
    public function setProductBrand(\G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductBrand $productBrand)
    {
        $this->productBrand = $productBrand;
    }

    /**
     * Get productBrand
     *
     * @return com\allegiant\are\dto\product\ProductBrand
     */
    public function getProductBrand()
    {
        return $this->productBrand;
    }
}