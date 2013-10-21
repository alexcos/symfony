<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 3:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection;

use
    Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection\Seat\PriceComponentCollection;
use
    Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection\Seat\PriceComponentCollection\PriceComponent;

/** Seat entity class
 *
 * Class Seat
 *
 */
class Seat
{

    /**
     * TODO get actual type, returns only null
     */
    protected $size;

    /** @var  string */
    protected $row;

    /** @var  string */
    protected $position;

    /** @var  PriceComponentCollection */
    protected $priceComponent;

    /** @var  PriceComponentCollection */
    protected $priceComponentOptional;

    /** @var  string */
    protected $col;

    /** @var  string */
    protected $cabinCode;

    /**
     * TODO get actual type, returns only null
     */
    protected $adjacentInfo;

    protected $restriction; //TODO collection, entity ?!

    /** @var  bool */
    protected $isExitRow;

    /** @var  bool */
    protected $isAvailable;

    /** Default constructor */
    public function __construct()
    {
        $this->setPriceComponentOptional(new PriceComponentCollection());
    }

    /**
     * @param mixed $adjacentInfo
     */
    public function setAdjacentInfo($adjacentInfo)
    {
        $this->adjacentInfo = $adjacentInfo;
    }

    /**
     * @return mixed
     */
    public function getAdjacentInfo()
    {
        return $this->adjacentInfo;
    }

    /**
     * @param string $cabinCode
     */
    public function setCabinCode($cabinCode)
    {
        $this->cabinCode = $cabinCode;
    }

    /**
     * @return string
     */
    public function getCabinCode()
    {
        return $this->cabinCode;
    }

    /**
     * @param string $col
     */
    public function setCol($col)
    {
        $this->col = $col;
    }

    /**
     * @return string
     */
    public function getCol()
    {
        return $this->col;
    }

    /**
     * @param boolean $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

    /**
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * @param boolean $isExitRow
     */
    public function setIsExitRow($isExitRow)
    {
        $this->isExitRow = $isExitRow;
    }

    /**
     * @return boolean
     */
    public function getIsExitRow()
    {
        return $this->isExitRow;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
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
     * @param PriceComponentCollection $priceComponentOptional
     */
    public function setPriceComponentOptional($priceComponentOptional)
    {
        $this->priceComponentOptional = $priceComponentOptional;
    }

    /**
     * @return PriceComponentCollection
     */
    public function getPriceComponentOptional()
    {
        return $this->priceComponentOptional;
    }

    /**
     * @param mixed $restriction
     */
    public function setRestriction($restriction)
    {
        $this->restriction = $restriction;
    }

    /**
     * @return mixed
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * @param string $row
     */
    public function setRow($row)
    {
        $this->row = $row;
    }

    /**
     * @return string
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'size' => $this->getSize(),
            'row' => $this->getRow(),
            'position' => $this->getPosition(),
            'priceComponent' => $this->getPriceComponent(), //TODO toArray()
            'priceComponentOptional' => $this->getPriceComponentOptional()->toArray(),
            'col' => $this->getCol(),
            'cabinCode' => $this->getCabinCode(),
            'adjacentInfo' => $this->getAdjacentInfo(),
            'restriction' => $this->getRestriction(),
            'isExitRow' => $this->getIsExitRow(),
            'isAvailable' => $this->getIsAvailable()

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

        if (isset($stdClass->row) &&
            isset($stdClass->position) &&
            isset($stdClass->priceComponent) &&
            is_array($stdClass->priceComponent) &&
            isset($stdClass->priceComponentOptional) &&
            is_array($stdClass->priceComponentOptional) &&
            isset($stdClass->col) &&
            isset($stdClass->cabinCode) &&
            isset($stdClass->isExitRow) &&
            isset($stdClass->isAvailable)
        ) {
            $this->setRow($stdClass->row);
            $this->setPosition($stdClass->position);
            foreach ($stdClass->priceComponentOptional as $priceComponentStd) {
                $priceComponent = new PriceComponent();
                $priceComponent->fromStdClass($priceComponentStd);
                $this->getPriceComponentOptional()->addPriceComponent($priceComponent);
            }
            foreach ($stdClass->priceComponent as $priceComponentStd) {
                $priceComponent = new PriceComponent();
                $priceComponent->fromStdClass($priceComponentStd);
                $this->getPriceComponent()->addPriceComponent($priceComponent);
            }
            $this->setCol($stdClass->col);
            $this->setCabinCode($stdClass->cabinCode);
            $this->setIsExitRow($stdClass->isExitRow);
            $this->setIsAvailable($stdClass->isAvailable);

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