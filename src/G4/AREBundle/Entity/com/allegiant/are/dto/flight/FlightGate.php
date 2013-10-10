<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightGate
 */
class FlightGate
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $schDepart
     */
    private $schDepart;

    /**
     * @var string $schArrival
     */
    private $schArrival;

    /**
     * @var string $actDepart
     */
    private $actDepart;

    /**
     * @var string $actArrival
     */
    private $actArrival;


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
     * Set schDepart
     *
     * @param string $schDepart
     */
    public function setSchDepart($schDepart)
    {
        $this->schDepart = $schDepart;
    }

    /**
     * Get schDepart
     *
     * @return string 
     */
    public function getSchDepart()
    {
        return $this->schDepart;
    }

    /**
     * Set schArrival
     *
     * @param string $schArrival
     */
    public function setSchArrival($schArrival)
    {
        $this->schArrival = $schArrival;
    }

    /**
     * Get schArrival
     *
     * @return string 
     */
    public function getSchArrival()
    {
        return $this->schArrival;
    }

    /**
     * Set actDepart
     *
     * @param string $actDepart
     */
    public function setActDepart($actDepart)
    {
        $this->actDepart = $actDepart;
    }

    /**
     * Get actDepart
     *
     * @return string 
     */
    public function getActDepart()
    {
        return $this->actDepart;
    }

    /**
     * Set actArrival
     *
     * @param string $actArrival
     */
    public function setActArrival($actArrival)
    {
        $this->actArrival = $actArrival;
    }

    /**
     * Get actArrival
     *
     * @return string 
     */
    public function getActArrival()
    {
        return $this->actArrival;
    }
}