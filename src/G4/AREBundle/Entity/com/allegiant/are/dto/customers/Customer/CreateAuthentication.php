<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer;

use G4\AREBundle\Entity\com\allegiant\are\dto\customers\Credential;

class CreateAuthentication
{
    /** @var int */
    public $id;

    /** @var Credential $credential */
    public $credential;

    /**
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Credential $credential
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
    }

    /**
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\customers\Credential
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * @param int $customerTypeId
     */
    public function setId($customerTypeId)
    {
        $this->id = $customerTypeId;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}