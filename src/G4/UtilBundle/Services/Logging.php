<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.SearchBundle.Tests.Controller
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Services;

use Doctrine\CouchDB\CouchDBException;
use G4\UtilBundle\Exception\ConnectionException;
use \Symfony\Component\DependencyInjection\ContainerAware;


// [time stamp] [machine name] [code version] [manifest id] [remote ip] [type] [mask] [payload]
// Time stamp and machine name are supplied by syslog

/**
 * Logging service for the G4 package
 */
class Logging extends ContainerAware
{
    /**
     * @var object The logger instance; default is Symfony\Bridge\Monolog\Logger
     */
    private $logger;

    /**
     * @var array array with registered classNames.
     */
    private $registeredObjectsArray = array();

    /**
     * @var string The manifest ID
     */
    private $manifestId = null;

    /**
     * Class constructor
     *
     * @param Symfony\Component\DependencyInjection\Container $container
     *
     * @return void
     */
    public function __construct($container)
    {
        $this->container = $container;
        $this->registeredObjectsArray = array();

        $this->logger   = $this->container->get('logger');
    }

    /**
     * @param string $uid
     */
    public function setUID($uid)
    {
        $this->container->get('monolog.processor.session_request')->setTransactionId($uid);
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Catch-all for the logging methods.
     * Supports all the methods in the \Monolog\Logger class.
     *
     * @param string $name The logger method
     * @param array  $args The method arguments
     *
     * @return void
     */
    public function __call($name, $args)
    {
        if (isset($args[1])) {
            $context = $args[1];
        } else {
            $context = array();
        }

        if (!is_array($context)) {
            $context = array($context);
        }

        $message = ! empty($args[0]) ? $args[0] : '';
        switch ($name) {
            case 'debug'  :
            case 'info'   :
            case 'notice' :
            case 'warn'   :
            case 'err'    :
            case 'crit'   :
            case 'alert'  :
            case 'emerg'  :
                $this->logger->$name($message, $context);
                break;
            default:
                $this->logger->err(sprintf('Unknown log method `%s`', $name));
                break;
        }
    }

    /**
     * Store error related to $hash
     *
     * @param string $hash the search unique hash
     * @param string $msg  error message to be stored
     *
     * @return void
     */
    public function hashError($hash, $msg)
    {
        if (is_a($msg, 'Exception')) {
            $this->err($msg->getMessage());
            $msg = self::serializeException($msg);
        } else {
            $this->err($msg);
        }

        $manifest = json_decode($this->container->get('g4_persister_memcache')->get($hash));
        if ((isset($manifest->errors)) && (is_array($manifest->errors))) {
            array_push($manifest->errors, $msg);
        } else {
            $manifest->errors = array($msg);
        }

        $this->container->get('g4_persister_memcache')->set($hash, json_encode($manifest));
    }

    /**
     * Store service error
     *
     * @param string $hash    the search unique hash
     * @param string $type    service type
     * @param object $service service that triggered error
     *
     * @return void
     */
    public function serviceError($hash, $type, $service)
    {
        $msg = sprintf(
            '[SERVICE %s] No data returned, [%s], JSON Sent: %s to %s',
            $type, $service->error, $service->getLastJSON(), $service->getRequestURL()
        );
        $this->hashError($hash, $msg);
    }

    /**
     * Serializes an exception ready to store in memcache
     *
     * @param Exception $exp
     *
     * @static
     * @final
     * @access public
     * @return string
     */
    public static final function serializeException($exp)
    {
        $code = $exp->getCode();
        $mesg = $exp->getMessage();
        $trace = $exp->getTrace();
        $data = array(
            'code' => $code,
            'mesg' => $mesg,
            'trace' => $trace,
        );

        return json_encode($data);
    }
}
