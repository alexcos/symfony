<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 4:38 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap;

use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection\Seat;

/**
 *
 * @package Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMap
 *
 * Class SeatCollection
 */
class SeatCollection
{
    /** @var  array */
    protected $seats;

    /** Default constructor */
    public function __construct()
    {
        $this->seats = array();
    }

    /**
     * @param array $seats
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
    }

    /**
     * @return array
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->seats as $seat) {
            $array[] = $seat->toArray();
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
            foreach ($stdClass as $seatStdClass) {
                $seat = new Seat();
                $seat->fromStdClass($seatStdClass);
                $this->addSeat($seat);
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

    /** Add a Seat to the collection
     *
     * @param Seat $flight
     */
    public function addSeat(Seat $seat)
    {
        $this->seats[] = $seat;
    }
}