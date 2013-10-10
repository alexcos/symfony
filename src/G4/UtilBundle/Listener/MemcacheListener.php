<?php
namespace G4\UtilBundle\Listener;

use G4\UtilBundle\Events;

/**
 * listener for memcache reads/writes
 */
class MemcacheListener
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
     * @param \G4\UtilBundle\Events\MemcacheEvent $event
     */
    public function onWriteEvent(\G4\UtilBundle\Events\MemcacheEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogMCWrite($event->getHash(), $event->getData(), $event->getClass());
    }

    /**
     * @param \G4\UtilBundle\Events\MemcacheEvent $event
     */
    public function onReadEvent(\G4\UtilBundle\Events\MemcacheEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogMCRead($event->getHash(), $event->getData(), $event->getClass());
    }
}
