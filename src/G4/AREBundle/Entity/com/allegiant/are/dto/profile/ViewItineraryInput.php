<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\profile;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\profile\ViewItineraryInput
 */
class ViewItineraryInput
{


    /**
     * @var integer $itineraryID
     */
    public $itineraryID;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Set itineraryID
     *
     * @param integer $itineraryID
     */
    public function setItineraryID($itineraryID)
    {
        $this->itineraryID = $itineraryID;
    }

    /**
     * Get itineraryID
     *
     * @return integer
     */
    public function getItineraryID()
    {
        return $this->itineraryID;
    }
}