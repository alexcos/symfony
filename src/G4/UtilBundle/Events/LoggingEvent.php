<?php
namespace G4\UtilBundle\Events;

use Symfony\Component\EventDispatcher\Event;

/**
 * Root logging object
 */
abstract class LoggingEvent extends Event
{
    /**
     * @var string the manifestID from the user search
     */
    protected $manifestId;
    protected $message;
    protected $mask;
    /**
     * @var array
     */
    protected $context;
    protected $json;
    /**
     * @var string
     */
    protected $class = '';

    /**
     * __construct
     *
     * @param string       $manifestId the manifest id
     * @param mixed        $message    The message attached to the event
     * @param string       $mask       The named mask to use
     * @param array        $context    Additional data that will json encoded
     * @param array|object $json       json
     *
     * @access public
     * @return \G4\UtilBundle\Events\LoggingEvent
     */
    public function __construct($manifestId, $message, $mask = 'default', array $context = array(), $json = array())
    {
        $this->manifestId = $manifestId;
        $this->message = $message;
        $this->mask = $mask;
        $context['json'] = $json;
        $context['manifestId'] = $manifestId;

        $this->context = $context;
    }

    /**
     * getMessage
     *
     * @access public
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * setMessage
     *
     * @param mixed $message
     *
     * @access public
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * getMask
     *
     * @access public
     * @return string
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * setMask
     *
     * @param mixed $mask
     *
     * @access public
     * @return void
     */
    public function setMask($mask)
    {
        $this->mask = $mask;
    }

    /**
     * getClass
     *
     * @access public
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * setClass
     *
     * @param mixed $class
     *
     * @access public
     * @return void
     */
    public function setClass($class)
    {
        if (is_object($class)) {
            $this->class = get_class($class);
        } else {
            $this->class = $class;
        }
    }

    /**
     * getContext
     *
     * @access public
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * setContext
     *
     * @param mixed $context
     *
     * @access public
     * @return void
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * buildContext
     *
     * Override this in child events to alter the context
     *
     * @access public
     * @return array
     */
    public function buildContext()
    {
        return $this->getContext();
    }

    /**
     * Sets the manifest Id value
     *
     * @param string $manifestId
     *
     * @return void
     */
    public function setManifestId($manifestId)
    {
        $this->manifestId = $manifestId;
    }

    /**
     * Retrieve the manifestID value
     *
     * @return string
     */
    public function getManifestId()
    {
        return $this->manifestId;
    }

}
