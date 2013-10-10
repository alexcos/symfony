<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightTrackerOutput
 */
class GetFlightTrackerOutput
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var com\allegiant\are\dto\cart\Segment $segment
     */
    private $segment;


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
     * Set segment
     *
     * @param com\allegiant\are\dto\cart\Segment $segment
     */
    public function setSegment(\com\allegiant\are\dto\cart\Segment $segment)
    {
        $this->segment = $segment;
    }

    /**
     * Get segment
     *
     * @return com\allegiant\are\dto\cart\Segment 
     */
    public function getSegment()
    {
        return $this->segment;
    }
}