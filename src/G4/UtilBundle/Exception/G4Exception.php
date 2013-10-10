<?php
/**
 * PHP version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Exception
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for memcache problems
 */
class G4Exception extends \Exception
{
    private $manifestId = null;
    private $json = '';

    /**
     * __construct
     *
     * @param string    $message    The error message
     * @param string    $manifestId The key/hash that identifies the request
     * @param int       $code       The error code
     * @param \Exception $previous   Previous error if any
     *
     * @access public
     * @return void
     */
    public function __construct($message, $manifestId, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setManifestId($manifestId);
    }

    /**
     * setKey
     *
     * @param mixed $key
     *
     * @access public
     * @return void
     */
    public function setManifestId($key)
    {
        $this->manifestId = $key;
    }

    /**
     * getKey
     *
     * @access public
     * @return void
     */
    public function getManifestId()
    {
        return $this->manifestId;
    }

    /**
     * Provide an array representation of the current exception
     *
     * Override this to provide custom feedback
     *
     * @access public
     * @return array
     */
    public function toArray()
    {
        return self::exceptionToArray($this);
    }

    /**
     * Provide an JSON representation of the current exception
     *
     * @access public
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Convert any exception to an array to be serialised
     *
     * @param mixed $exp
     *
     * @static
     * @final
     * @access public
     *
     * @return array
     */
    public static final function exceptionToArray($exp)
    {
        if (method_exists($exp, 'getData') && is_array($exp->getData())) {
            return $exp->getData();
        }

        if (!is_array($exp)) {
            $exp = array($exp);
        }

        $ar = array();
        foreach ($exp as $e) {
            $data = array(
                'level' => 'SYMFONY',
                'type' => get_class($e),
                'code' => $e->getCode(),
                'description' => $e->getMessage(),
                'errorDateTime' => date('c'),
            );
            if (method_exists($e, 'getKey')) {
                $data['key'] = $e->getKey();
            }
            $ar[] = $data;
        }

        return array('error' => $ar);
    }

    public function setJson($json)
    {
        $this->json = $json;
    }

    public function getJson()
    {
        return $this->json;
    }
}
