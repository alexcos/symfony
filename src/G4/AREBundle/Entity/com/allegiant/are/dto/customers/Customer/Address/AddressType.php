<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Address;

/**
 * Class AddressType
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\Address
 */
class AddressType
{
    /** @var int */
    public $id;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}