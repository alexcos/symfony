<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.hotel
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResConfNbr
 */
class HotelResConfNbr
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
     * Constructor
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