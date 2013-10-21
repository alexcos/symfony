<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
 */
class RequestInput
{

    /**
     * @var com\allegiant\are\dto\common\UserProfile $callerInfo
     */
    public $callerInfo;

    /**
     * @var com\allegiant\are\dto\common\PayLoadAttributes $payloadAttributes
     */
    public $payloadAttributes;

    /**
     * class constructor
     *
     * @param stdClass $data data
     *
     * @return void
     */
    public function __construct($data = null)
    {
        //\G4\UtilBundle\EntityHelper::populate($this, $data);
    }

    /**
     * Set payloadAttributes
     *
     * @param com\allegiant\are\dto\common\PayLoadAttributes $payloadAttributes payload attributes
     *
     * @return void
     */
    public function setPayloadAttributes(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes $payloadAttributes)
    {
        $this->payloadAttributes = $payloadAttributes;
    }

    /**
     * Get payloadAttributes
     *
     * @return com\allegiant\are\dto\common\PayLoadAttributes 
     */
    public function getPayloadAttributes()
    {
        return $this->payloadAttributes;
    }

    /**
     * Set callerInfo
     *
     * @param com\allegiant\are\dto\common\UserProfile $callerInfo caller information
     *
     * @return void
     */
    public function setCallerInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile $callerInfo)
    {
        $this->callerInfo = $callerInfo;
    }

    /**
     * Get callerInfo
     *
     * @return com\allegiant\are\dto\common\UserProfile 
     */
    public function getCallerInfo()
    {
        return $this->callerInfo;
    }
}