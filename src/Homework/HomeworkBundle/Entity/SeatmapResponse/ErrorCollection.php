<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/21/13
 * Time: 10:49 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\SeatmapResponse;


use Homework\HomeworkBundle\Entity\SeatmapResponse\ErrorCollection\Error;

/**
 * Class ErrorCollection
 *
 * @package Homework\HomeworkBundle\Entity\SeatmapResponse
 */
class ErrorCollection
{

    /** @var  Error[] */
    protected $errors;


    public function __construct()
    {
        $this->setErrors(array());
    }

    /**
     * @param \Homework\HomeworkBundle\Entity\SeatmapResponse\ErrorCollection\Error[] $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return \Homework\HomeworkBundle\Entity\SeatmapResponse\ErrorCollection\Error[]
     */
    public function getErrors()
    {
        return $this->errors;
    }


    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->errors as $error) {
            $array[] = $error->toArray();
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

    /** Populate class fields from stdClass entity
     *
     * @param stdClass $stdClass
     */
    public function fromStdClass($stdClass)
    {

        if (is_array($stdClass)
        ) {
            foreach ($stdClass as $errorStdClass) {
                $error = new Error();
                $error->fromStdClass($errorStdClass);
                $this->addError($error);
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

    /** Add an error to the collection
     *
     * @param Error $error
     */
    public function addError(Error $error)
    {
        $this->errors[] = $error;
    }

}