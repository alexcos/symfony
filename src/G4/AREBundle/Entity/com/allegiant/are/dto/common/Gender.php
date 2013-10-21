<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Email
 */
class Gender
{

    private $genderItem = array("FEMALE","MALE");

    public $gender;

    /**
     * Gender setter
     * @param string $gender Gender
     *
     * @return bool
     */
    public function setGender($gender)
    {
        if (in_array($gender, $this->genderItem)) {
            $this->gender = $gender;

            return true;
        } else {
            return false;
        }
    }

    /**
     * Gender getter
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

}