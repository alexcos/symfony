<?php
/**
 * Created by JetBrains PhpStorm.
 * User: serbanbajdechi
 * Date: 4/29/13
 * Time: 10:50 PM
 * To change this template use File | Settings | File Templates.
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers;

/**
 * Class Role
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers
 */
class Role
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $permissions;

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

    /**
     * @param array $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}