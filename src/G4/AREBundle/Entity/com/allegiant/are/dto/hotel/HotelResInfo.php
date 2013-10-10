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
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResInfo
 */
class HotelResInfo
{


    /**
     * @var com\allegiant\are\dto\hotel\HotelResConfNbr $confInfo
     */
    public $confInfo;

    /**
     * @var integer $hotelResID
     */
    public $hotelResID;

    /**
     * @var string $primaryTravelerfirstName
     */
    public $primaryTravelerfirstName;

    /**
     * @var string $primaryTravelerlastName
     */
    public $primaryTravelerlastName;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setConfInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResConfNbr());
    }

    /**
     * Set confInfo
     *
     * @param com\allegiant\are\dto\hotel\HotelResConfNbr $confInfo
     */
    public function setConfInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResConfNbr $confInfo)
    {
        $this->confInfo = $confInfo;
    }

    /**
     * Get confInfo
     *
     * @return com\allegiant\are\dto\hotel\HotelResConfNbr
     */
    public function getConfInfo()
    {
        return $this->confInfo;
    }

    /**
     * Set hotelResID
     *
     * @param integer $hotelResID
     */
    public function setHotelResID($hotelResID)
    {
        $this->hotelResID = $hotelResID;
    }

    /**
     * Get hotelResID
     *
     * @return integer
     */
    public function getHotelResID()
    {
        return $this->hotelResID;
    }

    /**
     * Set primaryTravelerfirstName
     *
     * @param string $primaryTravelerfirstName
     */
    public function setPrimaryTravelerfirstName($primaryTravelerfirstName)
    {
        $this->primaryTravelerfirstName = $primaryTravelerfirstName;
    }

    /**
     * Get primaryTravelerfirstName
     *
     * @return string
     */
    public function getPrimaryTravelerfirstName()
    {
        return $this->primaryTravelerfirstName;
    }

    /**
     * Set primaryTravelerlastName
     *
     * @param string $primaryTravelerlastName
     */
    public function setPrimaryTravelerlastName($primaryTravelerlastName)
    {
        $this->primaryTravelerlastName = $primaryTravelerlastName;
    }

    /**
     * Get primaryTravelerlastName
     *
     * @return string
     */
    public function getPrimaryTravelerlastName()
    {
        return $this->primaryTravelerlastName;
    }
}