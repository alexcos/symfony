<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 6:18 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity;

use Homework\HomeworkBundle\Entity\FlightCollection\Flight;
use Homework\HomeworkBundle\Entity\SeatmapResponse\ErrorCollection;
use Homework\HomeworkBundle\Entity\SeatmapResponse\PayloadAttributesSeatmapResponse;

/**
 * Class SeatmapResponse
 *
 * @package Homework\HomeworkBundle\Entity
 */
class SeatmapResponse
{

    /** @var  FlightCollection */
    protected $flight;

    /** @var  ErrorCollection */
    protected $error;

    /** @var  PayloadAttributes */
    protected $payloadAttributes;

    /** @var  array
     * TODO create real type and collection
     * */
    protected $warning;

    /** Default constructor */
    public function __construct()
    {
        $this->setFlight(new FlightCollection());
        $this->setError(new ErrorCollection());
        $this->setWarning(array());
        $this->setPayloadAttributes(new PayloadAttributesSeatmapResponse());
    }

    /**
     * @param ErrorCollection $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return ErrorCollection
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param \Homework\HomeworkBundle\Entity\FlightCollection $flight
     */
    public function setFlight($flight)
    {
        $this->flight = $flight;
    }

    /**
     * @return \Homework\HomeworkBundle\Entity\FlightCollection
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * @param PayloadAttributesSeatmapResponse $payloadAttributes
     */
    public function setPayloadAttributes($payloadAttributes)
    {
        $this->payloadAttributes = $payloadAttributes;
    }

    /**
     * @return PayloadAttributesSeatmapResponse
     */
    public function getPayloadAttributes()
    {
        return $this->payloadAttributes;
    }

    /**
     * @param array $warning
     */
    public function setWarning($warning)
    {
        $this->warning = $warning;
    }

    /**
     * @return array
     */
    public function getWarning()
    {
        return $this->warning;
    }


    /** Exports entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'flight' => $this->getFlight()->toArray(),
            'error' => $this->getError()->toArray(),
            'payloadAttributes' => $this->getPayloadAttributes()->toArray(),
            'warning' => $this->getWarning()
        );

        return $outputArray;
    }

    /** Exports entity to Json
     *
     * @return string
     */
    public function toJson()
    {
        $array = $this->toArray();

        return json_encode($array);
    }

    /** Populate class fields from stcClass entity
     *
     * @param stdClass $stdClass
     */
    public function fromStdClass($stdClass)
    {
        if (isset($stdClass->payloadAttributes)) {
            $this->getPayloadAttributes()->fromStdClass($stdClass->payloadAttributes);
        }

        if (isset($stdClass->flight) && is_array($stdClass->flight)) {
            $this->setFlight(new FlightCollection());
            $this->getFlight()->fromStdClass($stdClass->flight);
        }

        if (isset($stdClass->error) && is_array($stdClass->error)) {
            $this->setError(new ErrorCollection());
            $this->getError()->fromStdClass($stdClass->error);
        }
    }

    /** Populates entity fields from JSON
     *
     * @param string $json
     */
    public function fromJson($json)
    {
        $stdClass = json_decode($json);
        $this->fromStdClass($stdClass);
    }
}