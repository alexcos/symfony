<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 2:07 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity;

/** PayloadAttributes entity class
 *
 * Class PayloadAttributes
 *
 */
class PayloadAttributes
{

    /** @var  PropertyCollection */
    protected $property;

    /** @var  integer */
    protected $bookingTypeID;

    /** @var  integer */
    protected $bookingChannelID;

    /** @var  string */
    protected $transactionIdentifier;

    /** @var  integer */
    protected $version;

    /** @var  string */
    protected $timeStamp;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->setProperty(new PropertyCollection());
    }

    /**
     * @param int $bookingChannelID
     */
    public function setBookingChannelID($bookingChannelID)
    {
        $this->bookingChannelID = $bookingChannelID;
    }

    /**
     * @return int
     */
    public function getBookingChannelID()
    {
        return $this->bookingChannelID;
    }

    /**
     * @param int $bookingTypeID
     */
    public function setBookingTypeID($bookingTypeID)
    {
        $this->bookingTypeID = $bookingTypeID;
    }

    /**
     * @return int
     */
    public function getBookingTypeID()
    {
        return $this->bookingTypeID;
    }

    /**
     * @param string $timeStamp
     */
    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return string
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * @param string $transactionIdentifier
     */
    public function setTransactionIdentifier($transactionIdentifier)
    {
        $this->transactionIdentifier = $transactionIdentifier;
    }

    /**
     * @return string
     */
    public function getTransactionIdentifier()
    {
        return $this->transactionIdentifier;
    }

    /**
     * @param int $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param \Homework\HomeworkBundle\Entity\PropertyCollection $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return \Homework\HomeworkBundle\Entity\PropertyCollection
     */
    public function getProperty()
    {
        return $this->property;
    }

    /** Exports entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'property' => $this->getProperty()->toArray(),
            'version' => $this->getVersion(),
            'timeStamp' => $this->getTimeStamp(),
            'bookingChannelID' => $this->getBookingChannelID(),
            'bookingTypeID' => $this->getBookingTypeID(),
            'transactionIdentifier' => $this->getTransactionIdentifier(),
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
        if (isset($stdClass)) {
            if (isset($stdClass->property) &&
                is_array($stdClass->property) &&
                isset($stdClass->version) &&
                isset($stdClass->timeStamp) &&
                isset($stdClass->bookingChannelID) &&
                isset($stdClass->bookingTypeID) &&
                isset($stdClass->transactionIdentifier)
            ) {
                foreach ($stdClass->property as $property) {
                    $this->getProperty()->addProperty($property);
                }
                $this->setVersion($stdClass->version);
                $this->setTimeStamp($stdClass->timeStamp);
                $this->setBookingChannelID($stdClass->bookingChannelID);
                $this->setBookingTypeID($stdClass->bookingTypeID);
                $this->setTransactionIdentifier($stdClass->transactionIdentifier);

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
}