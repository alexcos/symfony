<?php
/**
 * Listen to controller actions and handle them appropriately
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Listener
 */
namespace G4\UtilBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

use Symfony\Component\HttpFoundation\Request;

use G4\UtilBundle\Events\MessageLoggingEvent;

/**
 * Listener for actions
 */
class RequestListener
{
    private $time = null;
    private $kernel = null;

    private $req = null;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
        $logger = $this->kernel->getContainer()->get('g4_logging');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->time = microtime(true);

        $request = $event->getRequest();
        $this->req = $request;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $time = microtime(true);
        /*
        $response = $event->getResponse();

        $attributes = $this->req->attributes;
        $request    = $this->req->request;
        $query      = $this->req->query;
        $server     = $this->req->server;
        $cookies    = $this->req->cookies;

        $this->logger->debug('attributes: ' . implode(', ', $attributes->keys()));
        $this->logger->debug('request: ' . implode(', ', $request->keys()));
        $this->logger->debug('query: ' . implode(', ', $query->keys()));
        $this->logger->debug('server: ' . implode(', ', $server->keys()));
        $this->logger->debug('cookies: ' . implode(', ', $cookies->keys()));

        // $this->logger->debug('ROUTE: ' . $this->req->get('_route'));
        // $this->logger->debug('HASH: ' . $this->req->get('_hash'));

        // Try and get a UI for this route
        $route = $this->req->get('_route');
        $rhash = $this->req->get('_hash');

        $this->logger->info('ROUTE: ' . $route);
        $this->logger->info('RHASH: ' . $rhash);
        $this->logger->info('POST:  ' . implode(', ', $request->keys()));

        $search = $request->get('search');
        $cart = $request->get('cart');

        if (isset($search)) {
            $this->logger->info('search:  ' . $search);
        }

        if (isset($cart)) {
            $this->logger->info('cart:  ' . $cart);
        }
         */
        if (!$this->req) {
            $this->req = Request::createFromGlobals();
        }
        $elapsed = $time - $this->time;
        $event = new MessageLoggingEvent(
            sprintf(
                '%s elapsed time: %f',
                $this->req->get('_route'),
                $elapsed
            ),
            'elapsed',
            array(
                'route' => $this->req->get('_route'),
                'elapsed' => $elapsed,
            )
        );
        $event->setClass(get_class($this));

        $dispatcher = $this->kernel->getContainer()->get('event_dispatcher');
        $dispatcher->dispatch('logger.info', $event);
    }
}
