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
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\RoomTravelerProfile
 */
class RoomTravelerProfile
{


    /**
     * @var array $childAge
     */
    public $childAge;

    /**
     * @var integer $numTravelers
     */
    public $numTravelers;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childAge = array();
    }

    /**
     * Set childAge
     *
     * @param integer $childAge
     */
    public function setChildAge($childAge)
    {
        $this->childAge[] = $childAge;
    }

    /**
     * Get childAge
     *
     * @return integer
     */
    public function getChildAge()
    {
        return $this->childAge;
    }

    /**
     * Set numTravelers
     *
     * @param integer $numTravelers
     */
    public function setNumTravelers($numTravelers)
    {
        $this->numTravelers = (int) $numTravelers;
    }

    /**
     * Get numTravelers
     *
     * @return integer
     */
    public function getNumTravelers()
    {
        return $this->numTravelers;
    }
}