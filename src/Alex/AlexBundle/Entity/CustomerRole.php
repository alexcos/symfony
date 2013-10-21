<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/8/13
 * Time: 5:19 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Alex\AlexBundle\Entity;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Doctrine\Common\Collections\ArrayCollection;

/** @ExclusionPolicy("none")
 * Class CustomerRole
 * @package Alex\AlexBundle\Entity
 */
class CustomerRole
{

    /** @SerializedName("id")
     * @Type("integer")
     * */
    private $id;
    /** @SerializedName("name")
     * @Type("string")
     */
    private $name;
    /** @SerializedName("customerPermission")
     * @Type("ArrayCollection<Alex\AlexBundle\Entity\CustomerPermission>")
     */
    private $customerPermission;

    /**
     * @param mixed $customerPermission
     */
    public function setCustomerPermission($customerPermission)
    {
        $this->customerPermission = $customerPermission;
    }

    /**
     * @return mixed
     */
    public function getCustomerPermission()
    {
        return $this->customerPermission;
    }

    /**
     * @param mixed $id
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

    /**
     * @param mixed $name
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