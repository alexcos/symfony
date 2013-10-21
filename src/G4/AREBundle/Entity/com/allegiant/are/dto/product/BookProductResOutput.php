<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\BookProductResOutput
 */
class BookProductResOutput
{


    /**
     * @var com\allegiant\are\dto\product\ProductResInfo $productResInfo
     */
    public $productResInfo;

    /**
     * @var string $bookingDateTime
     */
    public $bookingDateTime;

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
     * Set bookingDateTime
     *
     * @param string $bookingDateTime
     */
    public function setBookingDateTime($bookingDateTime)
    {
        $this->bookingDateTime = $bookingDateTime;
    }

    /**
     * Get bookingDateTime
     *
     * @return string
     */
    public function getBookingDateTime()
    {
        return $this->bookingDateTime;
    }
}