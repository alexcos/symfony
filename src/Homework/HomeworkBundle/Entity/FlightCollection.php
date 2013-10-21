<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 1:10 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity;

use Homework\HomeworkBundle\Entity\FlightCollection\Flight;

/** Collection of Flight entities
 *
 * Class FlightCollection
 *
 */
class FlightCollection
{
    /** @var  array */
    protected $flights;

    /** Default constructor */
    public function __construct()
    {
        $this->flights = array();
    }

    /**
     * @param array $flights
     */
    public function setFlights($flights)
    {
        $this->flights = $flights;
    }

    /**
     * @return array
     */
    public function getFlights()
    {
        return $this->flights;
    }

    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->flights as $flight) {
            $array[] = $flight->toArray();
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
            foreach ($stdClass as $flightStdClass) {
                $flight = new Flight();
                $flight->fromStdClass($flightStdClass);
                $this->addFlight($flight);
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

    /** Add a Flight to the collection
     *
     * @param FlightCollection\Flight $flight
     */
    public function addFlight(Flight $flight)
    {
        $this->flights[] = $flight;
    }
}