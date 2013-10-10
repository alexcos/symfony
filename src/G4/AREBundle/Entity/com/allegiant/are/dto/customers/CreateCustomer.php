<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers;

use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Address;
use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\CreateAuthentication;
use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Gender;
use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\PhoneNumber;
use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Profile;

/**
 * Class Customer
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers
 */
class CreateCustomer
{

    public $id;

    /** @var   */
    public $emailAddress;

    /** @var   */
    public $firstName;

    /** @var   */
    public $lastName;

    /** @var   */
    public $middleName;

    /** @var   */
    public $suffix;

    /** @var   */
    public $dateOfBirth;

    /** @var Gender  */
    public $gender;

    /** @var Profile */
    public $profile;

    /** @var  PhoneNumber[] $phoneNumbers */
    public $phoneNumbers;

    /** @var  Address[] $addresses */
    public $addresses;



    /** @var CreateAuthentication[] */
    public $roles;

    /**
     * @param string $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $suffix
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    /**
     * @return mixed
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param array $phoneNumbers
     */
    public function setPhoneNumbers($phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
    }

    /**
     * @return array
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Return phone number at index
     *
     * @param int $index
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\PhoneNumber
     */
    public function getPhoneNumber($index)
    {
        return $this->phoneNumbers[$index];
    }

    /**
     * @param PhoneNumber $phoneNumber
     */
    public function addPhoneNumber(PhoneNumber $phoneNumber)
    {
        $this->phoneNumbers[] = $phoneNumber;
    }

    /**
     * @param array $addresses
     */
    public function setAddresses(array $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Add a address object to the addresses array
     * @param Address $address
     */
    public function addAddress(Address $address)
    {
        $this->addresses[] = $address;
    }

    /**
     * @return array()
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Return address at index
     *
     * @param int $index
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Address
     */
    public function getAddress($index)
    {
        return $this->addresses[$index];
    }

    /**
     * @param Gender $gender
     */
    public function setGender(Gender $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param CreateAuthentication[] $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return CreateAuthentication[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param CreateAuthentication $role
     */
    public function addRole(CreateAuthentication $role)
    {
        $this->roles[] = $role;
    }

    /**
     * @param int $index
     *
     * @return CreateAuthentication
     */
    public function getRole($index)
    {
        return $this->roles[$index];
    }

    /**
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Profile $profile
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}