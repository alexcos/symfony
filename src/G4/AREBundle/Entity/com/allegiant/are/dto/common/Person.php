<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Person
 */
class Person
{

    /**
     * @var string $RPH
     */
    public $rph;

    /**
     * @var string $firstName
     */
    public $firstName;

    /**
     * @var string $lastName
     */
    public $lastName;

    /**
     * @var string $middleName
     */
    public $middleName;

    /**
     * @var string $dob
     */
    public $dob;

    /**
     * @var com\allegiant\are\dto\flight\Gender $gender
     */
    public $gender;


    /**
     * Set RPH
     *
     * @param string $rPH
     */
    public function setRPH($rPH)
    {
        $this->rph = $rPH;
    }

    /**
     * Get RPH
     *
     * @return string 
     */
    public function getRPH()
    {
        return $this->rph;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getfirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setlastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getlastName()
    {
        return $this->lastName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     */
    public function setmiddleName($middleName)
    {
        $this->mmame = $middleName;
    }

    /**
     * Get middleName
     *
     * @return string 
     */
    public function getmiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set dob
     *
     * @param string $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * Get dob
     *
     * @return string 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set gender
     *
     * @param com\allegiant\are\dto\flight\Gender $gender
     */
    public function setGender(\com\allegiant\are\dto\flight\Gender $gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return com\allegiant\are\dto\flight\Gender 
     */
    public function getGender()
    {
        return $this->gender;
    }
}