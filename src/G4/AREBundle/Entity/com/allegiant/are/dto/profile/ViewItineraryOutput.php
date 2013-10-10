<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\profile;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\profile\ViewItineraryOutput
 */
class ViewItineraryOutput
{


    /**
     * @var com\allegiant\are\dto\profile\JourneySet $journeySet
     */
    public $journeySet;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setJourneySet(new \G4\AREBundle\Entity\com\allegiant\are\dto\profile\JourneySet());
    }

    /**
     * Set journeySet
     *
     * @param com\allegiant\are\dto\profile\JourneySet $journeySet
     */
    public function setJourneySet(\G4\AREBundle\Entity\com\allegiant\are\dto\profile\JourneySet $journeySet)
    {
        $this->journeySet = $journeySet;
    }

    /**
     * Get journeySet
     *
     * @return com\allegiant\are\dto\profile\JourneySet
     */
    public function getJourneySet()
    {
        return $this->journeySet;
    }
}