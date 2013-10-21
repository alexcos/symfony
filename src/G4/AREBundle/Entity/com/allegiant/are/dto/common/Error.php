<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Error
 */
class Error
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var string $errorDateTime
     */
    private $errorDateTime;

    /**
     * @var string $code
     */
    private $code;

    /**
     * @var com\allegiant\are\dto\flight\ErrorLevel $level
     */
    private $level;


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
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set errorDateTime
     *
     * @param string $errorDateTime
     */
    public function setErrorDateTime($errorDateTime)
    {
        $this->errorDateTime = $errorDateTime;
    }

    /**
     * Get errorDateTime
     *
     * @return string 
     */
    public function getErrorDateTime()
    {
        return $this->errorDateTime;
    }

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set level
     *
     * @param com\allegiant\are\dto\flight\ErrorLevel $level
     */
    public function setLevel(\com\allegiant\are\dto\flight\ErrorLevel $level)
    {
        $this->level = $level;
    }

    /**
     * Get level
     *
     * @return com\allegiant\are\dto\flight\ErrorLevel 
     */
    public function getLevel()
    {
        return $this->level;
    }
}