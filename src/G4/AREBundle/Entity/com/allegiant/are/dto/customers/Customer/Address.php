<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer;

use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Address\AddressType;

/**
 * Class Address
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer
 */
class Address
{

    /**
     * @var string $address1
     */
    public $line1;

    /**
     * @var string $address2
     */
    public $line2;

    /**
     * @var string $city
     */
    public $city;

    /**
     * @var string $state
     */
    public $state;

    /**
     * @var string $postalCode
     */
    public $postalCode;

    /**
     * @var
     */
    public $isPrimary;

    /**
     * @var
     */
    public $friendlyName;

    /** @var AddressType  */
    public $addressType;

    /**
     * Set address1
     *
     * @param string $address1
     */
    public function setLine1($address1)
    {
        $this->line1 = $address1;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     */
    public function setLine2($address2)
    {
        $this->line2 = $address2;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zip4
     *
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * Get zip4
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param $friendlyName
     */
    public function setFriendlyName($friendlyName)
    {
        $this->friendlyName = $friendlyName;
    }

    /**
     * @return mixed
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }

    /**
     * @param bool $isPrimary
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;
    }

    /**
     * @return bool
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Address\AddressType $addressType
     */
    public function setAddressType($addressType)
    {
        $this->addressType = $addressType;
    }

    /**
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Address\AddressType
     */
    public function getAddressType()
    {
        return $this->addressType;
    }


}