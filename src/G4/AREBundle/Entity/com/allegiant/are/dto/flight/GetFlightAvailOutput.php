<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightAvailOutput
 */
class GetFlightAvailOutput
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var com\allegiant\are\dto\cart\JourneySet $journeySet
     */
    private $journeySet;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set journeySet
     *
     * @param com\allegiant\are\dto\cart\JourneySet $journeySet
     */
    public function setJourneySet(\com\allegiant\are\dto\cart\JourneySet $journeySet)
    {
        $this->journeySet = $journeySet;
    }

    /**
     * Get journeySet
     *
     * @return com\allegiant\are\dto\cart\JourneySet 
     */
    public function getJourneySet()
    {
        return $this->journeySet;
    }
}