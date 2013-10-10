<?php
/**
 * @category Allegiant
 * @package  G4.SearchBundle.Tests.Controller
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Tests\Services;

use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use G4\UtilBundle\Events\HttpEvent;
use G4\UtilBundle\Events\MemcacheEvent;
use G4\UtilBundle\Events\ReswebCallEvent;

require_once __DIR__.'/../../../../../app/AppKernel.php';

/**
 * Unit test for the logging service
 */
class CouchLoggingTest extends G4UnitWebTestCase
{

    private $serverUrl = "";

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
     * This generates a random json, so we can write it into couch
     *
     * @return array
     */
    public function generateRandomTestJson()
    {
        $testData = array();
        for ($i=0; $i<30; $i++) {
            $testData[rand(0, 10000000)] = rand(0, 10000000);
        }

        return $testData;
    }

    /**
     * get last entry from couch
     *
     * @param string $hash hash key to find
     *
     * @return mixed
     */
    public function getEntryByHash($hash)
    {
        $all = file_get_contents($this->serverUrl . "_design/manifest_id/_view/manifest_id?key=%22".$hash."%22");
        $allArr = json_decode($all, true);

        $allArr = $allArr['rows'];

        return isset($allArr[0])?$allArr[0]:array();
    }

    /**
     *  test debug log
     */
    public function testTimelineLog()
    {
        $logging = $this->client->getContainer()->get('g4_logging_timeline');

        $hash = md5(microtime());
        $testData = $this->generateRandomTestJson();

        $newId = $logging->timelineLog($hash, "test", array($testData), get_class($this), true);

        $json = file_get_contents($logging->getServer() . $newId);

        $this->assertTrue(strpos($json, json_encode($testData))!==false);
    }

    /**
     * test the resweb request event for logging
     */
    public function testReswebRequest()
    {
        $hash = md5(microtime());

        $testData = $this->generateRandomTestJson();
        $this->client->getContainer()->get('event_dispatcher')->dispatch('utilbundle.reswebrequest', new ReswebCallEvent($hash, $testData, get_class($this), 'http://url', 'pairkey-1234567890', 0));

        sleep(1);

        $lastEntry = $this->getEntryByHash($hash);
        @$getData = $lastEntry['value']['http_request'];
        $this->assertEquals(json_encode($testData), json_encode($getData));
    }

    /**
     * test the resweb resposne event for logging
     */
    public function testReswebResponse()
    {
        $hash = md5(microtime());

        $testData = $this->generateRandomTestJson();
        $this->client->getContainer()->get('event_dispatcher')->dispatch('utilbundle.reswebresponse', new ReswebCallEvent($hash, $testData, get_class($this), 'http://url', 'pairkey-1234567890', 0));

        sleep(1);

        $lastEntry = $this->getEntryByHash($hash);
        @$getData = $lastEntry['value']['http_response'];
        $this->assertEquals(json_encode($testData), json_encode($getData));
    }

    /**
     * test the memcache write event for logging
     */
    public function testMemcacheWrite()
    {
        $hash = md5(microtime());

        $testData = $this->generateRandomTestJson();
        $this->client->getContainer()->get('event_dispatcher')->dispatch('utilbundle.memcachewrite', new MemcacheEvent($hash, $testData, get_class($this)));

        sleep(1);

        $lastEntry = $this->getEntryByHash($hash);

        @$getData = $lastEntry['value']['data'];
        $this->assertEquals(json_encode($testData), json_encode($getData));
    }

    /**
     * test the memcache read event for logging
     */
    public function testMemcacheRead()
    {
        $hash = md5(microtime());

        $testData = $this->generateRandomTestJson();
        $this->client->getContainer()->get('event_dispatcher')->dispatch('utilbundle.memcacheread', new MemcacheEvent($hash, $testData, get_class($this)));

        sleep(1);

        $lastEntry = $this->getEntryByHash($hash);
        @$getData = $lastEntry['value']['data'];
        $this->assertEquals(json_encode($testData), json_encode($getData));
    }

    /**
     * test the http in request event for logging
     */
    public function testHttpIn()
    {
        $hash = md5(microtime());

        $testData = $this->generateRandomTestJson();
        $this->client->getContainer()->get('event_dispatcher')->dispatch('utilbundle.httpin', new HttpEvent($hash, $testData, get_class($this), 'http://url', 'pairkey-1234567890'));

        sleep(1);

        $lastEntry = $this->getEntryByHash($hash);
        @$getData = $lastEntry['value']['http_request'];
        $this->assertEquals(json_encode($testData), json_encode($getData));
    }

    /**
     * test the http out response event for logging
     */
    public function testHttpOut()
    {
        $hash = md5(microtime());

        $testData = $this->generateRandomTestJson();
        $this->client->getContainer()->get('event_dispatcher')->dispatch('utilbundle.httpout', new HttpEvent($hash, $testData, get_class($this), 'http://url', 'pairkey-1234567890'));

        sleep(1);

        $lastEntry = $this->getEntryByHash($hash);
        @$getData = $lastEntry['value']['http_response'];
        $this->assertEquals(json_encode($testData), json_encode($getData));
    }

}
