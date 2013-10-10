<?php

namespace G4\UtilBundle\Entity;

/**
 *  Service Params
 */
class ServiceParams
{
    const ROLE_CC = 'cc';
    const ROLE_TA = 'ta';

    /**
     * @var string
     */
    public $sessionID;

    /**
     * @var string
     */
    public $clientIP;
    /**
     * @var string
     */
    public $transactionID;

    /**
     * @var integer
     */
    public $bookingTypeID;

    /**
     * @var integer
     */
    private $timestamp;

    /**
     * @var bool
     */
    public $fetchAdditional;

    /**
     * @var $deepLinkSource source of the deep link search
     */
    public $deepLinkSource;

    /** @var  string */
    public $role;

    /**
     * Retrieve the session ID
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionID;
    }

    /**
     * Sets the session ID
     *
     * @param string $id session id
     *
     * @return void
     */
    public function setSessionId($id)
    {
        $this->sessionID = $id;
    }

    /**
     * Retrieve the client IP address
     *
     * @return string
     */
    public function getClientIp()
    {
        return $this->clientIP;
    }

    /**
     * Sets the client IP address
     *
     * @param string $ip client IP address
     *
     * @return void
     */
    public function setClientIp($ip)
    {
        $this->clientIP = $ip;
    }

    /**
     * Retrieve the transaction identifier
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionID;
    }

    /**
     * Sets the transaction identifier
     *
     * @param string $id transaction identifier
     *
     * @return void
     */
    public function setTransactionId($id)
    {
        $this->transactionID = $id;
    }

    /**
     * @param int $bookingTypeId
     */
    public function setBookingTypeId($bookingTypeId)
    {
        $this->bookingTypeID = $bookingTypeId;
    }

    /**
     * @return int
     */
    public function getBookingTypeId()
    {
        return $this->bookingTypeID;
    }

    /**
     * Retrieve the request timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Sets the request timestamp
     *
     * @param string $t request timestamp
     *
     * @return void
     */
    public function setTimestamp($t)
    {
        $this->timestamp = $t;
    }

    /**
     * @param boolean $fetchAdditional
     */
    public function setFetchAdditional($fetchAdditional)
    {
        $this->fetchAdditional = $fetchAdditional;
    }

    /**
     * @return boolean
     */
    public function getFetchAdditional()
    {
        return $this->fetchAdditional;
    }

    /**
     * Set deep link source name. This is restricted to only some values.
     * @param string $deepLinkSource Deep link source name
     */
    public function setDeepLinkSource($deepLinkSource)
    {
        $this->deepLinkSource = $deepLinkSource;
    }

    /**
     * @return mixed
     */
    public function getDeepLinkSource()
    {
        return $this->deepLinkSource;
    }

    /**
     * Setter Role
     *
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Getter Role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

}
