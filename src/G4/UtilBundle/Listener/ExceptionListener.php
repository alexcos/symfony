<?php
/**
 * PHP version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Listener
 * @author   Toby Batch <tobias@neontribe.co.uk>
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use G4\UtilBundle\Exception\G4Exception;
use G4\UtilBundle\Exception\BookingProcessException;
use G4\UtilBundle\Events\MessageLoggingEvent;
use G4\UtilBundle\Events\G4TimelineEvent;
use G4\UtilBundle\Events\AjaxEvent;
use G4\UtilBundle\ErrorMapper;

/**
 * Listener for exceptions
 */
class ExceptionListener
{
    /**
     * container
     *
     * @var mixed
     * @access protected
     */
    protected $container;

    /**
     * __construct
     *
     * @param ContainerInterface $container
     *
     * @access public
     * @return void
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Listen to kernel exceptions and handle them appropriately by returning their contents in the response
     *
     * @param Event $event the event that has occurred
     *
     * @return void
     *
     * @todo add an appropriate HTTP status code in addition to the exception contents
     * @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
     */
    public function onKernelException(Event $event)
    {
        /** @var $exception \Exception */
        $exception = $event->getException();
        $exceptionClassName = get_class($exception);
        $response = null;
        $header = 0;

        switch ($exceptionClassName) {
            case 'G4\UtilBundle\Exception\BadResWebException':
            case 'G4\UtilBundle\Exception\MemcacheException':
            case 'G4\UtilBundle\Exception\NoDocketsException':
                $header = 500;
                $response = new Response($exception->toJson(), $header, array('Content-Type' => 'application/json'));
                break;
            case 'BookingProcessException' :
            case 'G4\UtilBundle\Exception\BookingProcessException':
            case 'G4\UtilBundle\Exception\ReswebVoucherException':
                $header = $exception->getCode();
                $response = new Response(
                    json_encode($exception->getData()),
                    $header,
                    array('Content-Type' => 'application/json')
                );
                break;
            case '\G4\UtilBundle\Exception\CheckinProcessException':
            case 'G4\UtilBundle\Exception\CheckinProcessException':
            case 'CheckinProcessException' :
                $header = $exception->getCode();
                $response = new Response(
                    json_encode($exception->getData()),
                    $header,
                    array('Content-Type' => 'application/json')
                );
                break;
            case 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException':
            case 'G4\UtilBundle\Exception\NotFoundHttpException':
                // returning normal 404 status, not a 200 with json-encoded data
                //      like the default case
                $header = 404;
                $response = new Response($exception->getMessage(), $header);
                break;
            case 'G4\UtilBundle\Exception\ConnectionException':
            case 'ConnectionException' :
                $header = 503;
                $response = new Response($exception->getMessage(), $header);
                // there might be no 'g4_logging' available, since there might be no memcache connection
                $this->container->get('logger')->crit(sprintf(
                    "%s\n%s",
                    $exception->getMessage(),
                    print_r($exception->getTraceAsString(), true)
                ));
                break;
            case 'G4\UtilBundle\Exception\ReswebBookCartTimeoutException' :
            case 'ReswebBookCartTimeoutException' :
                $header = 409;
                $response = new Response($exception->toJson(), $header);
                break;
            case 'G4\UtilBundle\Exception\OtaLookupException' :
            case 'G4\ModifyLiteBundle\Exception\ModifyLiteProcessException' :
            case 'ModifyLiteProcessException' :
            case 'G4\ModifyLiteBundle\Exception\ModifyLiteReswebException' :
            case 'ModifyLiteReswebException' :
            case 'G4\ModifyLiteBundle\Exception\ModifyLiteException' :
            case 'ModifyLiteException' :
                $response = new Response($exception->toJson(), $exception->getHttpCode());
                break;
            case 'G4\UtilBundle\Exception\RestfulException':
            case 'RestfulException' :
                $header = $exception->getCode();
                $response = new Response($exception->toJson(), $header);
                break;
            default:
                $header = 500;
                $response = new Response(
                    json_encode(G4Exception::exceptionToArray($exception)),
                    $header
                );
                break;
        }

        //log the exception using the manifestId from the container service and the requestPairKey that were saved in the Logging service at the beginning of the action
        $manifestId = $this->container->get('g4_container')->getManifestId();
        $requestPairKey = $this->container->get('g4_container')->getRequestPairKey();

        $silo = $this->container->getParameter('g4_silo');
        $err = array(
            'message' => $exception->getMessage(),
            'exception' => G4Exception::exceptionToArray($exception),
            'silo' => $silo,
            'trace' => explode("\n", $exception->getTraceAsString()),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'manifestId' => $manifestId,
        );

        //do not log some ResWeb errors as application errors; please log all errors if there are more than 1 error
        if (method_exists($exception, 'getData') && !empty($exception->getData()->error) && count($exception->getData()->error) == 1 && ErrorMapper::excludeFromLogger($exception->getData()->error)) {
            //for now do not log at all
            //$this->container->get('logger')->warn($response->getContent(), $err);
        } else {
            $this->container->get('logger')->err($response->getContent(), $err);
        }

        if ($this->container->get('g4_container')->getRequestType() == \G4\UtilBundle\Services\G4Container::REQUEST_TYPE_AJAX) {
            $this->container->get('event_dispatcher')->dispatch('utilbundle.ajaxout', new AjaxEvent($manifestId, $response->getContent(), get_class($this), '', $requestPairKey, $header));
        }

        if ($this->container->get('g4_container')->getRequestType() == \G4\UtilBundle\Services\G4Container::REQUEST_TYPE_SYMFONY) {
            $this->container->get('event_dispatcher')->dispatch('utilbundle.symfout', new \G4\UtilBundle\Events\SymfonyEvent($manifestId, $response->getContent(), get_class($this), '', $requestPairKey, $header));
        }

        if ($response) {
            $event->setResponse($response);
        }
    }

}
