<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.SearchBundle.Tests.Controller
 * @author   Georgiana Gligor <g@lolaent.com>
 */

namespace G4\SearchBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;

/**
 * StatsControllerTest 
 * 
 * @uses WebTestCase
 */
class StatsControllerTest extends G4UnitWebTestCase
{

    /**
     * testIndexAccessible 
     * 
     * @access public
     * @return void
     */
    public function testIndexAccessible()
    {
        //not used anymore
        $this->markTestSkipped();

        $crawler = $this->client->request('GET', '/stats');
        $response = $this->client->getResponse();
        $status = $response->getStatusCode();
        $this->assertEquals(200, $status);
    }

    /**
     * testIndexCountItems 
     * 
     * @access public
     * @return void
     */
    public function testIndexCountItems()
    {
        $crawler = $this->client->request('GET', '/stats');
        $response = $this->client->getResponse();

        try {
            $documentManager = $this->client->getContainer()->get('doctrine_couchdb.odm.default_document_manager');
        } catch (\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $e) {
            echo 'Skip Test, Timeline couch not used: config_couch.yml is not imported. '.$e->getMessage();
            $this->markTestSkipped();
        }
        $query = $documentManager->createQuery('stats', 'put')->onlyDocs(true);
        $results = $query->execute();
        $expectedCount = sprintf('Found %s user requests.', $results->count());

        $this->assertTrue(
            $crawler->filter('html:contains("'.$expectedCount.'")')->count() == 1,
            'Expected ' . $results->count()
        );
    }

}
