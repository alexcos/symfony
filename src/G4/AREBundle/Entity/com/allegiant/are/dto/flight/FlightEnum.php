<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

/**
 * Flight enumeration factory
 */
class FlightEnum
{

    protected $checker;

    /**
     * class constructor
     *
     * @param string $type the flight type used to initialize the checker
     *
     * @return void
     */
    public function __construct($type)
    {
        $checkClass = "\\G4\\AREBundle\\Entity\\com\\allegiant\\are\\dto\\flight\\".$type;
        if (class_exists($checkClass)) {
            $this->checker = new $checkClass();
        } else {
            throw (object) "The class don't exist";
        }
    }

    /**
     * check that $value is valid
     *
     * @param mixed $value the value to be checked
     *
     * @return void
     */
    public function check($value)
    {
        return $this->checker->check($value);
    }

}

/**
 * Types allowed for depart/arrive request
 */
class DepartArriveRequestType
{
    const ONEWAY = 'ORIGIN_OUTBOUND';
    const RETURNS = 'RETURN_TO_ORIGIN';

    protected $departArriveRequestType = array(
        self::ONEWAY, "origin-outbound", // one-way
        "continuation",
        self::RETURNS, "return-to-origin", // return
    );

    /**
     * check that $value is valid
     *
     * @param mixed $value the value to be checked
     *
     * @return void
     */
    public function check($value)
    {
        if (in_array($value, $this->departArriveRequestType)) {
            return true;
        } else {
            return false;
        }
    }

}

/**
 * Types allowed for adjacent seats
 */
class SeatAdjacentItem
{

    protected $seatAdjacentItem = array("none","seat","space","bulkhead-front","bulkhead-back","bulkhead-separator","bulkhead-galley","bulkhead-head","window","exit-primary","exit-secondary");

    /**
     * check that $value is valid
     *
     * @param mixed $value the value to be checked
     *
     * @return void
     */
    public function check($value)
    {
        if (in_array($value, $this->seatAdjacentItem)) {
         return true;
        } else {
         return false;
        }
    }
}

/**
 * Types allowed for seat size
 */
class SeatSize
{

    protected $seatSize = array("jump","standard","large");

    /**
     * check that $value is valid
     *
     * @param mixed $value the value to be checked
     *
     * @return void
     */
    public function check($value)
    {
        if (in_array($value, $this->seatSize)) {
            return true;
        } else {
            return false;
        }
    }

}

/**
 * Types allowed for seat position
 */
class SeatPosition
{

    protected $seatPosition = array("window-on-right","window-on-left","center","isle-on-right","isle-on-left");

    /**
     * check that $value is valid
     *
     * @param mixed $value the value to be checked
     *
     * @return void
     */
    public function check($value)
    {
        if (in_array($value, $this->seatPosition)) {
            return true;
        } else {
            return false;
        }
    }

}

/**
 * Types allowed for filter type
 */
class FilterType
{

    protected $filterType = array("exclude","include","INCLUDE");

    /**
     * check that $value is valid
     *
     * @param mixed $value the value to be checked
     *
     * @return void
     */
    public function check($value)
    {
        if (in_array($value, $this->filterType)) {
            return true;
        } else {
            return false;
        }
    }

}
