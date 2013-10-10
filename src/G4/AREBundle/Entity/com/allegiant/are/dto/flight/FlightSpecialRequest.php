<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightSpecialRequest
 *
 * @see http://50.57.78.111:7074/resweb/cart?xsd=5
 */
class FlightSpecialRequest
{


    /**
     * @var array $priceComponent
     * @see <xs:element name="priceComponent" type="ns1:PriceComponent" nillable="true" minOccurs="0" maxOccurs="unbounded"/>
     */
    public $priceComponent;

    /**
     * @var integer $specialRequestTypeID
     */
    public $specialRequestTypeID;

    /**
     * @var string $comment
     */
    public $comment;


    /**
     * Constructor function
     */
    public function __construct()
    {
    }

    /**
     * Add priceComponent
     *
     * @param com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public function addPriceComponent(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $priceComponent)
    {
        $this->priceComponent[] = $priceComponent;
    }

    /**
     * Set priceComponent
     *
     * @param array $items items of type com\allegiant\are\dto\common\PriceComponent
     */
    public function setPriceComponent(array $items)
    {
        $this->priceComponent = $items;
    }

    /**
     * Get priceComponent
     *
     * @return com\allegiant\are\dto\common\PriceComponent
     */
    public function getPriceComponent()
    {
        return $this->priceComponent;
    }

    /**
     * Set specialRequestTypeID
     *
     * @param integer $specialRequestTypeID
     */
    public function setSpecialRequestTypeID($specialRequestTypeID)
    {
        $this->specialRequestTypeID = $specialRequestTypeID;
    }

    /**
     * Get specialRequestTypeID
     *
     * @return integer
     */
    public function getSpecialRequestTypeID()
    {
        return $this->specialRequestTypeID;
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