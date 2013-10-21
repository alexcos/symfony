<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Tests
 *
 * @author Georgiana Gligor <g@lolaent.com>
 */

namespace G4\UtilBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;
use G4\UtilBundle\ServicesCall;

require_once __DIR__.'/../../../../app/AppKernel.php';

/**
 * DefaultControllerTest
 *
 * @uses WebTestCase
 */
class ServicesCallTest extends G4UnitWebTestCase
{
    // @todo extract in a configuration parameter and read the base URL from there
    //      so that the test will work for everybody
    private $_url = 'http://allegiantlocal/resweb/rest/hotel/getHotelAvail';
    // private $_url = 'http://localhost/~georgiana/symfony-search/web/app_dev.php/resweb/rest/hotel/getHotelAvail';

    /**
     * testJsonRequest
     *
     * @access public
     * @return void
     */
    public function x_testJsonRequest()
    {
        $sc = new ServicesCall();
        $sc->setRequestURL($this->_url);
        $data = $sc->jsonRequest(json_encode(array('foo' => 'bar')));
        $this->assertTrue(
            $data != false,
            'Curl Error in jsonRequest for URL ' . $this->_url
        );
        $json = json_decode($data, true);
        $this->assertTrue(
            is_array($json),
            'Returned data is not valid json'
        );

        $keys = array('hotel', 'payloadAttributes', 'error', 'warning');
        foreach ($keys as $key) {
            $this->assertTrue(
                array_key_exists($key, $json),
                'JSON element ' . $key . ' missing'
            );
        }
    }

    /**
     * Check addition of a service to the execution pool.
     *
     * @return void
     */
    public function testAddService()
    {
        $c = new ServicesCall();
        $url = 'http://www.google.com/';
        $headers = array('Content-Type: application/json');
        $c->addGet($url, 5, $headers);

        $registeredServices = $c->getServices();
        $this->assertTrue(is_array($registeredServices));
        $this->assertCount(1, $registeredServices);

        $this->assertTrue(is_resource(current($registeredServices)));
    }

    /**
     * When executing without services in the execution pool we expect Exception to be raised
     *
     * @expectedException G4\UtilBundle\Exception\NoServicesToExecuteException
     *
     * @return void
     */
    public function testExecuteNoService()
    {
        $c = new ServicesCall();
        $c->execute();
    }

    /**
     * Check that we are executing one single service.
     *
     * @return void
     */
    public function testExecuteOneGetService()
    {
        $c = new ServicesCall();

        $c->addGet('http://www.google.co.uk/');

        $results = $c->execute();

        // the results is an array with 1 element, corresponding to our service access
        $this->assertTrue(is_array($results));
        $this->assertCount(1, $results);
        $this->assertContainsOnly('string', $results); // Google is always accessible, no NULLs here

        // the resulting HTML contains the google first page; surely they won't change the title
        $html = current($results);
        $this->assertContains('<title>Google</title>', $html);
    }

    /**
     * Access multiple services on GET
     *
     * @return void
     */
    public function testExecuteMultipleGetServices()
    {
        $c = new ServicesCall();

        $c->addGet('http://www.google.ro/');
        $c->addGet('http://www.google.co.uk/');

        $results = $c->execute();

        $this->assertTrue(is_array($results));
        $this->assertCount(2, $results);
        $this->assertContainsOnly('string', $results); // Google is always accessible, no NULLs here

        foreach ($results as $result) {
            // variety is the spice of life. here we use strpos instead of assertContains used above
            $this->assertGreaterThan(0, strpos($result, '<title>Google</title>'));
        }
    }

    /**
     * sample code to use as wrapper for direct curl call in lookupBookingID
     *
     * @return void
     */
    public function testLookupBookingTypeID()
    {
        $bookingTypeUrl = 'http://skunkworks.lolaent.com/meta/resweb/BookingType/Flight%2520Only.json';

        // approach 1 - using simple service call
        $c = new ServicesCall();
        $c->setRequestURL($bookingTypeUrl);
        $data = $c->jsonRequest();

        $this->assertTrue(is_string($data));
        $this->assertStringMatchesFormat('{%a}', $data);

        $bookingType = json_decode($data);
        $this->assertInstanceOf('stdClass', $bookingType);
        $this->assertObjectHasAttribute('id', $bookingType);
        $this->assertEquals(1, $bookingType->id);

        // approach 2 - using multi-curl
        $c = new ServicesCall();
        $key = 'F';
        $c->addGet($bookingTypeUrl, 5, array('Content-Type: application/json'), $key);
        $results = $c->execute();

        $this->assertTrue(is_array($results));
        $this->assertCount(1, $results);
        $this->assertArrayHasKey($key, $results);

        $bookingType = json_decode($results[$key]);
        $this->assertInstanceOf('stdClass', $bookingType);
        $this->assertObjectHasAttribute('id', $bookingType);
        $this->assertEquals(1, $bookingType->id);
    }

    /**
     * test persister
     */
    public function testPersister()
    {
        $container = static::createClient()->getContainer();

        $persisterUrl = sprintf(
            '%s/%s_%s_%s.%s',
            $container->getParameter('g4_persisterservice_url'),
            'sample-test-hash',
            'resweb',
            'response',
            'json'
        );
        $persist = new \G4\UtilBundle\ServicesCall();
        $persist->addPost($persisterUrl, 5, array('Content-Type: application/json'), 'and some results to store in it', 'resweb_response');
        $persist->execute();

        $this->assertTrue(true);
    }

}
