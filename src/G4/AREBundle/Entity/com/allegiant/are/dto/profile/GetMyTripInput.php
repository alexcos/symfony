<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\profile;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\profile\GetMyTripInput
 */
class GetMyTripInput
{


    /**
     * @var integer $customerID
     */
    public $customerID;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
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
}