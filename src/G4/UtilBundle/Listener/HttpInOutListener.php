<?php
namespace G4\UtilBundle\Listener;

use G4\UtilBundle\Events;

/**
 * listener for http in/out calls
 */
class HttpInOutListener
{
    protected $kernel;

    /**
     * @param object $kernel
     */
    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @param \G4\UtilBundle\Events\HttpEvent $event
     */
    public function onInEvent(\G4\UtilBundle\Events\HttpEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogHttpIn($event->getHash(), $event->getData(), $event->getClass(), $event->getUrl(), $event->getPairKey());
    }

    /**
     * @param \G4\UtilBundle\Events\HttpEvent $event
     */
    public function onOutEvent(\G4\UtilBundle\Events\HttpEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogHttpOut($event->getHash(), $event->getData(), $event->getClass(), $event->getUrl(), $event->getPairKey());
    }



}
