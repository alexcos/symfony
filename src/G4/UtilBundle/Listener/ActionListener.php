<?php
/**
 * Listen to controller actions and handle them appropriately
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Listener
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use G4\UtilBundle\Events\MessageLoggingEvent;
/**
 * Listener for actions
 */
class ActionListener
{
    private $kernel = null;

    /**
     * Constructor
     *
     * @param $kernel
     */
    public function __construct($kernel)
    {
        $this->kernel = $kernel;
        //$logger = $this->kernel->getContainer()->get('g4_logging');
    }

    /**
     * Listen to controller actions and handle them appropriately by executing certain methods before that
     *
     * @param FilterControllerEvent $event the event that has occurred
     *
     * @return void
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType() || HttpKernelInterface::SUB_REQUEST === $event->getRequestType()) {
            $controllers = $event->getController();
            if (is_array($controllers)) {
                foreach ($controllers as $controller) {
                    if (is_object($controller)) {
                        if (method_exists($controller, 'preAction')) {
                            $controller->preAction();
                        }
                    }
                }
            }
        }
    }
}
