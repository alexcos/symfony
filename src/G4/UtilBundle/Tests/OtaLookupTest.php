<?php
namespace G4\UtilBundle\Tests;

use G4\UtilBundle\Controller\LookupController;
use G4\UtilBundle\Exception\OtaLookupException;
use G4\UtilBundle\OtaLookup;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;

/**
 * LookupTest
 *
 * @uses WebTestCase
 */
class OtaLookupTest extends G4UnitWebTestCase
{
    /**
     * phpunit setUp called before each test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * data provider for testRequestSourceID
     *
     * @return array
     */
    public function provideTestCountryByCode()
    {
        return array(
            array('US', 1),
            array('CA', 2)
        );
    }

    /**
     * Test lookup for phone number
     *
     * @param string $source   lookup key
     * @param string $expected expected id
     *
     * @return void
     * @dataProvider provideTestCountryByCode
     */
    public function testLookupCountryByCode($source, $expected)
    {
        $container = $this->client->getContainer();
        $persisterKey = $container->getParameter('g4_docketservice_country_url');
        $container->get('g4_persister_memcache')->set($persisterKey.'/'.$source, null);

        $object = $container->get('g4_ota_lookup')->lookupCountryByCode($source);

        $this->assertEquals($object->id, $expected);
    }

    /**
     * data provider for testRequestSourceID
     *
     * @return array
     */
    public function provideTestStateByCode()
    {
        return array(
            array('US', 'AK', 1),
            array('CA', 'MB', 59)
        );
    }

    /**
     * Test lookup for phone number
     *
     * @param string $countryCode
     * @param string $stateCode
     * @param string $expectedId
     *
     * @return void
     * @dataProvider provideTestStateByCode
     */
    public function testLookupStateByCode($countryCode, $stateCode, $expectedId)
    {
        $key = $this->client->getContainer()->getParameter("g4_docketservice_country_url");
        $this->client->getContainer()->get('g4_persister_memcache')->set(sprintf('%s/%s', $key, $countryCode), null);
        $container = $this->client->getContainer();

        $object = $container->get('g4_ota_lookup')->lookupStateByCode($countryCode, $stateCode);

        $this->assertEquals($object->id, $expectedId);
    }

    /**
     * test error handling for country lookup
     * @expectedException G4\UtilBundle\Exception\OtaLookupException
     * @expectedExceptionCode 2000
     */
    public function testLookupCountryByWrongCode()
    {
        $code = 'F';
        $key = $this->client->getContainer()->getParameter("g4_docketservice_country_url");
        $this->client->getContainer()->get('g4_persister_memcache')->set(sprintf('%s/%s', $key, $code), null);
        $container = $this->client->getContainer();
        $container->get('g4_ota_lookup')->lookupCountryByCode($code);
    }

    /**
     * test error handling for country lookup
     * @expectedException G4\UtilBundle\Exception\OtaLookupException
     * @expectedExceptionCode 4000
     */
    public function testLookupDataNotReachable()
    {
        $container = $this->client->getContainer();
        $container->get('g4_ota_lookup')->loadData("http://thisisawronglookupurl.com/what");
    }

    /**
     * test error handling for country lookup
     * @expectedException G4\UtilBundle\Exception\OtaLookupException
     * @expectedExceptionCode 4000
     */
    public function testLookupDataNotFound()
    {
        $container = $this->client->getContainer();
        $url = $this->client->getContainer()->getParameter('g4_service_customers_lookup');

        $container->get('g4_ota_lookup')->loadData($url.'/wronglookup');
    }

    /**
     * test error handling for country lookup
     * @expectedException G4\UtilBundle\Exception\OtaLookupException
     * @expectedExceptionCode 2000
     */
    public function testLookupGenderByWrongCode()
    {
        $code = 'nogender';
        $key = $this->client->getContainer()->getParameter("g4_docketservice_gender_url");
        $this->client->getContainer()->get('g4_persister_memcache')->set(sprintf('%s/%s', $key, $code), null);
        $container = $this->client->getContainer();
        $container->get('g4_ota_lookup')->lookupGenderTypeByName($code);
    }

    /**
     * test error handling for country lookup
     * @expectedException G4\UtilBundle\Exception\OtaLookupException
     * @expectedExceptionCode 2000
     */
    public function testLookupPhoneByWrongCode()
    {
        $code = 'nophone';
        $key = $this->client->getContainer()->getParameter("g4_docketservice_gender_url");
        $this->client->getContainer()->get('g4_persister_memcache')->set(sprintf('%s/%s', $key, $code), null);
        $container = $this->client->getContainer();
        $container->get('g4_ota_lookup')->lookupPhoneNumberTypeIdByType($code);
    }

    /**
     * data provider for testRequestSourceID
     *
     * @return array
     */
    public function provideTestGenderTypeID()
    {
        return array(
            array(1, 'F'),
            array(2, 'M')
        );
    }

    /**
     * Test lookupRequestSourceID
     *
     * @param string $source   lookup key
     * @param string $expected expected id
     *
     * @return void
     * @dataProvider provideTestGenderTypeID
     */
    public function testGenderTypeID($source, $expected)
    {
        $container = $this->client->getContainer();

        $object = $container->get('g4_ota_lookup')->lookupGenderTypeById($source);

        $this->assertEquals($object->name, $expected);
    }

    /**
     * data provider for testRequestSourceID
     *
     * @return array
     */
    public function provideTestLookupErrors()
    {
        //return array(0 => 0, 1=>204, 2=>404,3=> 500,4=> 400);
        return array(
            array(0),
            array(204),
            array(404),
            array(500),
            array(400)
        );
    }

    /**
     * Test lookupRequestSourceID
     *
     * @param string $errCode lookup key
     *
     * @return void
     * @dataProvider provideTestLookupErrors
     */
    public function testLookupErrors($errCode)
    {
        $container = $this->client->getContainer();
        $lookupUrl = $container->getParameter('g4_sy2mnt').'/resweb/rest/lookupcode/'.$errCode;
        if ($errCode === 0) {
            //trigger no host found responses
            $lookupUrl = 'http://www.fkljhdflkghdlgldkfghdlgd.com/resweb/rest/lookupcode/'.$errCode;
        }
        $serviceCall = $container->get('g4_services_call');

        $serviceCall->addGet($lookupUrl, 20, array(), 'response');

        $otaLookup = new OtaLookup();
        $otaLookup->setContainer($container);

        try {
            $response = $otaLookup->execute($serviceCall);
        } catch (OtaLookupException $e) {
            $this->assertEquals($e->getCode(), 4000, "Exception Code does not match");
            fwrite(STDOUT, $e->getMessage()."\n");
        }




    }
}