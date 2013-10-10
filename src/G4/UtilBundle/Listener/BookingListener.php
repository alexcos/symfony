<?php
namespace G4\UtilBundle\Listener;

use G4\UtilBundle\Events;

/**
 * listener for logging calls for the manifest file
 */
class BookingListener
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
     * @param \G4\UtilBundle\Events\BookingEvent $event
     */
    public function onBookingEvent(\G4\UtilBundle\Events\BookingEvent $event)
    {
        $this->kernel->getContainer()->get('g4_logging_timeline')->timelineLogBooking($event->getHash(), $event->getData(), $event->getClass());
    }


}
