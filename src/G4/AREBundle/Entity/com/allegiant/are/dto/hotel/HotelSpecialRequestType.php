<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.common
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelSpecialRequestType
 */
class HotelSpecialRequestType
{


    /**
     * @var string $idd
     */
    public $idd;

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $description
     */
    public $description;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set idd
     *
     * @param string $idd
     */
    public function setIdd($idd)
    {
        $this->idd = $idd;
    }

    /**
     * Get idd
     *
     * @return string
     */
    public function getIdd()
    {
        return $this->idd;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}