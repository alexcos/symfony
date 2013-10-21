<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\TripResInfo
 */
class TripResInfo
{


    /**
     * @var com\allegiant\are\dto\flight\TripResConfNbr $confInfo
     */
    public $confInfo;

    /**
     * @var integer $tripResID
     */
    public $tripResID;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setConfInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\TripResConfNbr());
    }

    /**
     * Set confInfo
     *
     * @param com\allegiant\are\dto\flight\TripResConfNbr $confInfo
     */
    public function setConfInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\TripResConfNbr $confInfo)
    {
        $this->confInfo = $confInfo;
    }

    /**
     * Get confInfo
     *
     * @return com\allegiant\are\dto\flight\TripResConfNbr
     */
    public function getConfInfo()
    {
        return $this->confInfo;
    }

    /**
     * Set tripResID
     *
     * @param integer $tripResID
     */
    public function setTripResID($tripResID)
    {
        $this->tripResID = $tripResID;
    }

    /**
     * Get tripResID
     *
     * @return integer
     */
    public function getTripResID()
    {
        return $this->tripResID;
    }
}