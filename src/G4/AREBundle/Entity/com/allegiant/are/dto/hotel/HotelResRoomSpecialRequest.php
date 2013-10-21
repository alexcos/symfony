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
 * G4\AREBundle\Entity\com\allegiant\are\dto\hotel\HotelResRoomSpecialRequest
 */
class HotelResRoomSpecialRequest
{


    /**
     * @var integer $specialRequestTypeID
     */
    public $specialRequestTypeID;

    /**
     * @var string $comment
     */
    public $comment;


    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set specialRequestTypeID
     *
     * @param integer $specialRequestTypeID
     */
    public function setSpecialRequestTypeID($specialRequestTypeID)
    {
        $this->specialRequestTypeID = $specialRequestTypeID;
    }

    /**
     * Get specialRequestTypeID
     *
     * @return integer
     */
    public function getSpecialRequestTypeID()
    {
        return $this->specialRequestTypeID;
    }

    /**
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}