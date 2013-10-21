<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestOutput
 */
class RequestOutput
{

    /**
     * @var com\allegiant\are\dto\common\PayLoadAttributes $payloadAttributes
     */
    public $payloadAttributes;

    /**
     * @var com\allegiant\are\dto\common\Error $error
     */
    public $error;

    /**
     * @var com\allegiant\are\dto\common\Error $warning
     */
    public $warning;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPayloadAttributes(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes());
        $this->setError(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Error());
        $this->setWarning(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Error());
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
     * Set error
     *
     * @param com\allegiant\are\dto\common\Error $error error
     *
     * @return void
     */
    public function setError(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Error $error)
    {
        $this->error = $error;
    }

    /**
     * Get error
     *
     * @return com\allegiant\are\dto\common\Error 
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set warning
     *
     * @param com\allegiant\are\dto\common\Error $warning warning
     *
     * @return void
     */
    public function setWarning(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Error $warning)
    {
        $this->warning = $warning;
    }

    /**
     * Get warning
     *
     * @return com\allegiant\are\dto\common\Error 
     */
    public function getWarning()
    {
        return $this->warning;
    }
}