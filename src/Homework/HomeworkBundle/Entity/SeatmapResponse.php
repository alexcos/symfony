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

/**
 * Class SeatmapResponse
 *
 * @package Homework\HomeworkBundle\Entity
 */
class SeatmapResponse
{

    /** @var  FlightCollection */
    protected $flight;

    /** @var  array
     * TODO create real type and collection
     * */
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
        $this->flight = new FlightCollection();
        $this->error = array();
        $this->warning = array();
        $this->payloadAttributes = new PayloadAttributes();
    }

    /**
     * @param array $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return array
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
     * @param \Homework\HomeworkBundle\Entity\PayloadAttributes $payloadAttributes
     */
    public function setPayloadAttributes($payloadAttributes)
    {
        $this->payloadAttributes = $payloadAttributes;
    }

    /**
     * @return \Homework\HomeworkBundle\Entity\PayloadAttributes
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
            'error' => $this->getError(),
            'payloadAttributes' => $this->getPayloadAttributes(),
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
        return json_encode($this->toArray());
    }

    /** Populate class fields from stcClass entity
     *
     * @param stdClass $stdClass
     */
    public function fromStdClass($stdClass)
    {
        if (isset($stdClass->payloadAttributes)) {
            $this->setPayloadAttributes(new PayloadAttributes());
            $this->getPayloadAttributes()->fromStdClass($stdClass->payloadAttributes);
        }

        if (isset($stdClass->flight)) {
            $flightStdClass = $stdClass->flight[0];
            $flight = new Flight();
            $flight->fromStdClass($flightStdClass);

            $this->setFlight(new FlightCollection());
            $this->getFlight()->fromStdClass($stdClass->flight);
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