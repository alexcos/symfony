<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTimeComponent
 */
class FlightTimeComponent
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $localOut
     */
    private $localOut;

    /**
     * @var string $localOff
     */
    private $localOff;

    /**
     * @var string $localOn
     */
    private $localOn;

    /**
     * @var string $localIn
     */
    private $localIn;

    /**
     * @var string $gmtOut
     */
    private $gmtOut;

    /**
     * @var string $gmtOff
     */
    private $gmtOff;

    /**
     * @var string $gmtOn
     */
    private $gmtOn;

    /**
     * @var string $gmtIn
     */
    private $gmtIn;


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
     * Set localOut
     *
     * @param string $localOut
     */
    public function setLocalOut($localOut)
    {
        $this->localOut = $localOut;
    }

    /**
     * Get localOut
     *
     * @return string 
     */
    public function getLocalOut()
    {
        return $this->localOut;
    }

    /**
     * Set localOff
     *
     * @param string $localOff
     */
    public function setLocalOff($localOff)
    {
        $this->localOff = $localOff;
    }

    /**
     * Get localOff
     *
     * @return string 
     */
    public function getLocalOff()
    {
        return $this->localOff;
    }

    /**
     * Set localOn
     *
     * @param string $localOn
     */
    public function setLocalOn($localOn)
    {
        $this->localOn = $localOn;
    }

    /**
     * Get localOn
     *
     * @return string 
     */
    public function getLocalOn()
    {
        return $this->localOn;
    }

    /**
     * Set localIn
     *
     * @param string $localIn
     */
    public function setLocalIn($localIn)
    {
        $this->localIn = $localIn;
    }

    /**
     * Get localIn
     *
     * @return string 
     */
    public function getLocalIn()
    {
        return $this->localIn;
    }

    /**
     * Set gmtOut
     *
     * @param string $gmtOut
     */
    public function setGmtOut($gmtOut)
    {
        $this->gmtOut = $gmtOut;
    }

    /**
     * Get gmtOut
     *
     * @return string 
     */
    public function getGmtOut()
    {
        return $this->gmtOut;
    }

    /**
     * Set gmtOff
     *
     * @param string $gmtOff
     */
    public function setGmtOff($gmtOff)
    {
        $this->gmtOff = $gmtOff;
    }

    /**
     * Get gmtOff
     *
     * @return string 
     */
    public function getGmtOff()
    {
        return $this->gmtOff;
    }

    /**
     * Set gmtOn
     *
     * @param string $gmtOn
     */
    public function setGmtOn($gmtOn)
    {
        $this->gmtOn = $gmtOn;
    }

    /**
     * Get gmtOn
     *
     * @return string 
     */
    public function getGmtOn()
    {
        return $this->gmtOn;
    }

    /**
     * Set gmtIn
     *
     * @param string $gmtIn
     */
    public function setGmtIn($gmtIn)
    {
        $this->gmtIn = $gmtIn;
    }

    /**
     * Get gmtIn
     *
     * @return string 
     */
    public function getGmtIn()
    {
        return $this->gmtIn;
    }
}