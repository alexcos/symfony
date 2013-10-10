<?php
namespace G4\UtilBundle\Controller;

/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.HotelBundle.Controller
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use G4\UtilBundle\Exception\PutContentsNotFoundException;
use G4\UtilBundle\Exception\ContainerNotInitializedException;
use G4\UtilBundle\Exception\G4Exception;
use Symfony\Component\HttpFoundation\Response;
use G4\UtilBundle\Events\MessageLoggingEvent;

/**
 * G4Controller
 */
class PersisterController extends G4Controller
{

    /**
     * save body to the location configured in g4_persisters
     *
     * @param string $_hash      the hash
     * @param string $_component the backend component owning the data
     * @param string $_type      'request' or 'response'
     * @param string $_format    the response format (currently only json is supported)
     *
     * @todo replace return new Response(... with return $this->render('UtilBundle:Persister:persist.set.$_format.twig', ...
     *
     * @return Response
     */
    public function setAction($_hash = '', $_component = '', $_type = '', $_format = '')
    {
        $dataForSaving = trim($this->getRequest()->getContent());
        $requestParameters = array(
            'hash' => $_hash,
            'component' => $_component,
            'type' => $_type,
            'format' => $_format,
        );
        if (! strlen($dataForSaving)) {
            return new Response(sprintf('No data to be persisted! %s', json_encode($requestParameters)), 500);
        }

        $adapters = $this->container->getParameter('g4_persisters');
        foreach ($adapters as $adapter) {
            /** @var $lib \G4\UtilBundle\Services\Persister\Persister */
            $lib = $this->get($adapter);
            $key = $lib->configureKey($_hash, $_component, $_type, $_format);
            $success = $lib->set($key, $dataForSaving);
            $requestParameters['success'] = $success;
        }

        $status = 200;
        return new Response(print_r($requestParameters, true), $status);
    }

    /**
     * get data from the locations configured in g4_persisters
     *
     * @param string $_hash      the hash
     * @param string $_component the backend component owning the data
     * @param string $_type      'request' or 'response'
     * @param string $_format    the response format (currently only json is supported)
     *
     * @todo replace return new Response(... with return $this->render('UtilBundle:Persister:persist.get.$_format.twig', ...
     *
     * @return Response
     */
    public function getAction($_hash = '', $_component = '', $_type = '', $_format = '')
    {
        $found = null;
        $adapters = $this->container->getParameter('g4_persisters');

        while (null == $found && 0 < count($adapters)) {
            try {
                $adapter = array_shift($adapters);
                $lib = $this->get($adapter);
                $key = $lib->configureKey($_hash, $_component, $_type, $_format);
                $found = $lib->get($key);
            } catch (\Exception $e) {
                $this->dispatch('logger.warn', new MessageLoggingEvent($_hash, sprintf('%s() L#%s > %s', __METHOD__, __LINE__, $e->getMessage())));
            }
        }

        $requestParameters = array(
            'hash' => $_hash,
            'component' => $_component,
            'type' => $_type,
            'format' => $_format,
        );
        if (null == $found) {
            return new Response(sprintf('Nothing found! %s', json_encode($requestParameters)), 404);
        }

        return new Response($found);
    }

}
