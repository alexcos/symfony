<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTravelerProfile
 *
 * @see \G4\AREBundle\Resources\sourceXsd\AREFlight.xsd
 */
class FlightTravelerProfile
{

    /**
     * @var integer $numTravelers Indicates the Total Number of Travelers (Including Children)
     */
    public $numTravelers;

    /**
     * @var array $childAge An array of child ages. The number of elements in this array indicates how many of the numTraveles are children
     */
    public $childAge;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->numTravelers = 0;
        $this->childAge = array();
    }

    /**
     * Set numTravelers
     *
     * @param integer $numTravelers The total number of travelers
     *
     * @return void
     */
    public function setNumTravelers($numTravelers)
    {
        $this->numTravelers = $numTravelers;
    }

    /**
     * Get numTravelers
     *
     * @return integer 
     */
    public function getNumTravelers()
    {
        if (0 == $this->numTravelers || $this->numTravelers < count($this->childAge)) {
            return count($this->childAge);
        }

        return $this->numTravelers;
    }

    /**
     * Add child aged $age to the list of child travelers
     *
     * @param integer $age The age of the child being added to the list of travelers
     *
     * @return void
     */
    public function setChildAge($age)
    {
        $this->childAge[] = $age;
    }

    /**
     * Get children ages
     *
     * @return array 
     */
    public function getChildAge()
    {
        return $this->childAge;
    }

}