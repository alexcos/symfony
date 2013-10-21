<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers;

/**
 * Class AuthenticationsInput
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers
 */
class AuthenticationsInput
{
    /** @var int */
    public $customerTypeId;

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
    public function setCustomerTypeId($customerTypeId)
    {
        $this->customerTypeId = $customerTypeId;
    }

    /**
     * @return int
     */
    public function getCustomerTypeId()
    {
        return $this->customerTypeId;
    }


}