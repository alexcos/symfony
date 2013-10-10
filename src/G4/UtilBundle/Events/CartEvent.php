<?php
namespace G4\UtilBundle\Events;

use Symfony\Component\EventDispatcher\Event;
use G4\UtilBundle\JsonPath;

/**
 * Default message only event
 */
class CartEvent extends MessageLoggingEvent
{
    /**
     * __construct 
     * 
     * @param mixed $trigger 
     * @param array $response 
     * 
     * @access public
     * @return void
     */
    public function __construct($manifestId, $trigger, $response = array())
    {
        parent::__construct(
            $manifestId,
            $trigger,
            'cart',
            array(),
            $response
        );
    }
}
