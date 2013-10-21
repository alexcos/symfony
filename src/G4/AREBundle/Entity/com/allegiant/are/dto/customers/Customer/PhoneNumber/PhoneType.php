<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\PhoneNumber;

/**
 * Class PhoneType
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer\PhoneNumber
 */
class PhoneType
{
    /**
     * @var
     */
    public $id;

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
}