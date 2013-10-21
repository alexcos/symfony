<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.hotel
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResNight
 */
class HotelResNight
{


    /**
     * @var integer $ratePlanID
     */
    public $ratePlanID;

    /**
     * @var string $resDate
     */
    public $resDate;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set ratePlanID
     *
     * @param integer $ratePlanID
     */
    public function setRatePlanID($ratePlanID)
    {
        $this->ratePlanID = $ratePlanID;
    }

    /**
     * Get ratePlanID
     *
     * @return integer
     */
    public function getRatePlanID()
    {
        return $this->ratePlanID;
    }

    /**
     * Set resDate
     *
     * @param string $resDate
     */
    public function setResDate($resDate)
    {
        $this->resDate = $resDate;
    }

    /**
     * Get resDate
     *
     * @return string
     */
    public function getResDate()
    {
        return $this->resDate;
    }
}