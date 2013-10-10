<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.common
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTraveler
 */
class ResTraveler
{

    const ROLE_PRIMARY = 'PRIMARY';
    const ROLE_SECONDARY = 'SECONDARY';
    const ROLE_NA = 'NA';

    private $resTravelerRoleItem = array(self::ROLE_PRIMARY, self::ROLE_SECONDARY, self::ROLE_NA);

    /**
     * @var integer $travelerID
     */
    public $travelerID;

    /**
     * @var com\allegiant\are\dto\common\ResTravelerRole $role
     */
    public $role;

    /**
     * class constructor
     *
     */
    public function __construct()
    {
        //$this->setRole(); //new \G4\AREBundle\Entity\com\allegiant\are\dto\common\ResTravelerRole()
    }

    /**
     * Set travelerID
     *
     * @param integer $travelerID traveller identifier
     *
     * @return void
     */
    public function setTravelerID($travelerID)
    {
        $this->travelerID = $travelerID;
    }

    /**
     * Get travelerID
     *
     * @return integer
     */
    public function getTravelerID()
    {
        return $this->travelerID;
    }

    /**
     * Set role
     *
     * @param com\allegiant\are\dto\common\ResTravelerRole $value traveller role
     *
     * @return void
     */
    public function setRole($value)
    {
        if (in_array($value, $this->resTravelerRoleItem)) {
            $this->role = $value;

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get role
     *
     * @return com\allegiant\are\dto\common\ResTravelerRole
     */
    public function getRole()
    {
        return $this->role;
    }
}