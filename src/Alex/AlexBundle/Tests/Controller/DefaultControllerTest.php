<?php

namespace Alex\AlexBundle\Tests\Controller;

use Alex\AlexBundle\Controller\DefaultController;
use Alex\AlexBundle\Entity\Lookup;
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

    /*
    public function testIndex()
    {

        $crawler = $this->client->request('GET', '/hello/Fabien');

        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
*/
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


    /*
    public function testDeserialization() {
        #$encoders = array(new XmlEncoder(), new JsonEncoder());
        #$normalizers = array(new GetSetMethodNormalizer());

        #$serializer = new Serializer($normalizers, $encoders);

        #$response = $this->controller->requestService('http://svbjbshc1.sbx.allegiantair.com:8580/otares/v1/api/lookups', "application/json");
        #$lookup = $serializer->deserialize(json_encode($response), 'Alex\AlexBundle\Entity\Lookup', 'json');


        $lookup = $this->controller->requestServiceAndConvert();

        $customrtRole = $lookup->getCustomerRole();
        $this->assertTrue($customrtRole->current() != null);
    }

    */
    public function testGetFlightAvailInput() {
        $date="2013-11-19";
        $response = $this->controller->searchFlightsByDate($date);
        //echo $response;
    }
}
