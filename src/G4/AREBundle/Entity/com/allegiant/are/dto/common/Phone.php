<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Phone
 */
class Phone
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var com\allegiant\are\dto\flight\PhoneType $type
     */
    public $type;

    /**
     * @var string $nbr
     */
    public $nbr;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param com\allegiant\are\dto\flight\PhoneType $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return com\allegiant\are\dto\flight\PhoneType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nbr
     *
     * @param string $nbr
     */
    public function setNbr($nbr)
    {
        $this->nbr = preg_replace('/\D/', '', $nbr);
    }

    /**
     * Get nbr
     *
     * @return string
     */
    public function getNbr()
    {
        return $this->nbr;
    }
}