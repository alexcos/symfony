<?php

namespace Alex\AlexBundle\Controller;

use Alex\AlexBundle\Entity\CustomerPermission;
use Alex\AlexBundle\Entity\CustomerRole;
use Alex\AlexBundle\Entity\Lookup;
use Doctrine\Common\Collections\ArrayCollection;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use G4\AREBundle\Entity\com\allegiant\are\dto\flight;

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


        /*
        $originalLookup = new Lookup();
        $arrayCollection = new ArrayCollection();

        $customerRole = new CustomerRole();
        $customerRole->setId(1);
        $customerRole->setName("myallegiant");

        $customerRole2 = new CustomerRole();
        $customerRole2->setId(2);
        $customerRole2->setName("role name");

        $customerPermission = new CustomerPermission();
        $customerPermission->setId(16);
        $customerPermission->setName("Apply a voucher as a form of payment");

        $customerPermission2 = new CustomerPermission();
        $customerPermission2->setId(7);
        $customerPermission2->setName("Add Bags to a Booking");

        $permissionsArrayCollection = new ArrayCollection();
        $permissionsArrayCollection->add($customerPermission);
        $permissionsArrayCollection->add($customerPermission2);

        $customerRole->setCustomerPermission($permissionsArrayCollection);


        $arrayCollection->add($customerRole);
        $arrayCollection->add($customerRole2);

        $originalLookup->setCustomerRole($arrayCollection);

        $serializedLookup = $serializer->serialize($originalLookup, 'json');
        #echo $serializedLookup;
        */

        $data = $serializer->deserialize($response->getContent(), 'Alex\AlexBundle\Entity\Lookup', 'json');
        #$data = $serializer->deserialize($serializedLookup, 'Alex\AlexBundle\Entity\Lookup', 'json');


        #$processedResponse = json_decode($response->getContent());

        return $data;
    }

    /**
     * @param string $date
     */
    public function searchFlightsByDate($date) {

        $getFlightAvailInput = $this->createFlightAvailInput($date);

        $serializedGetFlightAvailInput = $this->serializeFlightAvailInput($getFlightAvailInput);

        echo $serializedGetFlightAvailInput;

        echo $this->getFlightAvailRequest($serializedGetFlightAvailInput);

    }

    /** @param string $date */
    public function createFlightAvailInput($date) {

        $flightVoucher = null;
        $promoCode = null;

        $travelerProfile = new flight\FlightTravelerProfile();
        $travelerProfile->setNumTravelers(1);

        $classOfService = new flight\Filter();
        $classOfService->setType("INCLUDE");

        $departArriveRequestEntity = $this->buildDepartArriveRequest("1", "ORIGIN_OUTBOUND", true, $date, 7, 7, "00:00:00", 0, 0, "BLI", "LAS", 24, 70);
        $departArriveRequest = array($departArriveRequestEntity);

        $flightEntity = null;
        $flight = array($flightEntity);

        $airportOfOrigin = "BLI";
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

    /*

    /**
     * @param array $flightVoucher
     * @param string $promoCode
     * @param flight\FlightTravelerProfile $travelerProfile
     * @param flight\Filter $classOfService
     *
     * array of com\allegiant\are\dto\flight\Flight entities
     *  @param array $flight
     *
     * array of com\allegiant\are\dto\flight\DepartArriveRequest instances
     *  @param array $departArriveRequest
     *
     * @param string $airportOfOrigin
     * @param integer $maxStops
     * @return flight\GetFlightAvailInput
     *
    public function createFlightAvailInput($flightVoucher, $promoCode, $travelerProfile, $classOfService, $flight, $departArriveRequest, $airportOfOrigin, $maxStops, $callerInfo, $payloadAttributes) {

        return $getFlightAvailInput;

    }

    */

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
        return $response;

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
    public function buildDepartArriveRequest($rph, $type, $departBased, $requestDate, $requestDateMinusDays, $requestDatePlusDays, $requestTime, $requestTimeMinusMinutes, $requestTimePlusMinutes, $departAeroport, $arriveAirport, $maxDurationHours, $marketID)
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
        $departArriveRequestInstance->setDepartAirport($departAeroport);
        $departArriveRequestInstance->setArriveAirport($arriveAirport);
        $departArriveRequestInstance->setMaxDurationHours($maxDurationHours);
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
        $payloadAttributes->setBookingTypeID($bookingChannelID);
        $payloadAttributes->setBookingChannelID($bookingChannelID);
        $payloadAttributes->setTransactionIdentifier($transactionIdentifier);
        $payloadAttributes->setVersion($version);
        $payloadAttributes->setTimeStamp($timeStamp);
        return $payloadAttributes;
    }
}
