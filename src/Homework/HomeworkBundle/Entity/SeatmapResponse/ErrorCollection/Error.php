<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/21/13
 * Time: 10:49 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\SeatmapResponse\ErrorCollection;

use Homework\HomeworkBundle\Entity\PropertyCollection;

/**
 * Class Error
 *
 * @package Homework\HomeworkBundle\Entity\SeatmapResponse\ErrorCollection
 */
class Error
{

    /** @var  PropertyCollection */
    protected $property;

    /** @var  string */
    protected $level;

    /** @var  string */
    protected $description;

    /** @var  string */
    protected $code;

    /** @var  string */
    protected $errorDateTime;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->setProperty(new PropertyCollection());
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
     * @param string $errorDateTime
     */
    public function setErrorDateTime($errorDateTime)
    {
        $this->errorDateTime = $errorDateTime;
    }

    /**
     * @return string
     */
    public function getErrorDateTime()
    {
        return $this->errorDateTime;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param \Homework\HomeworkBundle\Entity\PropertyCollection $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return \Homework\HomeworkBundle\Entity\PropertyCollection
     */
    public function getProperty()
    {
        return $this->property;
    }

    /** Exports entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'property' => $this->getProperty()->toArray(),
            'level' => $this->getLevel(),
            'description' => $this->getDescription(),
            'code' => $this->getCode(),
            'errorDateTime' => $this->getErrorDateTime()
        );

        return $outputArray;
    }

    /** Exports entity as Json
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
            isset($stdClass->level) &&
            isset($stdClass->description) &&
            isset($stdClass->code) &&
            isset($stdClass->errorDateTime)
        ) {
            foreach ($stdClass->property as $propertyStd) {
                $property = new Property();
                $property->fromStdClass($propertyStd);
                $this->getProperty()->addProperty($property);
            }
            $this->setLevel($stdClass->level);
            $this->setDescription($stdClass->description);
            $this->setCode($stdClass->code);
            $this->setErrorDateTime($stdClass->errorDateTime);
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