<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 12:38 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Controller;


use Homework\HomeworkBundle\Entity\CallerInfo;
use Homework\HomeworkBundle\Entity\FlightCollection\Flight;
use Homework\HomeworkBundle\Entity\FlightCollection;
use Homework\HomeworkBundle\Entity\PayloadAttributes;
use Homework\HomeworkBundle\Entity\PropertyCollection\Property;
use Homework\HomeworkBundle\Entity\PropertyCollection;
use Homework\HomeworkBundle\Entity\SeatmapRequest;
use Homework\HomeworkBundle\Entity\SeatmapResponse;
use Homework\HomeworkBundle\Services\SeatmapRequestService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class HomeworkController extends Controller
{

    /** Returns the resweb getSeatMap Response, decoded into PHP entities, the re-encoded into JSON
     *
     * @return Response
     *
     */
    public function indexAction()
    {

        $seatmapService = $this->getSeatmapService();

        $seatmapRequest = $seatmapService->createSeatmapRequest();
        $response = $seatmapService->getSeatmaps($seatmapRequest);

        return $response;
    }

    /** Returns the resweb getSeatMap Response
     *
     * @return Response
     *
     */
    public function rawAction()
    {

        $seatmapService = $this->getSeatmapService();

        $seatmapRequest = $seatmapService->createSeatmapRequest();
        $response = $seatmapService->getSeatmapsRequestResponse($seatmapRequest);

        return $response;

    }

    /** Returns the resweb getSeatMap Response for an invalid request
     *
     * @return Response
     *
     */
    public function invalidAction()
    {

        $seatmapService = $this->getSeatmapService();

        $seatmapRequest = $seatmapService->createInvalidSeatmapRequest();
        $response = $seatmapService->getSeatmaps($seatmapRequest);

        return $response;

    }

    /** Make a post request to the getSeatmaps resweb service an print the Response
     *
     * @return \Buzz\Message\Response
     *
     */
    public function getSeatmapsRequest(SeatmapRequest $seatmapRequest)
    {
        $url = $this->container->getParameter('seatmapURL');

        $buzz = $this->container->get('buzz');
        $headers = array("Content-Type" => 'application/json');

        $response = $buzz->post(
            $url,
            $headers,
            $seatmapRequest->toJson()
        );

        return $response;

    }

    /**
     * @return SeatmapRequestService
     */
    public function getSeatmapService()
    {
        $seatmapService = $this->get('homework_homework.seatmap_service');

        return $seatmapService;
    }

}