<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer;

/**
 * Class Gender
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer
 */
class Gender
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


}