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

use G4\UtilBundle\ErrorMapper;
use G4\UtilBundle\Events\LoggingEvent;

/**
 * Listener that notifies third-party applications about errors found in RESWEB responses
 */
class NotificationListener
{
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';
    const TYPE_INFO = 'info';

    protected $errors = array(
        ErrorMapper::DOCKET_HOTEL_FIELD_MISSING,
        ErrorMapper::DOCKET_HOTEL_FIELD_NOT_NUMERIC,
        ErrorMapper::RESWEB_HOTEL_INVALID_HOTELMSTR,
        ErrorMapper::DOCKET_PRODUCT_FIELD_MISSING
    );

    protected $kernel;

    /**
     * @param object $kernel
     */
    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }
    /**
     * @param \G4\UtilBundle\Events\MessageLoggingEvent $event
     */
    public function error($event)
    {
        if (!($event instanceof LoggingEvent)) {
            $this->kernel->getContainer()->get('g4_logging')->warn(
                sprintf(
                    'Logging triggered with unkown event, %s',
                    get_class($event)
                )
            );

            return;
        }

        $context = $event->getContext();
        $this->handleErrors($context['manifestId'], $context['json']);
    }
    /**
     * Handle errors received from resweb
     * @param string $manifestId ManifestId string
     * @param array  $results    Results received from resweb
     *
     * @return void
     */
    public function handleErrors($manifestId, $results)
    {
        $messages = array();

        if (!is_array($results)) {
            $this->kernel->getContainer()->get('g4_logging')->warn(
                "Wrong result parameter type sent, it needs to be an array"
            );
            return;
        }

        if (array_key_exists('error', $results) and count($results['error'])>0) {
            foreach ($results['error'] as $error) {
                if (in_array($error['code'], $this->errors)) {
                    $messages[] = $error;
                }
            }
            if (count($messages) > 0) {
                $this->sendNotification($manifestId, array(self::TYPE_ERROR =>$messages));
            }
        }

    }

    /**
     * Send notifications
     * @param array $message
     */
    public function sendNotification($manifestId, array $message)
    {
        /** @var \G4\UtilBundle\ServicesCall $service  */
        $service = $this->kernel->getContainer()->get('g4_services_call');
        $secret = $this->kernel->getContainer()->getParameter("g4_profile_service_hash");
        $timeout = $this->kernel->getContainer()->getParameter('g4_timeout_docket');
        $url = sprintf("%s/%s?secret=%s",
            $this->kernel->getContainer()->getParameter("g4_drupal"),
            "services/messaging/errors.json",
            $secret
        );
        $data = array(
            "data"=>json_encode($message),
            "secret" => $secret
        );

        try {
            $service->oneWayRequest($url, http_build_query($data), array('Content-Type: application/x-www-form-urlencoded'));
        } catch (\Exception $e) {
            $dispatcher = $this->kernel->getContainer()->get('event_dispatcher');
            $data = array(
                "url" => $url
            );
            $event = new \G4\UtilBundle\Events\MessageLoggingEvent($manifestId, "Error occured while trying to send notification: ".$e->getMessage(), 'default', $data);
            $event->setClass(get_class($this));
            $dispatcher->dispatch("logger.error", $event);
        }

    }
}
