<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.SearchBundle.Controller
 * @author   Georgiana Gligor <g@lolaent.com>
 */

namespace G4\UtilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use G4\UtilBundle\CouchDocument\Put;
use G4\UtilBundle\CouchDocument\Error;
use G4\UtilBundle\CouchDocument\Search;

/**
 * StatsController
 */
class StatsController extends Controller
{

    /**
     * Displays the statistics summary.
     *
     * @return void
     */
    public function indexAction()
    {
        $documentManager = $this->container->get('doctrine_couchdb.odm.default_document_manager');
        $query = $documentManager->createQuery('stats', 'put')->onlyDocs(true);
        $results = $query->execute();

        return $this->render(
            'G4UtilBundle:Util:index.html.twig',
            array(
                'results' => $results
            )
        );
    }

    /**
     * Display data about a particular user request
     *
     * @param string $id The request to be displayed
     *
     * @return void
     */
    public function detailAction($id)
    {
        $documentManager = $this->container->get('doctrine_couchdb.odm.default_document_manager');
        $query = $documentManager->createQuery('stats', 'details')
            ->setStartKey(sprintf('%s', $id))
            ->setEndKey(sprintf('%s_9', $id))
            ->onlyDocs(true);
        $result = $query->execute();

        return $this->render(
            'G4UtilBundle:Util:detail.html.twig',
            array(
                'id' => $id,
                'result' => $result
            )
        );
    }
}
