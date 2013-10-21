<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 4:07 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity;

use Homework\HomeworkBundle\Entity\PropertyCollection\Property;


/** Collection of Property entities
 *
 * Class PropertyCollection
 *
 *  */
class PropertyCollection
{

    /** @var  array */
    protected $properties;

    /** Default Constructor */
    public function __construct()
    {
        $this->properties = array();
    }

    /**
     * @param array $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->properties as $property) {
            $array[] = $property->toArray();
        };

        return $array;
    }

    /** Return entity as JSON
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /** Add a Property to the collection
     *
     * @param Property $property
     */
    public function addProperty(Property $property)
    {
        $this->properties[] = $property;
    }
}