<?php

namespace Alex\AlexBundle\Controller;

use Alex\AlexBundle\Entity\CustomerPermission;
use Alex\AlexBundle\Entity\CustomerRole;
use Alex\AlexBundle\Entity\Lookup;
use Alex\AlexBundle\Entity\Resweb\Market;
use Alex\AlexBundle\Entity\SearchData;
use Buzz\Message\Response;
use Doctrine\Common\Collections\ArrayCollection;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use G4\AREBundle\Entity\com\allegiant\are\dto\flight;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('AlexAlexBundle:Default:index.html.twig', array('name' => $name));
    }

    public function requestService($url, $contentType) {

        $buzz = $this->container->get('buzz');

        $headers = array("Content-Type" => $contentType);

        $response = $buzz->get($url, $headers);

        $processedResponse = json_decode($response->getContent());

        return $processedResponse;
    }

    public function searchFlightsAction() {

        $json = $this->getRequest()->getContent(); //request->get("searchData");

        $serializer = $this->container->get('jms_serializer');

        $data = $serializer->deserialize($json, 'Alex\AlexBundle\Entity\SearchData', 'json');

        $response = new \Symfony\Component\HttpFoundation\Response( $this->searchFlightsByDate($data),
            200,
            array('content-type' => 'application/json')
        );

        return $response;

    }


    /**
     * @param $url
     * @param $contentType
     * @return Lookup
     */
    public function requestServiceAndConvert() {

        $url = $this->container->getParameter('lookupURL');
        $contentType = 'application/json';

        $buzz = $this->container->get('buzz');

        $headers = array("Content-Type" => $contentType);

        $response = $buzz->get($url, $headers);

        $serializer = $this->container->get('jms_serializer');

        $data = $serializer->deserialize($response->getContent(), 'Alex\AlexBundle\Entity\Lookup', 'json');

        return $data;
    }

    /**
     * @param SearchData $data
     * @return string
     */
    public function searchFlightsByDate(SearchData $data) {

        $getFlightAvailInput = $this->createFlightAvailInput($data);

        $serializedGetFlightAvailInput = $this->serializeFlightAvailInput($getFlightAvailInput);

        return $this->getFlightAvailRequest($serializedGetFlightAvailInput);

    }

    /** @param SearchData $data */
    public function createFlightAvailInput(SearchData $data) {

        $flightVoucher = null;
        $promoCode = null;

        $travelerProfile = new flight\FlightTravelerProfile();
        $travelerProfile->setNumTravelers(1);

        $classOfService = new flight\Filter();
        $classOfService->setType("INCLUDE");


        $departArriveRequestEntity = $this->buildDepartArriveRequest("1", "ORIGIN_OUTBOUND", true, $data->date, 7, 7, "00:00:00", 0, 0, $data->departAirport, $data->arriveAirport, 24);
        $departArriveRequest = array($departArriveRequestEntity);

        $flightEntity = null;
        $flight = array($flightEntity);

        $airportOfOrigin = "BIL";
        $maxStops = 1;

        $callerInfo = $this->buildUserProfile("symfonyuser", "", "G4\\FlightBundle\\Controller\\FlightController", "awesome.lola", "525524f4c3993", "10.177.134.39");

        $payloadAttributes = $this->buildPayloadAttributes(1, 1, "525524f4c38ff", 1, "2013-10-09T09:42:12");

        //$getFlightAvailInput = $this->createFlightAvailInput($flightVoucher, $promoCode, $travelerProfile, $classOfService, $flight, $departArriveRequest, $airportOfOrigin, $maxStops, $callerInfo, $payloadAttributes);

        $getFlightAvailInput = new flight\GetFlightAvailInput();
        $getFlightAvailInput->setFlightVoucher($flightVoucher);
        $getFlightAvailInput->setPromoCode($promoCode);
        $getFlightAvailInput->setTravelerProfile($travelerProfile);
        $getFlightAvailInput->setClassOfService($classOfService);
        $getFlightAvailInput->setFlight($flight);
        $getFlightAvailInput->setDepartArriveRequest($departArriveRequest);
        $getFlightAvailInput->setAirportOfOrigin($airportOfOrigin);
        $getFlightAvailInput->setMaxStops($maxStops);
        $getFlightAvailInput->setCallerInfo($callerInfo);
        $getFlightAvailInput->setPayloadAttributes($payloadAttributes);

        return $getFlightAvailInput;

    }

    /**
     * @param GetFlightAvailInput $getFlightAvailInput
     * @return string
     */
    public function serializeFlightAvailInput($getFlightAvailInput) {

        $serializer = $this->container->get('jms_serializer');
        $serializedGetFlightAvailInput = $serializer->serialize($getFlightAvailInput, 'json');
        return $serializedGetFlightAvailInput;

    }

    /**
     * @param string $serializedGetFlightAvailInput
     * @return string
     */
    public function getFlightAvailRequest($serializedGetFlightAvailInput) {

        $buzz = $this->container->get('buzz');
        $headers = array("Content-Type" => 'application/json');
        $response = $buzz->post($this->container->getParameter('flightRequestURL'), $headers, $serializedGetFlightAvailInput);
        //echo $serializedGetFlightAvailInput;
        return $response;

    }

    /**
     * @return integer
     * @param string $fromAirport
     * @param string $toAirport
     */
    public function getMarketIdRequest($fromAirport, $toAirport) {

        $airports = $fromAirport.$toAirport;

        $buzz = $this->container->get('buzz');
        $headers = array("Content-Type" => 'application/json');

        $serializer = $this->container->get('jms_serializer');

        $requestUrl = $this->container->getParameter('reswebMarketURL').'/'.$airports.".json";

        $response =  $buzz->get($requestUrl, $headers);
        /** @var Market $market */
        $market = $serializer->deserialize($response->getContent(), 'Alex\AlexBundle\Entity\Resweb\Market', 'json');

        return $market->getReswebid();

    }

    /**
     * @param string $rph
     * @param DepartArriveRequestType $type
     * @param bool $departBased
     *
     * date format 'Y-M-D"
     * @param string $requestDate
     *
     * @param integer $requestDateMinusDays
     * @param integer $requestDatePlusDays
     * @param string $requestTime
     * @param integer $requestTimeMinusMinutes
     * @param integer $requestTimePlusMinutes
     * @param string $departAeroport
     * @param string $arriveAeroport
     * @param integer $maxDurationHours
     * @param integer $marketID
     *
     * @return flight\DepartArriveRequest
     */
    public function buildDepartArriveRequest($rph, $type, $departBased, $requestDate, $requestDateMinusDays, $requestDatePlusDays, $requestTime, $requestTimeMinusMinutes, $requestTimePlusMinutes, $departAirport, $arriveAirport, $maxDurationHours)
    {
        $departArriveRequestInstance = new flight\DepartArriveRequest();
        $departArriveRequestInstance->setRph($rph);
        $departArriveRequestInstance->setType($type);
        $departArriveRequestInstance->setDepartBased($departBased);
        $departArriveRequestInstance->setRequestDate($requestDate);
        $departArriveRequestInstance->setRequestDateMinusDays($requestDateMinusDays);
        $departArriveRequestInstance->setRequestDatePlusDays($requestDatePlusDays);
        $departArriveRequestInstance->setRequestTime($requestTime);
        $departArriveRequestInstance->setRequestTimeMinusMinutes($requestTimeMinusMinutes);
        $departArriveRequestInstance->setRequestTimePlusMinutes($requestTimePlusMinutes);
        $departArriveRequestInstance->setDepartAirport($departAirport);
        $departArriveRequestInstance->setArriveAirport($arriveAirport);
        $departArriveRequestInstance->setMaxDurationHours($maxDurationHours);

        $marketID = $this->getMarketIdRequest($departAirport, $arriveAirport);
        $departArriveRequestInstance->setMarketID($marketID);
        return $departArriveRequestInstance;
    }

    /**
     * @param string $name
     * @param string $pwd
     * @param string $appName
     * @param string $moduleName
     * @param string $sessionID
     * @param string $ipAddress
     * @return UserProfile
     */
    public function buildUserProfile($name, $pwd, $appName, $moduleName, $sessionID, $ipAddress)
    {
        $callerInfo = new UserProfile();
        $callerInfo->setName($name);
        $callerInfo->setPwd($pwd);
        $callerInfo->setAppName($appName);
        $callerInfo->setModuleName($moduleName);
        $callerInfo->setSessionID($sessionID);
        $callerInfo->setIpAddress($ipAddress);
        return $callerInfo;
    }

    /**
     * @param integer $bookingTypeID
     * @param integer $bookingChannelID
     * @param string $transactionIdentifier
     * @param integer $version
     * @param string $timeStamp
     * @return PayLoadAttributes
     */
    public function buildPayloadAttributes($bookingTypeID, $bookingChannelID, $transactionIdentifier, $version, $timeStamp)
    {
        $payloadAttributes = new PayLoadAttributes();
        $payloadAttributes->setBookingTypeID($bookingTypeID);
        $payloadAttributes->setBookingChannelID($bookingChannelID);
        $payloadAttributes->setTransactionIdentifier($transactionIdentifier);
        $payloadAttributes->setVersion($version);
        $payloadAttributes->setTimeStamp($timeStamp);
        return $payloadAttributes;
    }
}
