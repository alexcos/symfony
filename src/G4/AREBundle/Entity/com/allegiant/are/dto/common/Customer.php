<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\Person as Person;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Customer
 */
class Customer extends Person
{

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\common\Address $address
     */
    public $address;

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Phone $phone
     */
    public $phone;

    /**
     * @var integer $profileID
     */
    public $profileID;

    /**
     * @var integer $customerID
     */
    public $customerID;

    /**
     * @var string $customerNbr
     */
    public $customerNbr;

    /**
     * @var string $loyaltyNbr
     */
    public $loyaltyNbr;

    /**
     * @var boolean $allowEmailContact
     */
    public $allowEmailContact;

    /**
     * @var boolean $agreedToTermsOfService
     */
    public $agreedToTermsOfService;

    /**
     * @var string $preferredHotel
     */
    public $preferredHotel;

    /**
     * @var string $loginName
     */
    public $loginName;

    /**
     * @var string $loginPwd
     */
    public $loginPwd;

    /**
     * @var string $employeeNbr
     */
    public $employeeNbr;

    /**
     * @var string $airlineNbr
     */
    public $airlineNbr;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->address = array();
    }

    /**
     * Set address
     *
     * @param G4\AREBundle\Entity\com\allegiant\are\dto\common\Address $address
     */
    public function addAddress(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Address $address)
    {
        $this->address[] = $address;
    }

    /**
     * Set address
     *
     * @param array $items entities of type G4\AREBundle\Entity\com\allegiant\are\dto\common\Address
     */
    public function setAddress(array $items)
    {
        $this->address = $items;
    }

    /**
     * Get address
     *
     * @return com\allegiant\are\dto\cart\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param com\allegiant\are\dto\cart\Phone $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Add phone
     *
     * @param com\allegiant\are\dto\cart\Phone $phone
     */
    public function addPhone(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Phone $phone)
    {
        $this->phone[] = $phone;
    }


    /**
     * Get phone
     *
     * @return com\allegiant\are\dto\cart\Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set profileID
     *
     * @param integer $profileID
     */
    public function setProfileID($profileID)
    {
        $this->profileID = $profileID;
    }

    /**
     * Get profileID
     *
     * @return integer
     */
    public function getProfileID()
    {
        return $this->profileID;
    }

    /**
     * Set customerID
     *
     * @param integer $customerID
     */
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
    }

    /**
     * Get customerID
     *
     * @return integer
     */
    public function getCustomerID()
    {
        return $this->customerID;
    }

    /**
     * Set customerNbr
     *
     * @param string $customerNbr
     */
    public function setCustomerNbr($customerNbr)
    {
        $this->customerNbr = $customerNbr;
    }

    /**
     * Get customerNbr
     *
     * @return string
     */
    public function getCustomerNbr()
    {
        return $this->customerNbr;
    }

    /**
     * Set loyaltyNbr
     *
     * @param string $loyaltyNbr
     */
    public function setLoyaltyNbr($loyaltyNbr)
    {
        $this->loyaltyNbr = $loyaltyNbr;
    }

    /**
     * Get loyaltyNbr
     *
     * @return string
     */
    public function getLoyaltyNbr()
    {
        return $this->loyaltyNbr;
    }

    /**
     * Set allowEmailContact
     *
     * @param boolean $allowEmailContact
     */
    public function setAllowEmailContact($allowEmailContact)
    {
        $this->allowEmailContact = $allowEmailContact;
    }

    /**
     * Get allowEmailContact
     *
     * @return boolean
     */
    public function getAllowEmailContact()
    {
        return $this->allowEmailContact;
    }

    /**
     * Set agreedToTermsOfService
     *
     * @param boolean $agreedToTermsOfService
     */
    public function setAgreedToTermsOfService($agreedToTermsOfService)
    {
        $this->agreedToTermsOfService = $agreedToTermsOfService;
    }

    /**
     * Get agreedToTermsOfService
     *
     * @return boolean
     */
    public function getAgreedToTermsOfService()
    {
        return $this->agreedToTermsOfService;
    }

    /**
     * Set preferredHotel
     *
     * @param string $preferredHotel
     */
    public function setPreferredHotel($preferredHotel)
    {
        $this->preferredHotel = $preferredHotel;
    }

    /**
     * Get preferredHotel
     *
     * @return string
     */
    public function getPreferredHotel()
    {
        return $this->preferredHotel;
    }

    /**
     * Set loginName
     *
     * @param string $loginName
     */
    public function setLoginName($loginName)
    {
        $this->loginName = $loginName;
    }

    /**
     * Get loginName
     *
     * @return string
     */
    public function getLoginName()
    {
        return $this->loginName;
    }

    /**
     * Set loginPwd
     *
     * @param string $loginPwd
     */
    public function setLoginPwd($loginPwd)
    {
        $this->loginPwd = $loginPwd;
    }

    /**
     * Get loginPwd
     *
     * @return string
     */
    public function getLoginPwd()
    {
        return $this->loginPwd;
    }

    /**
     * Set employeeNbr
     *
     * @param string $employeeNbr
     */
    public function setEmployeeNbr($employeeNbr)
    {
        $this->employeeNbr = $employeeNbr;
    }

    /**
     * Get employeeNbr
     *
     * @return string
     */
    public function getEmployeeNbr()
    {
        return $this->employeeNbr;
    }

    /**
     * Set airlineNbr
     *
     * @param string $airlineNbr
     */
    public function setAirlineNbr($airlineNbr)
    {
        $this->airlineNbr = $airlineNbr;
    }

    /**
     * Get airlineNbr
     *
     * @return string
     */
    public function getAirlineNbr()
    {
        return $this->airlineNbr;
    }
}