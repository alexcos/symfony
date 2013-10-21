<?php
namespace G4\UtilBundle\Exception;

/**
 * Class OtaLookupException
 *
 * @package G4\UtilBundle\Exception
 */
class OtaLookupException extends G4Exception
{
    /**
     * @var
     */
    public $httpCode;
    /**
     * @var
     */
    public $level;

    /** @var string */
    public $type;

    /**
     * @param string $errorCode
     * @param string $httpCode
     * @param int    $level
     * @param string $type
     * @param string $message
     */
    function __construct($httpCode, $errorCode, $level, $type, $message)
    {
        $this->httpCode = $httpCode;
        $this->level = $level;
        $this->type = $type;
        $this->code = $errorCode;
        $this->message = $message;
    }

    /**
     * @param int $errorCode
     */
    public function setHttpCode($errorCode)
    {
        $this->httpCode = $errorCode;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Convert any exception to an array to be serialised
     *
     * @access public
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['error'][0]['type'] = 'OtaLookupException';

        return $array;
    }
}