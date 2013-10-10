<?php

/**
 * Allegiant G4 search backend package.
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Tests.Services.Persister
 */
namespace G4\UtilBundle\Tests\Services\Persister;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use G4\UtilBundle\Services\Persister\Memcache as PersisterMemcache;

/**
 * MemcacheTest
 * - checks that the data is persisted properly to memcache
 *
 * @author Georgiana Gligor <g@lolaent.com>
 */
class MemcacheTest extends G4UnitWebTestCase
{

    /**
     * Check that a connection can be established
     *
     * @return void
     */
    public function testConnection()
    {
        $container = static::createClient()->getContainer();
        $m = $container->get('g4_persister_memcache');

        $this->assertTrue($m instanceof PersisterMemcache);
    }

    /**
     * Checks that data is properly written to memcache
     */
    public function testWriteData()
    {
        $container = $this->client->getContainer();
        $m = $container->get('g4_persister_memcache');
        $m->set('memcache_test_key', 'memcache_test_value2');

        // check is written by default
        $this->assertEquals('memcache_test_value2', $m->get('memcache_test_key'));

        // check individually each connection
        $servers = $container->getParameter('g4_memcache_server_address');
        $ports = $m->alignPorts($servers, $container->getParameter('g4_memcache_server_port'));

        foreach ($servers as $index => $server) {
            $memcacheConn = new \Memcache();
            $memcacheConn->addServer($servers[$index], $ports[$index]);
            $this->assertEquals(
                'memcache_test_value2', $memcacheConn->get('memcache_test_key'),
                sprintf('Working on %s:%s', $servers[$index], $ports[$index])
            );
            unset($memcacheConn);
        }
    }

}
