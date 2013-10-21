<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartResConfNbr
 */
class CartResConfNbr
{


    /**
     * @var string $nbr
     */
    public $nbr;

    /**
     * @var integer $sourceID
     */
    public $sourceID;

    /**
     * @var integer $typeID
     */
    public $typeID;

    /**
     * Constructor function
     */
    public function __construct()
    {
    }

    /**
     * Set nbr
     *
     * @param string $nbr
     */
    public function setNbr($nbr)
    {
        $this->nbr = $nbr;
    }

    /**
     * Get nbr
     *
     * @return string
     */
    public function getNbr()
    {
        return $this->nbr;
    }

    /**
     * Set sourceID
     *
     * @param integer $sourceID
     */
    public function setSourceID($sourceID)
    {
        $this->sourceID = $sourceID;
    }

    /**
     * Get sourceID
     *
     * @return integer
     */
    public function getSourceID()
    {
        return $this->sourceID;
    }

    /**
     * Set typeID
     *
     * @param integer $typeID
     */
    public function setTypeID($typeID)
    {
        $this->typeID = $typeID;
    }

    /**
     * Get typeID
     *
     * @return integer
     */
    public function getTypeID()
    {
        return $this->typeID;
    }
}