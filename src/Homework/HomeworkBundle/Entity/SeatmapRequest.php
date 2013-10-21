<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 2:20 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity;

use Homework\HomeworkBundle\Entity\FlightCollection;
use Homework\HomeworkBundle\Entity\SeatmapRequest\CallerInfo;
use Homework\HomeworkBundle\Entity\SeatmapRequest\PayloadAttributesSeatMapRequest;

/** Entity class for a Seatmap Request
 *
 * Class SeatmapRequest
 *
 */
class SeatmapRequest
{

    /** @var  FlightCollection */
    protected $flight;

    /** @var  CallerInfo */
    protected $callerInfo;

    /** @var  PayloadAttributesSeatMapRequest */
    protected $payloadAttributes;

    /** Default constructor */
    public function __construct()
    {
        $this->setFlight(new FlightCollection());
        $this->setCallerInfo(new CallerInfo());
        $this->setPayloadAttributes(new PayloadAttributesSeatMapRequest());
    }

    /**
     * @param CallerInfo $callerInfo
     */
    public function setCallerInfo($callerInfo)
    {
        $this->callerInfo = $callerInfo;
    }

    /**
     * @return CallerInfo
     */
    public function getCallerInfo()
    {
        return $this->callerInfo;
    }

    /**
     * @param FlightCollection $flight
     */
    public function setFlight($flight)
    {
        $this->flight = $flight;
    }

    /**
     * @return FlightCollection
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * @param PayloadAttributesSeatMapRequest $payloadAttributes
     */
    public function setPayloadAttributes($payloadAttributes)
    {
        $this->payloadAttributes = $payloadAttributes;
    }

    /**
     * @return PayloadAttributesSeatMapRequest
     */
    public function getPayloadAttributes()
    {
        return $this->payloadAttributes;
    }

    /** Exports entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'flight' => $this->getFlight()->toArray(),
            'callerInfo' => $this->getCallerInfo()->toArray(),
            'payloadAttributes' => $this->getPayloadAttributes()->toArray()
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

}