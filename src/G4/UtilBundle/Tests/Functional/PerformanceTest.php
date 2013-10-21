<?php
namespace G4\UtilBundle\Tests\Services;

use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;

/**
 * Tests performance of different routes
 */
class PerformanceTest extends G4UnitWebTestCase
{
    public static $testNo = 10;

    /**
     * run test
     */
    public function testPerformance()
    {


         $resultTimes = array();

        for ($i=0; $i<self::$testNo; $i++) {
            $t1 = microtime(true);

            $this->searchRequest();
            //$this->homeRequest();

            $t2 = microtime(true);
            $totalTime = $t2 - $t1;

            $resultTimes[] = $totalTime;
        }

        echo "Computed " . self::$testNo . " times, average: " . sprintf("%.03f", array_sum($resultTimes) /  self::$testNo). "\n";
    }

    /**
     * homepage request
     */
    public function homeRequest()
    {
        $this->client->request(
            'GET',
            '/',
            array()
        );
    }

    /**
     * request for a search
     */
    public function searchRequest()
    {
        $json = '{"outward":"2012-07-08","destination":{"city":"Las Vegas","code":"LAS","state":"NV"},"rooms":1,"product":{"name":"Flight Only","components":{"F":{"mode":"sell"},"H":{"mode":"offer"},"V":{"mode":"offer"},"P":{"mode":"offer","start_date":"2012-07-08","end_date":"2012-07-12"},"T":{"mode":"offer"},"S":{"mode":"offer"}}},"origin":{"city":"Bellingham, Wa\/Vancouver","code":"BLI","state":"WA"},"travelers":{"adult":1,"child":[],"child-dob":[]},"returning":"2012-07-12","direction":"return","sessionID":"4fb4dd7f2168f","version":"123.4","timeStamp":"2012-06-12T05:14:13-07:00","clientIP":"127.0.0.1","transactionIdentifier":"4fd73295a0d83","cartID":"4fd73295a0d96"}';

        $hash = md5(time());
        $this->client->request(
            'POST',
            sprintf('/search/%s', $hash),
            array('search' => $json)
        );
    }


}
