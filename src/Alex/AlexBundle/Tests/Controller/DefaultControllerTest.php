<?php

namespace Alex\AlexBundle\Tests\Controller;

use Alex\AlexBundle\Controller\DefaultController;
use Alex\AlexBundle\Entity\Lookup;
use Alex\AlexBundle\Entity\SearchData;
use Alex\AlexBundle\SearchServices\FlightSearchService;
use Buzz\Message\Request;
use Homework\HomeworkBundle\Controller\HomeworkController;
use Homework\HomeworkBundle\Entity\SeatmapRequest;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class DefaultControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var DefaultController
     */
    private $controller;

    /**
     * @var DefaultController
     */
    private $controller2;

    /** setUp function */
    public function setUp()
    {
        $this->client = static::createClient();
        $this->controller = new DefaultController();
        $this->controller2 = new HomeworkController();
        $this->controller->setContainer($this->client->getContainer());
        $this->controller2->setContainer($this->client->getContainer());
    }

    public function testBuzzRequest()
    {

        $buzz = $this->client->getContainer()->get('buzz');

        $headers = array("Content-Type" => "application/json");

        $response = $buzz->get('http://svbjbshc1.sbx.allegiantair.com:8580/otares/v1/api/lookups', $headers);
        //echo $response;
        $processedResponse = json_decode($response->getContent());

        $this->assertTrue(isset($processedResponse->CustomerRole));
    }

    public function testControllerRequest()
    {
        $processedResponse = $this->controller->requestService(
            'http://svbjbshc1.sbx.allegiantair.com:8580/otares/v1/api/lookups',
            "application/json"
        );
        $this->assertTrue(isset($processedResponse->CustomerRole));
    }

    public function testGetFlightAvailInput()
    {
        $data = new SearchData();
        $data->date = "2013-11-19";
        $data->departAirport = "BIL";
        $data->arriveAirport = "LAS";
        $response = $this->controller->searchFlightsByDate($data);
        // echo $response;
    }

    public function testGetMarketId()
    {
        $response = $this->controller->getMarketIdRequest("BIL", "LAS");
        $this->assertTrue($response == 1);

    }

    public function testSearchFlightsByDateAction()
    {

        $data = new SearchData();
        $data->date = "2013-11-19";
        $data->departAirport = "BIL";
        $data->arriveAirport = "LAS";

        $serializer = $this->client->getContainer()->get('jms_serializer');
        $json = $serializer->serialize($data, 'json');

        //$response = $this->client->request('post', "http://localhost/app_dev.php/alex/searchFlights", array($json));

        $buzz = $this->client->getContainer()->get('buzz');
        $contentType = 'application/json';
        $headers = array("Content-Type" => $contentType);

        //echo "SearchData JSON: ".$json;

        $response = $buzz->post("http://localhost/symfony/web/app_dev.php/SearchFlightsByDate", $headers, $json);
        //echo $response->getContent();

        //echo $response;

    }

    public function testSearchFlightsService()
    {
        $data = new SearchData();
        $data->date = "2013-11-19";
        $data->departAirport = "BIL";
        $data->arriveAirport = "LAS";

        /** @var FlightSearchService $flightService */
        $flightSearchService = $this->client->getContainer()->get('alex_alex.flightSearchService');

        $response = $flightSearchService->searchFlightsByDate($data);
        echo $response;
    }

    public function testHomework()
    {

        $sr = $this->client->getContainer()->get('homework_homework.seatmap_service')->createSeatmapRequest();

        $this->controller2->indexAction($sr);
        $this->assertTrue(true);
    }
}
