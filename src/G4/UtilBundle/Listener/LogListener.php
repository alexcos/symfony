<?php

/**
 * Logged message listener
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Listener
 *
 * @author   Toby Batch <tobias@neontribe.co.uk>
 * @author   Victor Vacaretu <victor@cloudtroopers.ro>
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Listener;

use G4\UtilBundle\Events\LoggingEvent;

/**
 * listener for logged messages using the new system
 */
class LogListener
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
     * __call
     *
     * @param mixed $name
     * @param mixed $args
     *
     * @access public
     * @return void
     */
    public function __call($name, $args)
    {
        if (! isset($args[0]) || empty($args[0])) {
            $this->kernel->getContainer()->get('g4_logging')->warn('Logging triggered without an event');

            return;
        }

        $event = $args[0];
        if (!($event instanceof LoggingEvent)) {
            $this->kernel->getContainer()->get('g4_logging')->warn(
                sprintf(
                    'Logging triggered with unkown event, %s',
                    get_class($event)
                )
            );

            return;
        }

        $message = $event->getMessage();
        $context = $event->buildContext();
        if (is_object($context)) {
            $context = json_decode(json_encode($context), true);
        } elseif (is_string($context)) {
            $context = json_decode($context, true);
        }
        $context['type'] = $name;
        $context['mask'] = $event->getMask();
        $context['class'] = $event->getClass();
        $context['event_class'] = get_class($event);

        switch ($name) {
            case 'onKayakInEvent':
            case 'onKayakOutEvent':
            case 'onSymfInEvent':
            case 'onSymfOutEvent':
            case 'onAjaxInEvent':
            case 'onAjaxOutEvent':
            case 'onReswebRequest':
            case 'onReswebResponse':
                $context['url'] = $event->getUrl();
                $context['pairKey'] = $event->getPairKey();
                $context['responseCode'] = $event->getResponseCode();
            case 'onKernelException':
            case 'onWriteEvent':
                $this->kernel->getContainer()->get('g4_logging')->info($message, $context);
                break;
            case 'onManifestCreate'  :
            case 'onManifestTouched' :
                $this->kernel->getContainer()->get('g4_logging')->info($message, $context);
                break;
            case 'onBooking':
                $this->kernel->getContainer()->get('g4_logging')->info($message, $context);
                break;
            case 'onReswebStatEvent' :
                $context['type']    = 'ReswebStat';
                $context['mask']    = $event->getMask();
                $context['pairKey'] = $event->getPairKey();
                $this->kernel->getContainer()->get('g4_logging')->info($message, $context);
                break;
            case 'onSearchStartEvent' :
                $this->kernel->getContainer()->get('g4_logging')->info($message, $context);
                break;
            case 'onNoFlightsSameDay' :
                $this->kernel->getContainer()->get('g4_logging')->info($message, $context);
                break;
            case 'debug'  :
            case 'info'   :
            case 'notice' :
            case 'warn'   :
            case 'err'    :
            case 'crit'   :
            case 'alert'  :
            case 'emerg'  :
                $this->kernel->getContainer()->get('g4_logging')->$name($message, $context);
                break;
            default:
                $this->kernel->getContainer()->get('g4_logging')->warn(sprintf('Unknown log method `%s`', $name));
                break;
        }
    }
}
