<?php
/**
 * @category Allegiant
 * @package  G4.UtilBundle.Tests
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Tests;

use G4\UtilBundle\ErrorMapper;

/**
 * Error mapper unit test
 */
class ErrorMapperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * check that mapping works from resweb codes to ajax-symf class codes
     *
     * @param string $reswebId resweb error code
     * @param string $expected ajax-symf class
     *
     * @return void
     *
     * @dataProvider provideFromResweb
     */
    public function testConvertFromResweb($reswebId, $expected)
    {
        $mapped = ErrorMapper::fromResweb($reswebId);
        $this->assertEquals($mapped, $expected);
    }

    /**
     * check that seat not available is correctly detected
     *
     * @param string $reswebResponse json representing the resweb response
     *
     * @return void
     *
     * @dataProvider provideSeatNotAvailable
     */
    public function testSeatNotAvailable($reswebResponse)
    {
        $reswebErrors = json_decode($reswebResponse);
        $notAvailable = ErrorMapper::seatNotAvailable($reswebErrors->error);
        $this->assertTrue($notAvailable);
    }

    /**
     * check that flight not available is correctly detected
     *
     * @param string $reswebResponse json representing the resweb response
     *
     * @return void
     *
     * @dataProvider provideFlightNotAvailable
     */
    public function testFlightNotAvailable($reswebResponse)
    {
        $reswebErrors = json_decode($reswebResponse);
        $notAvailable = ErrorMapper::flightNotAvailable($reswebErrors->error);
        $this->assertTrue($notAvailable);
    }

    /**
     * data provider for the resweb conversion test
     *
     * @return array
     */
    public function provideFromResweb()
    {
        return array(
            array('PRD_001', 9900),
            array('1407', 1000),
            array('1408', 2000),
            array('2801', 3000),
            array('2802', 3000),
            array('2804', 3000),
            array('2810', 3000),
            array('1631', 4000),
            array('1632', 4000),
        );
    }

    /**
     * data provider for seat not available test
     *
     * @return array
     */
    public function provideSeatNotAvailable()
    {
        return array(
            array('{"error":[{"code":"1408","property":[],"level":"FUNCTIONAL","errorDateTime":"2012-02-28T06:42:38.456-08:00","description":"Seat(s) not available"}],"cart":null,"warning":[],"payloadAttributes":{"timeStamp":"2011-12-02T20:53:14","version":1,"bookingTypeID":1,"transactionIdentifier":"test"}}'),
            array('{"error":[{"code":"1408","property":[],"level":"FUNCTIONAL","errorDateTime":"2012-02-28T06:42:38.456-08:00","description":"Seat(s) not available"},{"code":"1407","property":[],"level":"FUNCTIONAL","errorDateTime":"2012-02-28T06:42:38.456-08:00","description":"Flight not available"}],"cart":null,"warning":[],"payloadAttributes":{"timeStamp":"2011-12-02T20:53:14","version":1,"bookingTypeID":1,"transactionIdentifier":"test"}}'),
        );
    }

    /**
     * data provider for flight not available test
     *
     * @return array
     */
    public function provideFlightNotAvailable()
    {
        return array(
            array('{"error":[{"code":"1407","property":[],"level":"FUNCTIONAL","errorDateTime":"2012-02-28T06:42:38.456-08:00","description":"Flight not available"}],"cart":null,"warning":[],"payloadAttributes":{"timeStamp":"2011-12-02T20:53:14","version":1,"bookingTypeID":1,"transactionIdentifier":"test"}}'),
            array('{"error":[{"code":"1407","property":[],"level":"FUNCTIONAL","errorDateTime":"2012-02-28T06:42:38.456-08:00","description":"Flight not available"},{"code":"1408","property":[],"level":"FUNCTIONAL","errorDateTime":"2012-02-28T06:42:38.456-08:00","description":"Seat(s) not available"}],"cart":null,"warning":[],"payloadAttributes":{"timeStamp":"2011-12-02T20:53:14","version":1,"bookingTypeID":1,"transactionIdentifier":"test"}}'),
        );
    }

}