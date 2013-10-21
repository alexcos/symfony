<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 1:25 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Entity\SeatmapRequest;

/** CallerInfo entity
 *
 * Class CallerInfo
 *
 */
class CallerInfo
{
    /** @var  string */
    protected $name;

    /** @var  string */
    protected $pwd;

    /** @var  string */
    protected $appName;

    /** @var  string */
    protected $moduleName;

    /** @var  string */
    protected $sessionID;

    /** @var  string */
    protected $ipAddress;

    /**
     * @param string $appName
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;
    }

    /**
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $moduleName
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    /**
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param string $sessionID
     */
    public function setSessionID($sessionID)
    {
        $this->sessionID = $sessionID;
    }

    /**
     * @return string
     */
    public function getSessionID()
    {
        return $this->sessionID;
    }

    /** Exports entity as array
     *
     * @return array
     */
    public function toArray()
    {
        $outputArray = array(
            'name' => $this->getName(),
            'pwd' => $this->getPwd(),
            'appName' => $this->getAppName(),
            'moduleName' => $this->getModuleName(),
            'sessionID' => $this->getSessionID(),
            'ipAddress' => $this->getIpAddress()
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

}