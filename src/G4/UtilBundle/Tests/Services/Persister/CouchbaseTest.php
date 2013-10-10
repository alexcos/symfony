<?php

namespace G4\UtilBundle\Tests\Service\Persister;

use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;
use G4\UtilBundle\Services\Persister\Couchbase as CouchbasePersister;

/**
 * Verifies that the connection with Couchbase2 is working.
 *
 * @author Georgiana Gligor <g@lolaent.com>
 */
class CouchbaseTest extends G4UnitWebTestCase
{

    /**
     * setup each test
     */
    public function setUp()
    {
        parent::setUp();

        $loggingActive = $this->client->getContainer()->getParameter('g4_timeline_log');
        try {
            if (!$loggingActive) {
                echo "Skip Test, g4_timeline_log is false\n";
                $this->markTestSkipped();
            } else {
                $logging = $this->client->getContainer()->get('g4_logging_timeline');

                $this->serverUrl = $logging->getServer();
            }
        } catch (\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $e) {
            echo 'Skip Test, Timeline couch not used: config_couch.yml is not imported. '.$e->getMessage();
            $this->markTestSkipped();
        }

    }

    /**
     * Verifies that the connection is correctly established.
     */
    public function testConnection()
    {
        $container = static::createClient()->getContainer();

        $couchConnection = $container->get('g4_persister_memcache');
        $this->assertTrue($couchConnection instanceof CouchbasePersister, 'Couch connector is ' . print_r($couchConnection, true));

        $couchStorage = $couchConnection->getStorage();
        $this->assertTrue($couchStorage instanceof \Couchbase);
    }

    /**
     * Check that we are writing successfully a new key.
     */
    public function testWriteSuccessful()
    {
        $couch = static::createClient()->getContainer()->get('g4_persister_memcache');

        $randomNumber = rand(10, 99);
        $key = 'randomKey' . $randomNumber;
        $value = 'randomValue' . $randomNumber;
        $couch->set($key, $value);

        $realValue = $couch->get($key);
        $this->assertEquals($value, $realValue);

        // cleanup once the test is done
        $couch->getStorage()->delete($key);
    }

}
