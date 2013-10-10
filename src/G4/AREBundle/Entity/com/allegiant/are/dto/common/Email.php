<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Email
 */
class Email
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var com\allegiant\are\dto\flight\EmailType $type
     */
    private $type;

    /**
     * @var string $address
     */
    private $address;


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
     * @param com\allegiant\are\dto\flight\EmailType $type
     */
    public function setType(\com\allegiant\are\dto\flight\EmailType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return com\allegiant\are\dto\flight\EmailType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
}