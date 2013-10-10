<?php
namespace G4\UtilBundle\Tests\Services;

use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;

/**
 * Those are not actual test, they only dispaly logging times of the available methods
 */
class TimelineLoggingTimesTest extends G4UnitWebTestCase
{

    public static $jsonData;

    /**
     * @static
     *
     */
    public static function setupBeforeClass()
    {
        parent::setupBeforeClass();
        $testData = array();
        for ($i=0; $i<400000; $i++) {
            $testData[rand(0, 10000000)] = rand(0, 10000000)*645546354;
        }
        self::$jsonData = json_encode($testData);

        echo "Testing with " . strlen(self::$jsonData)/1024 . " Kbytes data.\n";
    }


    /**
     * calculate logging times for sockets
     */
    public function testSockets()
    {
        try {
            $logSockets = $this->client->getContainer()->get('g4_logging_timeline_couch_sockets');
        } catch (\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $e) {
            echo 'Skip Test, Timeline couch not used: config_couch.yml is not imported. '.$e->getMessage();
            $this->markTestSkipped();
        }

        echo "Sockets: ";
        $t1 = microtime(true);
        $logSockets->writeLog(self::$jsonData, true);
        $t2 = microtime(true);
        $logSockets->writeLog(self::$jsonData);
        $t3 = microtime(true);
        echo sprintf("%.04f", $t2-$t1) . " | " . sprintf("%.04f", $t3-$t2) . "\n";
    }

    /**
     * calculate logging times for curl
     */
    public function testCurl()
    {
        try {
            $logCurl = $this->client->getContainer()->get('g4_logging_timeline_couch_curl');
        } catch (\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $e) {
            echo 'Skip Test, Timeline couch not used: config_couch.yml is not imported. '.$e->getMessage();
            $this->markTestSkipped();
        }

        echo "Curl: ";
        $t1 = microtime(true);
        $logCurl->writeLog(self::$jsonData, true);
        $t2 = microtime(true);
        $logCurl->writeLog(self::$jsonData);
        $t3 = microtime(true);
        echo sprintf("%.04f", $t2-$t1) . " | " . sprintf("%.04f", $t3-$t2) . "\n";
    }

    /**
     * calculate logging times for doctrine
     */
    public function testOdm()
    {
        try {
            $logODM = $this->client->getContainer()->get('g4_logging_timeline_couch_odm');
        } catch (\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $e) {
            echo 'Skip Test, Timeline couch not used: config_couch.yml is not imported. '.$e->getMessage();
            $this->markTestSkipped();
        }

        echo "ODM: ";
        $t1 = microtime(true);
        $logODM->writeLog(self::$jsonData, true);
        $t2 = microtime(true);
        $logODM->writeLog(self::$jsonData);
        $t3 = microtime(true);
        echo sprintf("%.04f", $t2-$t1) . " | " . sprintf("%.04f", $t3-$t2) . "\n";
    }
}
