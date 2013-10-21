<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightEstimatedTimeComponent
 */
class FlightEstimatedTimeComponent
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $estLocalDeparture
     */
    private $estLocalDeparture;

    /**
     * @var string $estLocalArrival
     */
    private $estLocalArrival;

    /**
     * @var string $estGMTDeparture
     */
    private $estGMTDeparture;

    /**
     * @var string $estGMTArrival
     */
    private $estGMTArrival;


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
     * Set estLocalDeparture
     *
     * @param string $estLocalDeparture
     */
    public function setEstLocalDeparture($estLocalDeparture)
    {
        $this->estLocalDeparture = $estLocalDeparture;
    }

    /**
     * Get estLocalDeparture
     *
     * @return string 
     */
    public function getEstLocalDeparture()
    {
        return $this->estLocalDeparture;
    }

    /**
     * Set estLocalArrival
     *
     * @param string $estLocalArrival
     */
    public function setEstLocalArrival($estLocalArrival)
    {
        $this->estLocalArrival = $estLocalArrival;
    }

    /**
     * Get estLocalArrival
     *
     * @return string 
     */
    public function getEstLocalArrival()
    {
        return $this->estLocalArrival;
    }

    /**
     * Set estGMTDeparture
     *
     * @param string $estGMTDeparture
     */
    public function setEstGMTDeparture($estGMTDeparture)
    {
        $this->estGMTDeparture = $estGMTDeparture;
    }

    /**
     * Get estGMTDeparture
     *
     * @return string 
     */
    public function getEstGMTDeparture()
    {
        return $this->estGMTDeparture;
    }

    /**
     * Set estGMTArrival
     *
     * @param string $estGMTArrival
     */
    public function setEstGMTArrival($estGMTArrival)
    {
        $this->estGMTArrival = $estGMTArrival;
    }

    /**
     * Get estGMTArrival
     *
     * @return string 
     */
    public function getEstGMTArrival()
    {
        return $this->estGMTArrival;
    }
}