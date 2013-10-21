<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.soa.are.common
 */

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile
 */
class UserProfile
{

    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $pwd
     */
    public $pwd;

    /**
     * @var string $appName
     */
    public $appName;

    /**
     * @var string $moduleName
     */
    public $moduleName;

    /**
     * @var string $sessionID
     */
    public $sessionID;

    /**
     * @var string $ipAddress
     */
    public $ipAddress;



    /**
     * class constructor
     *
     * @param stdClass $data data
     *
     * @return void
     */
    public function __construct($data = null)
    {
        \G4\UtilBundle\EntityHelper::populate($this, $data);
    }

    /**
     * Set name
     *
     * @param string $name name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pwd
     *
     * @param string $pwd password
     *
     * @return void
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    /**
     * Get pwd
     *
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set appName
     *
     * @param string $appName application name
     *
     * @return void
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;
    }

    /**
     * Get appName
     *
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * Set moduleName
     *
     * @param string $moduleName module name
     *
     * @return void
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    /**
     * Get moduleName
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Set sessionID
     *
     * @param string $sessionID session identifier
     *
     * @return void
     */
    public function setSessionID($sessionID)
    {
        $this->sessionID = $sessionID;
    }

    /**
     * Get sessionID
     *
     * @return string
     */
    public function getSessionID()
    {
        return $this->sessionID;
    }

    /**
     * Set ipAddress
     *
     * @param $ipAddress
     *
     * @return void
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param int $requestSourceID
     */
    public function setRequestSourceId($requestSourceID)
    {
        $this->requestSourceId = $requestSourceID;
    }

    /**
     * There is no 'requestSourceId' field in the class definition because at the moment
     * only .167 resweb knows about this field, and adding it will make json_encode add it to the request
     * and the older versions of resweb will reject the request because of the unknown property
     * @return int
     */
    public function getRequestSourceId()
    {
        if (isset($this->requestSourceId)) {
            return $this->requestSourceId;
        }

        return null;
    }


}