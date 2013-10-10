<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/8/13
 * Time: 7:10 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Alex\AlexBundle\Entity;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/** @ExclusionPolicy("none")
 * Class CustomerPermission
 * @package Alex\AlexBundle\Entity
 */
class CustomerPermission {

    /** @SerializedName("id")
     *  @Type("integer")
     * */
    private $id;
    /** @SerializedName("name")
     *  @Type("string")
     */
    private $name;

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