<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\TravelerProfile
 */
class TravelerProfile
{

    /**
     * @var integer $numAdults
     */
    public $numAdults;

    /**
     * @var integer $numYouths
     */
    public $numYouths;

    /**
     * @var integer $numChildren
     */
    public $numChildren;

    /**
     * @var integer $numSeniors
     */
    public $numSeniors;

    /**
     * Set numAdults
     *
     * @param integer $numAdults
     */
    public function setNumAdults($numAdults)
    {
        $this->numAdults = $numAdults;
    }

    /**
     * Get numAdults
     *
     * @return integer 
     */
    public function getNumAdults()
    {
        return $this->numAdults;
    }

    /**
     * Set numYouths
     *
     * @param integer $numYouths
     */
    public function setNumYouths($numYouths)
    {
        $this->numYouths = $numYouths;
    }

    /**
     * Get numYouths
     *
     * @return integer 
     */
    public function getNumYouths()
    {
        return $this->numYouths;
    }

    /**
     * Set numChildren
     *
     * @param integer $numChildren
     */
    public function setNumChildren($numChildren)
    {
        $this->numChildren = $numChildren;
    }

    /**
     * Get numChildren
     *
     * @return integer 
     */
    public function getNumChildren()
    {
        return $this->numChildren;
    }

    /**
     * Set numSeniors
     *
     * @param integer $numSeniors
     */
    public function setNumSeniors($numSeniors)
    {
        $this->numSeniors = $numSeniors;
    }

    /**
     * Get numSeniors
     *
     * @return integer 
     */
    public function getNumSeniors()
    {
        return $this->numSeniors;
    }

}