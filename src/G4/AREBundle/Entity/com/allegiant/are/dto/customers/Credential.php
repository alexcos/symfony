<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers;

/**
 * Class Credential
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers
 */
class Credential
{
    /**
     * @var string
     */
    public $userName;
    /**
     * @var string
     */
    public $password;

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }


}