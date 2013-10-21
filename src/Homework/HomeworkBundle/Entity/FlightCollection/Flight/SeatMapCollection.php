<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/18/13
 * Time: 12:16 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\FlightCollection\Flight;

use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap;

/**
 * Class SeatMapCollection
 *
 * @package Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMap
 */
class SeatMapCollection
{
    /** @var  array */
    protected $seatMaps;

    /** Default constructor */
    public function __construct()
    {
        $this->seatMaps = array();
    }

    /**
     * @param array $seatMaps
     */
    public function setSeatMaps($seatMaps)
    {
        $this->seatMaps = $seatMaps;
    }

    /**
     * @return array
     */
    public function getSeatMaps()
    {
        return $this->seatMaps;
    }

    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->seatMaps as $seatMap) {
            $array[] = $seatMap->toArray();
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
            foreach ($stdClass as $seatMapStdClass) {
                $seatMap = new SeatMap();
                $seatMap->fromStdClass($seatMapStdClass);
                $this->addSeatMap($seatMap);
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

    /** Add a SeatMap to the collection
     *
     * @param SeatMap $seatMap
     */
    public function addSeatMap($seatMap)
    {
        $this->seatMaps[] = $seatMap;
    }


}