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
use Homework\HomeworkBundle\Entity\CallerInfo;
use Homework\HomeworkBundle\Entity\PayloadAttributes;

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

    /** @var  PayloadAttributes */
    protected $payloadAttributes;

    /**
     * @param \Homework\HomeworkBundle\Entity\CallerInfo $callerInfo
     */
    public function setCallerInfo($callerInfo)
    {
        $this->callerInfo = $callerInfo;
    }

    /**
     * @return \Homework\HomeworkBundle\Entity\CallerInfo
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