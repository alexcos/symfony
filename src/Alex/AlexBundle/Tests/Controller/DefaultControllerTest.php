<?php

namespace Alex\AlexBundle\Tests\Controller;

use Alex\AlexBundle\Controller\DefaultController;
use Alex\AlexBundle\Entity\Lookup;
use Alex\AlexBundle\Entity\SearchData;
use Buzz\Message\Request;
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


    public function setUp(){
        $this->client = static::createClient();
        $this->controller = new DefaultController();
        $this->controller->setContainer($this->client->getContainer());
    }

    public function testBuzzRequest() {

        $buzz = $this->client->getContainer()->get('buzz');

        $headers = array("Content-Type" => "application/json");

        $response = $buzz->get('http://svbjbshc1.sbx.allegiantair.com:8580/otares/v1/api/lookups', $headers);
        //echo $response;
        $processedResponse = json_decode($response->getContent());

        $this->assertTrue(isset($processedResponse->CustomerRole));
    }

    public function testControllerRequest() {
        $processedResponse = $this->controller->requestService('http://svbjbshc1.sbx.allegiantair.com:8580/otares/v1/api/lookups', "application/json");
        $this->assertTrue(isset($processedResponse->CustomerRole));
    }

    public function testGetFlightAvailInput() {
        $data = new SearchData();
        $data->date = "2013-11-19";
        $data->departAirport = "BLI";
        $data->arriveAirport = "LAS";
        $response = $this->controller->searchFlightsByDate($data);
    }
}
