<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 3:05 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection;

use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection\Seat;
use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection;

/** SeatMap entity object
 *
 * Class SeatMap
 *
 */
class SeatMap
{

    /** @var  SeatCollection */
    protected $seat;

    /** @var  integer */
    protected $numRows;

    /** @var  integer */
    protected $numCols;

    /** @var  integer */
    protected $firstRow;

    /** @var  integer */
    protected $lastRow;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->setSeat(new SeatCollection());
    }

    /**
     * @param int $firstRow
     */
    public function setFirstRow($firstRow)
    {
        $this->firstRow = $firstRow;
    }

    /**
     * @return int
     */
    public function getFirstRow()
    {
        return $this->firstRow;
    }

    /**
     * @param int $lastRow
     */
    public function setLastRow($lastRow)
    {
        $this->lastRow = $lastRow;
    }

    /**
     * @return int
     */
    public function getLastRow()
    {
        return $this->lastRow;
    }

    /**
     * @param int $numCols
     */
    public function setNumCols($numCols)
    {
        $this->numCols = $numCols;
    }

    /**
     * @return int
     */
    public function getNumCols()
    {
        return $this->numCols;
    }

    /**
     * @param int $numRows
     */
    public function setNumRows($numRows)
    {
        $this->numRows = $numRows;
    }

    /**
     * @return int
     */
    public function getNumRows()
    {
        return $this->numRows;
    }

    /**
     * @param SeatCollection $seat
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;
    }

    /**
     * @return SeatCollection
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /** Exports entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'seat' => $this->getSeat()->toArray(),
            'numRows' => $this->getNumRows(),
            'numCols' => $this->getNumCols(),
            'firstRow' => $this->getFirstRow(),
            'lastRow' => $this->getLastRow()
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

        if (isset($stdClass->seat) &&
            is_array($stdClass->seat) &&
            isset($stdClass->numRows) &&
            isset($stdClass->numCols) &&
            isset($stdClass->firstRow) &&
            isset($stdClass->lastRow)

        ) {
            foreach ($stdClass->seat as $seatStd) {
                $seat = new Seat();
                $seat->fromStdClass($seatStd);
                $this->getSeat()->addSeat($seat);
            }
            $this->setNumRows($stdClass->numRows);
            $this->setNumCols($stdClass->numCols);
            $this->setFirstRow($stdClass->firstRow);
            $this->setLastRow($stdClass->lastRow);
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