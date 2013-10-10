<?php
namespace G4\UtilBundle\Listener;

use G4\UtilBundle\Events;

/**
 * listener for logging calls for the manifest file
 */
class ManifestListener
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
     * @param \G4\UtilBundle\Events\ManifestEvent $event
     */
    public function onManifestCreateEvent(\G4\UtilBundle\Events\ManifestEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogManifest($event->getHash(), $event->getData(), $event->getClass());
    }

    /**
     * Handles onManifestTouched events
     *
     * @param \G4\UtilBundle\Events\ManifestEvent $event
     *
     * @return void
     */
    public function onManifestTouchedEvent(\G4\UtilBundle\Events\ManifestEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogManifest($event->getHash(), $event->getData(), $event->getClass());
    }

}
