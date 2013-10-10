<?php
namespace G4\UtilBundle\Listener;

use G4\UtilBundle\Events;

/**
 * listener for resweb calls
 */
class ReswebCallListener
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
     * @param \G4\UtilBundle\Events\ReswebCallEvent $event
     */
    public function onRequestEvent(\G4\UtilBundle\Events\ReswebCallEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogResWebRequest($event->getHash(), $event->getData(), $event->getClass(), $event->getUrl(), $event->getPairKey());
    }

    /**
     * @param \G4\UtilBundle\Events\ReswebCallEvent $event
     */
    public function onResponseEvent(\G4\UtilBundle\Events\ReswebCallEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogResWebResponse($event->getHash(), $event->getData(), $event->getClass(), $event->getUrl(), $event->getPairKey(), $event->getCurlInfo());
    }
}
