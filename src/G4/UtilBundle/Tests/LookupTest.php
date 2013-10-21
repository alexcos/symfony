<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.SearchBundle.Tests
 */

namespace G4\UtilBundle\Tests;

use G4\UtilBundle\Controller\LookupController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;

/**
 * LookupTest
 *
 * @uses WebTestCase
 */
class LookupTest extends G4UnitWebTestCase
{
    private $controller;

    /**
     * phpunit setUp called before each test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->controller = new \G4\SearchBundle\Controller\DispatchController();
    }

    /**
     * Data provider for testLookupMarketID
     *
     * @return array of array($code1, $code2, $marketID)
     */
    public function provideTestMarketIDs()
    {
        // Pair of airport codes and expected marketID
        return array(
            array('BLI', 'LAX', 14),
            array('BLI', 'LAS', 70),
            array('LAS', 'BLI', 70), // reversed
            array('GPI', 'LAS', 73),
            array('LAS', 'GPI', 73), // reversed
            array('ATW', 'SFB', 145),
        );
    }

    /**
     * Test lookupMarketID
     *
     * @param string $code1    airport code
     * @param string $code2    airport code
     * @param int    $expected expected marketID
     *
     * @return void
     * @dataProvider provideTestMarketIDs
     */
    public function testLookupMarketID($code1, $code2, $expected)
    {
        $container = static::createClient()->getContainer();

        $marketID = $container->get('g4_lookup')->lookupMarketID($code1, $code2);

        $this->assertEquals($marketID, $expected);
    }

    /**
     * Data provider for testLookupBookingTypeID
     *
     * @return array of array($booking, $bookingTypeID)
     */
    public function provideTestBookingTypeIDs()
    {
        // Booking code strings and expected bookingTypeID
        return array(
            array('F',    1),
            array('FH',   2), // package with flight
            array('HVF',  2), // package with flight
            array('HFVP', 2), // package with flight
            array('HV',   3), // package land only
            array('HVP',  3), // package land only
            array('H',    4),
            array('V',    5),
            array('P',    6),
        );
    }

    /**
     * Test lookupBookingTypeID
     *
     * @param string $booking  string of booking types i.e., "FHPV"
     * @param number $expected expected bookingTypeID
     *
     * @return void
     * @dataProvider provideTestBookingTypeIDs
     */
    public function testLookupBookingTypeID($booking, $expected)
    {
        $container = $this->client->getContainer();

        $bookingTypeID = $container->get('g4_lookup')->lookupBookingTypeID($booking);

        $this->assertEquals($bookingTypeID, $expected);
    }

    /**
     * data provider for testRequestSourceID
     *
     * @return array
     */
    public function provideTestRequestSourceID()
    {
        return array(
            array('kayak', 1),
        );
    }


    /**
     * Test lookupRequestSourceID
     *
     * @param string $source   lookup key
     * @param string $expected expected id
     *
     * @return void
     * @dataProvider provideTestRequestSourceID
     */
    public function testRequestSourceID($source, $expected)
    {
        $container = $this->client->getContainer();

        $id = $container->get('g4_lookup')->lookupRequestSourceID($source);

        $this->assertEquals($id, $expected);
    }

    /**
     *
     */
    public function testLookupBookingTypeById()
    {
        $this->client->getContainer()->get('g4_persister_memcache')->set('meta/resweb/BookingType/1.json', null);
        $lookupController = new LookupController();
        $lookupController->setContainer($this->client->getContainer());

        $bookingType = json_decode($lookupController->getLookupAction('BookingType', 1)->getContent());

        $this->assertEquals(1, $bookingType->id, 'bookingTypeId is incorrect');
    }

    /**
     *
     */
    public function testLookupBookingTypeByName()
    {
        $this->client->getContainer()->get('g4_persister_memcache')->set('meta/resweb/BookingType/Flight Only.json', null);

        $lookupController = new LookupController();
        $lookupController->setContainer($this->client->getContainer());

        $bookingType = json_decode($lookupController->getLookupAction('BookingType', 'Flight Only')->getContent());

        $this->assertEquals('Flight Only', $bookingType->name, 'booking type name is incorrect');
    }

    /**
     *
     */
    public function testLookupRequestSourceById()
    {
        $this->client->getContainer()->get('g4_persister_memcache')->set('meta/resweb/RequestSource/1.json', null);
        $lookupController = new LookupController();
        $lookupController->setContainer($this->client->getContainer());

        $bookingType = json_decode($lookupController->getLookupAction('RequestSource', 1)->getContent());

        $this->assertEquals(1, $bookingType->id, 'requestSource id is incorrect');
    }

    /**
     *
     */
    public function testLookupRequestSourceByName()
    {
        $this->client->getContainer()->get('g4_persister_memcache')->set('meta/resweb/BookingType/Flight Only.json', null);

        $lookupController = new LookupController();
        $lookupController->setContainer($this->client->getContainer());

        $bookingType = json_decode($lookupController->getLookupAction('RequestSource', 'kayak')->getContent());

        $this->assertEquals('kayak', $bookingType->name, 'request source name is incorrect');
    }

    public function testParseValid()
    {
        $lookupController = new LookupController();
        $result = $lookupController->parseValid("effDate~06/05/2013|expDate~02/11/2014");


    }


    /**
     *
     */
    public function testLookupMarkets()
    {
        $this->client->getContainer()->get('g4_persister_memcache')->set('meta/resweb/Market/LASBLI.json', null);

        $lookupController = new LookupController();
        $lookupController->setContainer($this->client->getContainer());

        $bookingType = json_decode($lookupController->getLookupMarketAction('LASBLI')->getContent());

        $this->assertEquals('LASBLI', $bookingType->name, 'request source name is incorrect');
    }
}
