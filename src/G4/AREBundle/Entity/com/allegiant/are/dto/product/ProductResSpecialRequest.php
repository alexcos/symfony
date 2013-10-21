<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\ProductResSpecialRequest
 */
class ProductResSpecialRequest
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