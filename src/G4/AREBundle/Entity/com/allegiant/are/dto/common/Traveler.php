<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.common
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler
 *
 * the following fields are now required for a Traveler (per the WSDL): RPH, firstName, lastName
 * the traveler's dob is validated to be a valid date along w/ being before or equal to the current date
 *
 * @see http://bugs.lolacloud.com/mantis/view.php?id=553
 *
 */
class Traveler
{
    const _RESULT_SUCCESS   = 'SUCCESS';
    const _CHECKED_IN       = 'CHECKED_IN';
    const _INELIGIBLE       = 'INELIGIBLE';

    // statuses for the checkin
    const TRUE_CHECKIN_AVAILABLE                = 'TRUE_CHECKIN_AVAILABLE';
    const FALSE_INELIGIBLE_PASSENGER_TYPE       = 'FALSE_INELIGIBLE_PASSENGER_TYPE';
    const FALSE_SSR_RESTRICTION                 = 'FALSE_SSR_RESTRICTION';
    const FALSE_SECURE_FLIGHT                   = 'FALSE_SECURE_FLIGHT';
    const FALSE_NO_ASSIGNED_SEAT                = 'FALSE_NO_ASSIGNED_SEAT'; // @since APP-519
    const FALSE_JOURNEY_CHECKIN_NOT_AVAILABLE   = 'FALSE_JOURNEY_CHECKIN_NOT_AVAILABLE'; //introduced by modifyLite

    /**
     * @var com\allegiant\are\dto\common\TravelerDoc $travelerDoc
     */
    // public $travelerDoc;

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
     * @var com\allegiant\are\dto\common\Gender $gender
     */
    public $gender;

    /**
     * @var string $redressNbr
     */
    public $redressNbr;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        //$this->setGender(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Gender());
    }

    /**
     * Set travelerDoc
     *
     * @param com\allegiant\are\dto\common\TravelerDoc $travelerDoc traveller doc
     *
     * @return void
     */
    public function addTravelerDoc(\G4\AREBundle\Entity\com\allegiant\are\dto\common\TravelerDoc $travelerDoc)
    {
        if (is_null($this->travelerDoc)) {
            $this->travelerDoc = array();
        }
        $this->travelerDoc[] = $travelerDoc;
    }

    /**
     * Set travelerDoc
     *
     * @param array $items traveller doc items of type com\allegiant\are\dto\common\TravelerDoc
     *
     * @return void
     */
    public function setTravelerDoc(array $items)
    {
        $this->travelerDoc = $items;
    }

    /**
     * Get travelerDoc
     *
     * @return com\allegiant\are\dto\common\TravelerDoc
     */
    public function getTravelerDoc()
    {
        return $this->travelerDoc;
    }

    /**
     * Set RPH
     *
     * @param string $rPH
     *
     * @return void
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
     * @param string $firstName first name
     *
     * @return void
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
     * @param string $lastName last name
     *
     * @return void
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
     * @param string $middleName middle name
     *
     * @return void
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set dob
     *
     * @param string $dob date of birth
     *
     * @return void
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
     * @param com\allegiant\are\dto\common\Gender $gender gender
     *
     * @return void
     */
    public function setGender($gender) //\G4\AREBundle\Entity\com\allegiant\are\dto\common\Gender
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return com\allegiant\are\dto\common\Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set redressNbr
     *
     * @param string $redressNbr redress number
     *
     * @return void
     */
    public function setRedressNbr($redressNbr)
    {
        $this->redressNbr = $redressNbr;
    }

    /**
     * Get redressNbr
     *
     * @return string
     */
    public function getRedressNbr()
    {
        return $this->redressNbr;
    }
}