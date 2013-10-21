<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/18/13
 * Time: 3:16 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Services;


use Homework\HomeworkBundle\Entity\CallerInfo;
use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap\SeatCollection;
use Homework\HomeworkBundle\Entity\FlightCollection\Flight\SeatMapCollection\SeatMap;
use Homework\HomeworkBundle\Entity\FlightCollection\Flight;
use Homework\HomeworkBundle\Entity\FlightCollection;
use Homework\HomeworkBundle\Entity\PayloadAttributes;
use Homework\HomeworkBundle\Entity\PropertyCollection\Property;
use Homework\HomeworkBundle\Entity\SeatmapRequest;
use Homework\HomeworkBundle\Entity\SeatmapResponse;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SeatmapRequestService
 *
 * @package Homework\HomeworkBundle\Services
 */
class SeatmapRequestService
{
    /** @var  Container */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /** Requests getSeatmap on resweb, decodes the Response into Entities, then ptints the reencoded JSON
     *
     *
     * @return Response
     */
    public function getSeatmaps(SeatmapRequest $seatmapRequest)
    {
        $headers = array("Content-Type" => 'application/json');

        $seatmapResponse = $this->getSeatmapsRequest($seatmapRequest);

        $seatmapDecoded = new SeatmapResponse();
        $seatmapDecoded->fromJson($seatmapResponse->getContent());

        $response = new Response($seatmapDecoded->toJson(), 200, $headers);


        return $response;
    }

    /** Requests getSeatmap on resweb and prints the Response JSON
     *
     *
     * @return Response
     */
    public function getSeatmapsResponse(SeatmapRequest $seatmapRequest)
    {
        $headers = array("Content-Type" => 'application/json');

        $seatmapResponse = $this->getSeatmapsRequest($seatmapRequest);

        $response = new Response($seatmapResponse->getContent(), 200, $headers);


        return $response;
    }

    /** Make a post request to the getSeatmaps resweb service
     *
     * @return Response
     *
     */
    public function getSeatmapsRequestBuzz(SeatmapRequest $seatmapRequest)
    {
        $url = $this->container->getParameter('seatmapURL');

        $headers = array("Content-Type" => 'application/json');

        $buzz = $this->container->get('buzz');

        $response = $buzz->post(
            $url,
            $headers,
            $seatmapRequest->toJson()
        );

        return $response;

    }

    /** Make a post request to the getSeatmaps resweb service
     *
     * @return Response
     *
     */
    public function getSeatmapsRequest(SeatmapRequest $seatmapRequest)
    {
        $url = $this->container->getParameter('seatmapURL');

        $ch = curl_init();
        $headers = array("Content-Type" => 'application/json');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $seatmapRequest->toJson());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);

        $response = new Response($content, 200, $headers);

        return $response;

    }

    /** Make a post request to the getSeatmaps resweb service
     *
     * @return Response
     *
     */
    public function getSeatmapsRequestResponse(SeatmapRequest $seatmapRequest)
    {
        $url = $this->container->getParameter('seatmapURL');

        $ch = curl_init();
        $headers = array("Content-Type" => 'application/json');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $seatmapRequest->toJson());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);

        curl_close($ch);


        $response = new Response($content, 200, $headers);

        return $response;

    }

    /**
     * @return SeatmapRequest
     */
    public function createSeatmapRequest()
    {
        $flight = new Flight();
        $flight->setRph('departing');
        $flight->setCarrierCode('G4');
        $flight->setNbr('220');
        $flight->setDepartDate('2013-10-23');

        $flight2 = new Flight();
        $flight2->setRph('departing');
        $flight2->setCarrierCode('G4');
        $flight2->setNbr('276');
        $flight2->setDepartDate('2012-11-13');

        $flights = new FlightCollection();
        $flights->addFlight($flight);
        //$flights->addFlight($flight2);

        $callerInfo = new CallerInfo();
        $callerInfo->setName('symfonyuser');
        $callerInfo->setPwd('');
        $callerInfo->setAppName('G4\\SeatMapBundle\\Controller\\SeatMapController');
        $callerInfo->setModuleName('SerbansMacbook');
        $callerInfo->setSessionID('7Z5Ao8e_ifoH6gCApirFskkBQ3n_B2_ZylIDkwqMl4M');
        $callerInfo->setIpAddress('::1');

        $payloadAttributes = new PayloadAttributes();
        $payloadAttributes->setBookingTypeID(1);
        $payloadAttributes->setBookingChannelID(1);
        $payloadAttributes->setTransactionIdentifier("507287f2725e7");
        $payloadAttributes->setVersion(1);
        $payloadAttributes->setTimeStamp("2013-10-08T12:46:40");

        $seatmapRequest = new SeatmapRequest();
        $seatmapRequest->setFlight($flights);
        $seatmapRequest->setCallerInfo($callerInfo);
        $seatmapRequest->setPayloadAttributes($payloadAttributes);

        return $seatmapRequest;
    }

    public function temporaryTests()
    {
        $property = new Property();
        $property->setName('name');
        $property->setValue('value');

        $property2 = new Property();
        $property2->setName('name2');
        $property2->setValue('value2');

        $properties = new PropertyCollection();
        $properties->addProperty($property);
        $properties->addProperty($property2);

        $seatMap = new SeatMap();
        $seatMap->setSeat(new SeatCollection());
        $seat = new SeatCollection\Seat();

        $priceComponentOptional = new SeatCollection\Seat\PriceComponentCollection\PriceComponent();
        $priceComponentOptional->getProperty()->addProperty($property);
        $priceComponentOptional->getProperty()->addProperty($property2);
        $seat->getPriceComponentOptional()->addPriceComponent($priceComponentOptional);

        $seatMap->getSeat()->addSeat($seat);
    }

}