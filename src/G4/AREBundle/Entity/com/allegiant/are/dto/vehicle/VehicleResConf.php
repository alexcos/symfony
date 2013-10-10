<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\vehicle;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\VehicleResConf
 */
class VehicleResConf
{


    /**
     * @var integer $idd
     */
    public $idd;

    /**
     * @var integer $ConfTypeID
     */
    public $ConfTypeID;

    /**
     * @var string $ConfNbr
     */
    public $ConfNbr;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set idd
     *
     * @param integer $idd
     */
    public function setIdd($idd)
    {
        $this->idd = $idd;
    }

    /**
     * Get idd
     *
     * @return integer
     */
    public function getIdd()
    {
        return $this->idd;
    }

    /**
     * Set ConfTypeID
     *
     * @param integer $confTypeID
     */
    public function setConfTypeID($confTypeID)
    {
        $this->ConfTypeID = $confTypeID;
    }

    /**
     * Get ConfTypeID
     *
     * @return integer
     */
    public function getConfTypeID()
    {
        return $this->ConfTypeID;
    }

    /**
     * Set ConfNbr
     *
     * @param string $confNbr
     */
    public function setConfNbr($confNbr)
    {
        $this->ConfNbr = $confNbr;
    }

    /**
     * Get ConfNbr
     *
     * @return string
     */
    public function getConfNbr()
    {
        return $this->ConfNbr;
    }
}