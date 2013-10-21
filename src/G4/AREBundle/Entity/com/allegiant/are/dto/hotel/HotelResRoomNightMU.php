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
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomNightMU
 */
class HotelResRoomNightMU
{


    /**
     * @var integer $roomMUTypeID
     */
    public $roomMUTypeID;

    /**
     * @var float $value
     */
    public $value;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set roomMUTypeID
     *
     * @param integer $roomMUTypeID
     */
    public function setRoomMUTypeID($roomMUTypeID)
    {
        $this->roomMUTypeID = $roomMUTypeID;
    }

    /**
     * Get roomMUTypeID
     *
     * @return integer
     */
    public function getRoomMUTypeID()
    {
        return $this->roomMUTypeID;
    }

    /**
     * Set value
     *
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}