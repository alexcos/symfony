<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer;

use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\PhoneNumber\PhoneType;

/**
 * Class PhoneNumber
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer
 */
class PhoneNumber
{
    protected $id;

    /**
     * @var
     */
    public $nbr;
    /**
     * @var string
     */
    public $phoneType;

    /** @var string  */
    public $friendlyName;

    /** @var bool */
    public $isPrimary;

    /**
     * @param string $number
     */
    public function setNbr($number)
    {
        $this->nbr = $number;
    }

    /**
     * @return mixed
     */
    public function getNbr()
    {
        return $this->nbr;
    }

    /**
     * @param PhoneType $type
     */
    public function setPhoneType(PhoneType $type)
    {
        $this->phoneType = $type;
    }

    /**
     * @return PhoneType
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     * @param string $name
     */
    public function setFriendlyName($name)
    {
        $this->friendlyName = $name;
    }

    /**
     * @return string
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }

    /**
     * @param boolean $isPrimary
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }

    /**
     * @return boolean
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }


}