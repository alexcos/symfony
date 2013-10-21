<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 3:32 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection\Seat\PriceComponentCollection;

use Homework\HomeworkBundle\Entity\PropertyCollection;

/** PriceComponentOptional entity class
 *
 * Class PriceComponent
 *
 * */
class PriceComponent
{
    /** @var  PropertyCollection */
    protected $property;

    /** @var  integer */
    protected $value;

    /** @var  string */
    protected $description;

    /** @var  string */
    protected $source;

    /** @var array TODO type ?! */
    protected $tag; // TODO collection and entity

    /** @var  string */
    protected $code;

    /** @var array TODO type ?! */
    protected $priceComponent; // TODO collection and entity

    /** Default constructor */
    public function __construct()
    {
        $this->setProperty(new PropertyCollection());
        $this->setTag(array());
        $this->setPriceComponent(array());
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $priceComponent
     */
    public function setPriceComponent($priceComponent)
    {
        $this->priceComponent = $priceComponent;
    }

    /**
     * @return mixed
     */
    public function getPriceComponent()
    {
        return $this->priceComponent;
    }

    /**
     * @param PropertyCollection $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return PropertyCollection
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }


    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'property' => $this->getProperty()->toArray(),
            'value' => $this->getValue(),
            'description' => $this->getDescription(),
            'source' => $this->getSource(),
            'tag' => $this->getTag(), //TODO toArray()
            'code' => $this->getCode(),
            'priceComponent' => $this->getPriceComponent() // TODO toArray()
        );

        return $outputArray;
    }

    /** Return entity as JSON
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /** Populate class fields from stdClass entity
     *
     * @param stdClass $stdClass
     */
    public function fromStdClass($stdClass)
    {

        if (isset($stdClass->property) &&
            is_array($stdClass->property) &&
            isset($stdClass->value) &&
            isset($stdClass->description) &&
            isset($stdClass->source) &&
            isset($stdClass->tag) &&
            is_array($stdClass->tag) &&
            isset($stdClass->code) &&
            isset($stdClass->priceComponent) &&
            is_array($stdClass->priceComponent)
        ) {
            foreach ($stdClass->property as $propertyStd) {
                $property = new PropertyCollection\Property();
                $property->fromStdClass($propertyStd);
                $this->getProperty()->addProperty($property);
            }
            $this->setValue($stdClass->value);
            $this->setDescription($stdClass->description);
            $this->setSource($stdClass->source);
            foreach ($stdClass->tag as $tag) {
                //TODO assign tag
            }
            $this->setCode($stdClass->code);
            foreach ($stdClass->priceComponent as $component) {
                //TODO assign code
            }

        }
    }

    /**  Populate class fields from JSON
     *
     * @param string $json
     */
    public function fromJson($json)
    {
        $stdClass = json_decode($json);
        $this->fromStdClass($stdClass);
    }

}