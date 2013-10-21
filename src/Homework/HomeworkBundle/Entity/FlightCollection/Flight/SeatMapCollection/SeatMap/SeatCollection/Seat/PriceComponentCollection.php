<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 4:54 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection\Seat;

use
    Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection\Seat\PriceComponentCollection\PriceComponent;

/**
 * Class PriceComponentCollection
 * @package Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMap\Seat\Seat
 */
class PriceComponentCollection
{
    /** @var  array */
    protected $priceComponentOptionals;

    /** Default constructor */
    public function __construct()
    {
        $this->setPriceComponentOptionals(array());
    }

    /**
     * @param array $priceComponentOptionals
     */
    public function setPriceComponentOptionals($priceComponentOptionals)
    {
        $this->priceComponentOptionals = $priceComponentOptionals;
    }

    /**
     * @return array
     */
    public function getPriceComponentOptionals()
    {
        return $this->priceComponentOptionals;
    }

    /** Return entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->priceComponentOptionals as $priceComponentOptional) {
            $array[] = $priceComponentOptional->toArray();
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
            foreach ($stdClass as $priceComponentStdClass) {
                $priceComponent = new PriceComponent();
                $priceComponent->fromStdClass($priceComponentStdClass);
                $this->addPriceComponent($priceComponent);
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

    /** Add a PriceComponentOptional to the collection
     *
     * @param PriceComponent $priceComponentOptional
     */
    public function addPriceComponent(PriceComponent $priceComponentOptional)
    {
        $this->priceComponentOptionals[] = $priceComponentOptional;
    }
}