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
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\TravelerDoc
 *
 * the following fields are now required for a TravelerDoc (per the WSDL): docNbr & expiryDate
 * the expiryDate on the TravelerDoc is also validated to be a valid date (can be converted to
 *      a java.util.Date value, which is usable by the web service layer)
 *
 * @see http://bugs.lolacloud.com/mantis/view.php?id=553 *
 */
class TravelerDoc
{

    /**
     * @var integer $travelerDocTypeID
     */
    public $travelerDocTypeID;

    /**
     * @var string $docNbr
     */
    public $docNbr;

    /**
     * @var string $expiryDate
     */
    public $expiryDate;

    /**
     * @var string $stateCode
     */
    public $stateCode;

    /**
     * @var string $countryCode
     */
    public $countryCode;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Set travelerDocTypeID
     *
     * @param integer $travelerDocTypeID document type identifier
     *
     * @return void
     */
    public function setTravelerDocTypeID($travelerDocTypeID)
    {
        $this->travelerDocTypeID = $travelerDocTypeID;
    }

    /**
     * Get travelerDocTypeID
     *
     * @return integer
     */
    public function getTravelerDocTypeID()
    {
        return $this->travelerDocTypeID;
    }

    /**
     * Set docNbr
     *
     * @param string $docNbr document number
     *
     * @return void
     */
    public function setDocNbr($docNbr)
    {
        $this->docNbr = $docNbr;
    }

    /**
     * Get docNbr
     *
     * @return string
     */
    public function getDocNbr()
    {
        return $this->docNbr;
    }

    /**
     * Set expiryDate
     *
     * @param string $expiryDate expiry date
     *
     * @return void
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }

    /**
     * Get expiryDate
     *
     * @return string
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set stateCode
     *
     * @param string $stateCode state code
     *
     * @return void
     */
    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;
    }

    /**
     * Get stateCode
     *
     * @return string
     */
    public function getStateCode()
    {
        return $this->stateCode;
    }

    /**
     * Set countryCode
     *
     * @param string $countryCode country code
     *
     * @return void
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Get countryCode
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
}