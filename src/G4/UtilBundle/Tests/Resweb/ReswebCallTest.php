<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Tests.ReswebCallTest
 */
namespace G4\UtilBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;
use G4\UtilBundle\Entity\ReswebUrl;

/**
 * Unit testing for the resweb calls
 *
 * @author "Victor Vacaretu" <victor@cloudtroopers.ro>
 */
class ReswebCallTest extends G4UnitWebTestCase
{
    private $reswebServers = array();
    protected $client = null;

    /**
     * Test resweb connectivity
     *
     * @param ReswebUrl $reswebServer An entity object containing the 'main' resweb url, 'flights' url, etc
     *
     * @dataProvider provider
     */
    public function testReswebConnectivity(ReswebUrl $reswebServer)
    {
        //Step 1: Test the main url can be accessed using a simple GET method
        fprintf(STDOUT, 'Testing resweb server : %s%s', $reswebServer->getMain(), PHP_EOL);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $reswebServer->getMain());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->assertTrue($httpStatus == 200, sprintf('Could not connect to : \'%s\'.%s', $reswebServer->getMain(), PHP_EOL));

        // Step 2: Do a post into the flight search url and check the reponse is json encoded and has the main arrays set up (journeySet, error, warning)
        fprintf(STDOUT, '    --> Testing flight search url : %s%s', $reswebServer->getFlight(), PHP_EOL);
        $dataDecoded = $this->checkService($reswebServer->getFlight());
        $this->assertArrayHasKey('journeySet', $dataDecoded, sprintf('Flight response does not contain \'journeySet\' key for url : %s%s', $reswebServer->getFlight(), PHP_EOL));

        // Step 3: Do a post into the hotel url and check the reponse is json encoded and has the main arrays set up (error, warning)
        fprintf(STDOUT, '    --> Testing hotel url : %s%s', $reswebServer->getHotel(), PHP_EOL);
        $dataDecoded = $this->checkService($reswebServer->getHotel());
        $this->assertArrayHasKey('hotel', $dataDecoded, sprintf('Hotel response does not contain \'hotel\' key for url : %s%s', $reswebServer->getHotel(), PHP_EOL));

        // Step 4: Do a post into the vehicle url and check the reponse is json encoded and has the main arrays set up (error, warning)
        fprintf(STDOUT, '    --> Testing vehicle url : %s%s', $reswebServer->getVehicle(), PHP_EOL);
        $dataDecoded = $this->checkService($reswebServer->getVehicle());
        $this->assertArrayHasKey('vehicleClass', $dataDecoded, sprintf('The response does not contain \'vehicleClass\' key for url : %s%s', $reswebServer->getVehicle(), PHP_EOL));

        // Step 5: Do a post into the transport url and check the reponse is json encoded and has the main arrays set up (error, warning)
        fprintf(STDOUT, '    --> Testing transport url : %s%s', $reswebServer->getTransport(), PHP_EOL);
        $dataDecoded = $this->checkService($reswebServer->getTransport());
        $this->assertArrayHasKey('productBrand', $dataDecoded, sprintf('The response does not contain \'productBrand\' key for url : %s%s', $reswebServer->getTransport(), PHP_EOL));

        // Step 6: Do a post into the seatmap url and check the reponse is json encoded and has the main arrays set up (error, warning)
        fprintf(STDOUT, '    --> Testing seatmap url : %s%s', $reswebServer->getSeatmap(), PHP_EOL);
        $dataDecoded = $this->checkService($reswebServer->getSeatmap());
        $this->assertArrayHasKey('flight', $dataDecoded, sprintf('The response does not contain \'flight\' key for url : %s%s', $reswebServer->getSeatmap(), PHP_EOL));

        // Step 4: Do a post into the book cart url and check the reponse is json encoded and has the main arrays set up (cart, error, warning)
        fprintf(STDOUT, '    --> Testing book cart url : %s%s', $reswebServer->getCart(), PHP_EOL);
        $dataDecoded = $this->checkService($reswebServer->getCart());
        $this->assertArrayHasKey('cart', $dataDecoded, sprintf('Cart response does not contain \'cart\' key for url : %s%s', $reswebServer->getCart(), PHP_EOL));

        curl_close($ch);
    }

    /**
     * Checks a service by submitting an empty json and checking that a json is returned that has the error and warning keys set
     *
     * @param string $serviceUrl The service url to connect to
     *
     * @return mixed
     */
    protected function checkService($serviceUrl)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_URL, $serviceUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{}');
        $data = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->assertTrue($httpStatus == 200, sprintf('Could not post to : \'%s\'.%s', $serviceUrl, PHP_EOL));
        $dataDecoded = json_decode($data, true);
        $this->assertArrayHasKey('error', $dataDecoded, sprintf('The response does not contain \'error\' key for url : %s%s', $serviceUrl, PHP_EOL));
        $this->assertArrayHasKey('warning', $dataDecoded, sprintf('The response does not contain \'warning\' key for url : %s%s', $serviceUrl, PHP_EOL));
        curl_close($ch);

        return $dataDecoded;
    }

    /**
     * Provider method see : http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html (Data Providers)
     *
     * @return Returns the array of resweb servers to be sent to the testReswebConnectivity
     */
    public function provider()
    {
        $this->client = static::createClient();

        $this->reswebServers = array();
        foreach ($GLOBALS as $var => $value) {
            if (strpos($var, 'resweb_server_') !== false) {
                $reswebUrl = new ReswebUrl();
                $reswebUrl->setMain($value . '/resweb/');

                $flightUrl = str_replace($this->client->getContainer()->getParameter('g4_resweb'), $value, $this->client->getContainer()->getParameter('g4_search_service_getavail_flight'));
                $reswebUrl->setFlight($flightUrl);

                $hotelUrl = str_replace($this->client->getContainer()->getParameter('g4_resweb'), $value, $this->client->getContainer()->getParameter('g4_search_service_getavail_hotel'));
                $reswebUrl->setHotel($hotelUrl);

                $vehicleUrl = str_replace($this->client->getContainer()->getParameter('g4_resweb'), $value, $this->client->getContainer()->getParameter('g4_search_service_getavail_vehicle'));
                $reswebUrl->setVehicle($vehicleUrl);

                $transportUrl = str_replace($this->client->getContainer()->getParameter('g4_resweb'), $value, $this->client->getContainer()->getParameter('g4_search_service_getavail_transport'));
                $reswebUrl->setTransport($transportUrl);

                $productUrl = str_replace($this->client->getContainer()->getParameter('g4_resweb'), $value, $this->client->getContainer()->getParameter('g4_search_service_getavail_product'));
                $reswebUrl->setProduct($productUrl);

                $seatmapUrl = str_replace($this->client->getContainer()->getParameter('g4_resweb'), $value, $this->client->getContainer()->getParameter('g4_search_service_getavail_seatmap'));
                $reswebUrl->setSeatmap($seatmapUrl);

                $cartUrl = str_replace($this->client->getContainer()->getParameter('g4_resweb'), $value, $this->client->getContainer()->getParameter('g4_search_service_cart_book'));
                $reswebUrl->setCart($cartUrl);

                $this->reswebServers[] = array(
                    $reswebUrl
                );
            }
        }

        return $this->reswebServers;
    }

}