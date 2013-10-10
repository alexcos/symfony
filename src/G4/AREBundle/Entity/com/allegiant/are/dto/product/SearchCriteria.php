<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\SearchCriteria
 */
class SearchCriteria
{


    /**
     * @var string $promoCode
     */
    public $promoCode;

    /**
     * @var integer $productBrandID
     */
    public $productBrandID;

    /**
     * @var array $productID
     */
    public $productID;

    /**
     * @var string $travelStartDate
     */
    public $travelStartDate;

    /**
     * @var string $travelEndDate
     */
    public $travelEndDate;

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
        $this->productID = array();
    }

    /**
     * Set promoCode
     *
     * @param string $promoCode
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;
    }

    /**
     * Get promoCode
     *
     * @return string
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set productBrandID
     *
     * @param integer $productBrandID
     */
    public function setProductBrandID($productBrandID)
    {
        $this->productBrandID = $productBrandID;
    }

    /**
     * Get productBrandID
     *
     * @return integer
     */
    public function getProductBrandID()
    {
        return $this->productBrandID;
    }

    /**
     * Set productID
     *
     * @param array $productID
     */
    public function setProductID($productID)
    {
        $this->productID[] = $productID;
    }

    /**
     * Get productID
     *
     * @return array
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * Set travelStartDate
     *
     * @param string $travelStartDate
     */
    public function setTravelStartDate($travelStartDate)
    {
        $this->travelStartDate = $travelStartDate;
    }

    /**
     * Get travelStartDate
     *
     * @return string
     */
    public function getTravelStartDate()
    {
        return $this->travelStartDate;
    }

    /**
     * Set travelEndDate
     *
     * @param string $travelEndDate
     */
    public function setTravelEndDate($travelEndDate)
    {
        $this->travelEndDate = $travelEndDate;
    }

    /**
     * Get travelEndDate
     *
     * @return string
     */
    public function getTravelEndDate()
    {
        return $this->travelEndDate;
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