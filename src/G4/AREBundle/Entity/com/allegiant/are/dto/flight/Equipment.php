<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Equipment
 */
class Equipment
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var com\allegiant\are\dto\flight\SeatMap $seatMap
     */
    private $seatMap;

    /**
     * @var string $make
     */
    private $make;

    /**
     * @var string $model
     */
    private $model;

    /**
     * @var string $config
     */
    private $config;

    /**
     * @var string $tailNbr
     */
    private $tailNbr;


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
     * Set seatMap
     *
     * @param com\allegiant\are\dto\flight\SeatMap $seatMap
     */
    public function setSeatMap(\com\allegiant\are\dto\flight\SeatMap $seatMap)
    {
        $this->seatMap = $seatMap;
    }

    /**
     * Get seatMap
     *
     * @return com\allegiant\are\dto\flight\SeatMap 
     */
    public function getSeatMap()
    {
        return $this->seatMap;
    }

    /**
     * Set make
     *
     * @param string $make
     */
    public function setMake($make)
    {
        $this->make = $make;
    }

    /**
     * Get make
     *
     * @return string 
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set config
     *
     * @param string $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * Get config
     *
     * @return string 
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set tailNbr
     *
     * @param string $tailNbr
     */
    public function setTailNbr($tailNbr)
    {
        $this->tailNbr = $tailNbr;
    }

    /**
     * Get tailNbr
     *
     * @return string 
     */
    public function getTailNbr()
    {
        return $this->tailNbr;
    }
}