<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightInput
 */
class FlightInput
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nbr
     */
    private $nbr;

    /**
     * @var string $departDate
     */
    private $departDate;

    /**
     * @var string $carrierCode
     */
    private $carrierCode;


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
     * Set nbr
     *
     * @param string $nbr
     */
    public function setNbr($nbr)
    {
        $this->nbr = $nbr;
    }

    /**
     * Get nbr
     *
     * @return string 
     */
    public function getNbr()
    {
        return $this->nbr;
    }

    /**
     * Set departDate
     *
     * @param string $departDate
     */
    public function setDepartDate($departDate)
    {
        $this->departDate = $departDate;
    }

    /**
     * Get departDate
     *
     * @return string 
     */
    public function getDepartDate()
    {
        return $this->departDate;
    }

    /**
     * Set carrierCode
     *
     * @param string $carrierCode
     */
    public function setCarrierCode($carrierCode)
    {
        $this->carrierCode = $carrierCode;
    }

    /**
     * Get carrierCode
     *
     * @return string 
     */
    public function getCarrierCode()
    {
        return $this->carrierCode;
    }
}