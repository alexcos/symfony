<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers;

/**
 * Class Program
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers
 */
class Program
{
    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $name;

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

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
}