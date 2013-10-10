<?php
namespace G4\UtilBundle\Controller;

/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.HotelBundle.Controller
 */

use G4\ShoppingCartBundle\Entity\CartRequest\Location;
use G4\ShoppingCartBundle\Entity\CartRequest\SearchParams;
use G4\UtilBundle\Entity\LocationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use G4\UtilBundle\Exception\PutContentsNotFoundException;
use G4\UtilBundle\Exception\ContainerNotInitializedException;
use G4\UtilBundle\Exception\ReswebTimeoutException;
use G4\UtilBundle\Exception\NoDocketsException;
use G4\UtilBundle\Exception\G4Exception;
use G4\UtilBundle\Exception\MissingFieldException;
use Symfony\Component\HttpFoundation\Response;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;
use G4\UtilBundle\Events\MessageLoggingEvent;
use G4\UtilBundle\Events\HttpEvent;
use G4\UtilBundle\Events\SymfonyEvent;
use G4\UtilBundle\Exception\InvalidSearchRequest;

/**
 * ServiceController
 */
abstract class ServiceController extends G4Controller
{
    public $inEvent = 'utilbundle.symfin';
    public $outEvent = 'utilbundle.symfout';
    public $docketErrors = array();

    /**
     * Search using POST
     *
     * @param string $hash       hash
     * @param string $key        key
     * @param string $manifestid Manifest Id
     *
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function searchPostAction($hash, $key, $manifestid = '')
    {
        $data = $this->getPutData();

        /** @var $g4Container \G4\UtilBundle\Services\G4Container */
        $g4Container = $this->get('g4_container');

        $manifestId = $g4Container->getManifestId();
        $this->dispatch('utilbundle.symfin', new SymfonyEvent($manifestId, $data, get_class($this), $this->getRequest()->getRequestUri(), $g4Container->getRequestPairKey()));

        $g4Container->setRequestType(\G4\UtilBundle\Services\G4Container::REQUEST_TYPE_SYMFONY);

        return $this->searchAction($hash, $data, $key, $manifestid);
    }

    /**
     * Kick off the actual search into the resweb service
     *
     * @param string $hash       The recieved hash from the put
     * @param string $data       The search data as a json string
     * @param string $key        The key to use to store the data in memcache
     * @param string $manifestId The manifestId - this is what is used for logging
     *                           IMPORTANT !!! - this is not a mandatory parameter in the routes. We are sending this
     *                           parameter only form the online checkin module since in there we have 2 different $hash
     *                           values (1 for each journey) - however we want to log under a single manifestId.
     *
     * @throws \G4\UtilBundle\Exception\BadResWebException
     * @throws \G4\UtilBundle\Exception\ContainerNotInitializedException
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction($hash, $data, $key, $manifestId)
    {
        /** @var $g4Container \G4\UtilBundle\Services\G4Container */
        $g4Container = $this->get('g4_container');

        //we need the $serviceParams to be available outside the try-catch block.
        $serviceParams = new SearchParams();

        $manifestId = $g4Container->getManifestId();

        try {
            $raw = json_decode($data);
            if (!$raw) {
                throw new InvalidSearchRequest("The search request is malformed.");
            }

            /** @var $serviceParams \G4\UtilBundle\Entity\ServiceParams */
            $serviceParams = $this->get('g4_entityhelper')->populateServiceParams($raw, $this->getType());

            $this->setManifestID($manifestId);

            // fetch dockets
            try {
                $dockets = $this->fetchDocket($this->fetchDocketData($serviceParams), $hash);
            } catch (NoDocketsException $e) {
                $this->dispatch('logger.warn', new MessageLoggingEvent($manifestId, sprintf('No Dockets found at %s. Returning empty array.', $e->getUrl())));
                $dockets = null;

            }
            if (is_null($dockets)) {
                $this->persistReswebResponse($key, array(), $serviceParams);
                $this->writeToMemcache($key, json_encode(array()));

                return $this->buildResponse(json_encode(array()));
            }

            // set up rest service
            if (is_null($this->container)) {
                throw new ContainerNotInitializedException('Please initialize your container first!');
            }
            $requestInput = $this->buildRequestJson($hash, $serviceParams, $dockets);

            if (is_null($requestInput)) {
                // TODO should this be an error?
                $this->dispatch('logger.warn', new MessageLoggingEvent($manifestId, 'SERVICE > No JSON for resweb! Returning empty results.'));

                return $this->buildResponse(json_encode(array()));
            }

            $requestInput->callerInfo = $this->getCallerInfo(
                $serviceParams->getSessionId(),
                $serviceParams->getClientIp(),
                $serviceParams->getDeepLinkSource()
            );
            $requestInput->payloadAttributes = $this->preparePayloadAttributesByBookingType(
                $serviceParams->getTransactionId(),
                $serviceParams->getBookingTypeId()
            );
            $_data = json_encode($requestInput);

            // perform the actual connection to resweb
            $results = $this->callReswebRemotely(
                $this->getServiceUrl(),
                $_data,
                $manifestId,
                $this->getTimeout()
            );

            if (is_null($results) || ! $results) {
                $this->persistReswebResponse($key, array(), $serviceParams);
                $this->writeToMemcache($key, json_encode(array()));

                return $this->buildResponse(json_encode(array()));
            }

            $this->persistReswebResponse($key, $results, $serviceParams);

            if (!is_array($results)) {
                throw new \G4\UtilBundle\Exception\BadResWebException(
                    $this->get('g4_services_call'),
                    $results,
                    $key
                );
            }

            $_results = $this->sortById($results, $this->manifestID);
            $this->dispatch('logger.debug', new MessageLoggingEvent($manifestId, sprintf('SERVICE > Retrieved %d %s results', count($_results), $this->getType())));

            // blend data from docket and data from hotel into output format
            $searchResults = $this->blendResultsWithDockets($_results, $dockets, $key);

            $this->dispatch('logger.debug', new MessageLoggingEvent($manifestId, sprintf('SERVICE > Returning %d %s results after blending', count($searchResults), $this->getType())));

            // finally tack on any errors
            $this->handleServiceErrors($manifestId, $results);
            $searchResults = $this->postProcessResults($searchResults, $_data);// json_encode($searchResults);

        } catch (\Exception $e) {
            $this->dispatch('logger.error', new MessageLoggingEvent($manifestId, $e->getMessage()));
            $searchResults = json_encode(G4Exception::exceptionToArray($e));
        }

        $this->persistServiceResponse($key, $searchResults, $serviceParams);

        return $this->buildResponse($searchResults);
    }

    /**
     * The method is invoked when returning a response from symfony. It makes sure that all responses are being loged in the timeline.
     *
     * @param string $json
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function buildResponse($json)
    {
        //log the http response to the timeline
        $this->dispatch('utilbundle.symfout', new SymfonyEvent($this->get('g4_container')->getManifestId(), $json, get_class($this), $this->getRequest()->getRequestUri(), $this->get('g4_container')->getRequestPairKey(), 200));

        return new Response($json);
    }

    /**
     * Handle errors received from resweb
     * @param string $manifestId Manifest Id
     * @param array  $results    Results received from resweb
     *
     * @return void
     */
    public function handleServiceErrors($manifestId, $results)
    {
        if (array_key_exists('error', $results) and count($results['error'])>0) {
            //$searchResults['error'] = $_results['error'];
            $this->dispatch('logger.error', new MessageLoggingEvent($manifestId, sprintf('SERVICE > Returning error for %s', $this->getType()), 'default', array(), $results));
        }
    }

    /**
     * Persist response
     * @param string                              $key           memcache key
     * @param array                               $results       stored results
     * @param \G4\UtilBundle\Entity\ServiceParams $serviceParams ServiceParams
     *
     * @return void
     */
    public function persistServiceResponse($key, $results, $serviceParams)
    {
        $this->writeToMemcache($key, $results);
    }

    /**
     * Post-process the results array before blending it with the dockets
     *      Overwrite in child services for proper implementation.
     *      Currently only the flight service needs heavy parsing functionality.
     *
     * @param array  $blended results array blended with dockets
     * @param string $_data   json-encoded request we made to resweb
     *
     * @return string processed results
     */
    public function postProcessResults(array $blended, $_data = '')
    {
        return json_encode($blended);
    }

    /**
     * Blend results with dockets
     *
     * This function expects two associative arrays.  One of dockets and other
     * of results. Both arrays need to be keyed by the UUID of the object in
     * the res web system.  This function matched results with dockets and
     * formats the data to be in the correct format for the javascipt to pull
     * and render from memcache.
     *
     * @param array  $results The results from res web
     * @param array  $dockets The dockets from drupal
     * @param string $key     The memcache key that will be used for storage
     *
     * @abstract
     * @access public
     * @return array Results ready for memcache
     */
    public abstract function blendResultsWithDockets($results, $dockets, $key);

    /**
     * Prepare data used to fetch the docket
     *      TODO override in child services when other data is used
     *
     * @param \G4\ShoppingCartBundle\Entity\CartRequest\SearchParams $data The search data as a json string
     *
     * @return array data to be used when fetching docket
     */
    public function fetchDocketData(\G4\UtilBundle\Entity\ServiceParams $data)
    {
        return $data->getDestination();
    }

     /**
      * Prepare URL to fetch the docket(s).
      *
      * @param array $loc Array of location data
      *
      * @return string
      */
     public function fetchDocketUrl(LocationInterface $loc)
     {
         $key = sprintf('g4_docketservice_%s_url', $this->getType());
         $url = $this->container->getParameter($key);

         return sprintf('%s/%s.json', $url, $loc->getCode());
     }

    /**
     * Fetch dockets from the docket server
     *
     * Returns an array indexed by the resweb id of the object
     *
     * @param Location  $loc  Array of location data
     * @param string $hash The hash used to identify this search
     *
     * @see $location
     * @access public
     * @return array data of the docket for the provided object
     */
    public function fetchDocket($loc, $hash)
    {
        $this->dispatch('logger.debug', new MessageLoggingEvent($hash, sprintf('%s SERVICE > Fetching %s dockets', strtoupper($this->getType()), $this->getType())));

        $_url = $this->fetchDocketUrl($loc);
        $this->dispatch('logger.debug', new MessageLoggingEvent($hash, sprintf('Accessing dockets at %s', $_url)));

        $dockets = array();
        try {
            $data = file_get_contents($_url);
        } catch (\Exception $e) {
            // Sy2 throes an error if it get a 404.  Catch this, log it an return empty dockets

            $this->get('g4_logging')->hashError($hash, $e->getMessage());
            throw new NoDocketsException('Docket returns 404.', $_url, $hash);

            return $dockets;
        }
        if (!$data) {
            $error = sprintf(
                'Failed to get data from %s, https status %d',
                $_url,
                $http_response_header['0']
            );
            $this->get('g4_logging')->hashError($hash, $error);
            throw new NoDocketsException($error, $_url, $hash);
        }

        $json = json_decode($data, true);
        if (is_array($json) and array_key_exists('rows', $json)) {
            foreach ($json['rows'] as $docket) {
                $basename = isset($docket['id'])
                    ? $docket['id']
                    : isset($docket['value']['vid']) ? $docket['value']['vid'] : null;
                if (is_null($basename)) {
                    /* $this->dispatch('logger.warn', new MessageLoggingEvent($hash, sprintf('%s() L#%s > skipping docket with no proper ID', __METHOD__, __LINE__), 'default', array(), $docket)); */
                    continue;
                }
                $id = basename($basename, '.json');
                $dockets[$id] = $docket;
            }
        } else {
            throw new NoDocketsException("Poorly formated json returned from '$_url'");
        }

        $this->dispatch('logger.debug', new MessageLoggingEvent($hash, sprintf('%s SERVICE > Retrieved %d dockets', strtoupper($this->getType()), count($dockets))));

        if (!count($dockets)) {
            throw new NoDocketsException('Docket file doesn\'t contain any information.', $_url, $hash);
        }

        return $dockets;
    }

    /**
     * Obtain the URL of the resweb service that we will access.
     * Can be overwritten in child classes.
     *
     * @return string
     */
    protected function getServiceUrl()
    {
        return $this->container->getParameter('g4_search_service_getavail_' . $this->getType());
    }

    /**
     * Abstract type identifier
     *
     * Subclasses should referrence one of the properties in the search controller
     *
     * @see G4\SearchBundle\Controller\DispatchController
     * @abstract
     * @access public
     * @return string
     */
    public abstract function getType();

    /**
     * Obtain number of seconds to timeout resweb call; overwrite in individual services where needed.
     *
     * @return integer
     */
    public function getTimeout()
    {
        return ($this->container->getParameter('g4_timeout_reswebdefault'));
    }

    /**
     * Return datetime for the Start of the day
     * @param string $date Datetime string that needs to be parsed
     *
     * @return array
     */
    protected function getDayStartDateTime($date)
    {
        $dateParsed = date_parse($date);
        $dayTime = sprintf("%s-%02d-%02dT00:00:00", $dateParsed['year'], $dateParsed['month'], $dateParsed['day']);


        return $dayTime;
    }

    /**
     * Builds the JSON array to pass to the rest service
     *
     * @param mixed $hash    hash
     * @param \G4\UtilBundle\Entity\ServiceParams $data data
     * @param mixed $dockets dockets
     *
     * @static
     * @final
     * @access public
     * @return RequestInput request object ready to send to the res service
     */
    public abstract function buildRequestJson($hash, \G4\UtilBundle\Entity\ServiceParams $data, $dockets);

    /**
     * Takes an array of data and checks that it has a valid format
     *
     * It finds and check the data passed for compatibility with the web
     * service.   Where possible bad data is corrected.
     *
     * @param array &$data Data to check for consitency
     *
     * @static
     * @final
     * @access public
     * @return void
     */
    public function checkDataFormat(&$data)
    {
        return true;
    }

    /**
     * Sorts the array into an associative array where id => object
     *
     * This needs to be implemented by child contolers so that the return data
     * is keyed by uuid
     *
     * @param array  $json       the json data to sort
     * @param string $manifestId the identifier of the current search
     *
     * @static
     * @abstract
     * @access public
     * @return array of sorted data
     */
    public abstract function sortById(array $json, $manifestId = '');

    /**
     * Utility method for fetching array values
     *
     * @param array                 $array     Source
     * @param string                $field     Required field
     * @param MissingFieldException $exception Exception to be thrown in case the field does not exist
     * @param bool                  $silent    Dont trigger an error if the field does not exist.
     *
     * @throws MissingFieldException
     * @internal param int $errorCode Error code . I dunno what the default should be
     * @internal param string $errorMessage Error message, in case key does not exist.
     *
     * @return mixed
     */
    public function getArrayField(array $array, $field, \G4\UtilBundle\Exception\MissingFieldException $exception = null, $silent = true)
    {
        $return = null;

        try {
            $return = $array[$field];
        } catch (\Exception $e) {
            if (!$silent) {
                if (!$exception) {
                    $exception = new MissingFieldException($e->getMessage(), 'NoManifestId');
                }
                throw $exception;
            } else {
                if ($exception) {
                    $json['error'][] = array(
                        'message' => $exception->getMessage(),
                        'code' => $exception->getCode()
                    );
                    $this->dispatch('logger.error',
                        new \G4\UtilBundle\Events\MessageLoggingEvent($exception->getManifestID(), $exception->getMessage(),
                            get_class($this), array(), $json));
                }
            }
        }

        return $return;
    }

    /**
     * We send the promotions array from the docket together with the booking start date and end date for this service and
     * we return an array of promotions that meet the date filtering criteria.
     *
     * @param $docketPromotions array   The array containing the promotions from the docket file
     * @param $bookingStartDate integer The timestamp of the start date
     * @param $bookingEndDate   integer The timestamp of the end date
     *
     * @return array
     */
    protected function handlePromotions($docketPromotions, $bookingStartDate, $bookingEndDate)
    {
        $promotions = array();

        foreach ($docketPromotions as $docketPromotion) {

            $systemTime = time();

            //Condition 2: System Date is within From/To Display Dates
            $promoDisplayFrom       = $docketPromotion['field_g4_promo_display_from'];
            $promoDisplayTo         = $docketPromotion['field_g4_promo_display_to'];
            if ($systemTime < $promoDisplayFrom || $systemTime > $promoDisplayTo) {
                continue;
            }

            //Condition 3: System Date is within From/To Reservation/Book Dates
            $promoReservationFrom   = $docketPromotion['field_g4_promo_reservation_from'];
            $promoReservationTo     = $docketPromotion['field_g4_promo_reservation_to'];
            if ($systemTime < $promoReservationFrom || $systemTime > $promoReservationTo) {
                continue;
            }

            //Condition 4: Flight Dates are within From/To Rental Dates
            $promoOccupancyFrom     = $docketPromotion['field_g4_promo_occupancy_from'];
            $promoOccupancyTo       = $docketPromotion['field_g4_promo_occupancy_to'];
            if ((strtotime($bookingStartDate) < $promoOccupancyFrom || strtotime($bookingStartDate) > $promoOccupancyTo ||
                strtotime($bookingEndDate) < $promoOccupancyFrom || strtotime($bookingEndDate) > $promoOccupancyTo)) {
                continue;
            }

            //Condition 5: Flight Dates are not within From/To Blackout Dates
            if (isset($docketPromotion['field_g4_promo_blackout_dates_embedded'])) {
                $blackOutDates = $docketPromotion['field_g4_promo_blackout_dates_embedded'];
                if (is_array($blackOutDates) && count($blackOutDates)) {
                    foreach ($blackOutDates as $blackOut) {
                        $promoBlackoutFrom  = $blackOut['field_g4_promo_blackout_from'];
                        $promoBlackoutTo    = $blackOut['field_g4_promo_blackout_to'];
                        if (strtotime($bookingStartDate) > $promoBlackoutFrom && strtotime($bookingStartDate) < $promoBlackoutTo &&
                            strtotime($bookingEndDate) > $promoBlackoutFrom && strtotime($bookingEndDate) < $promoBlackoutTo ) {
                            continue(2);
                        }
                    }
                }
            }

            //If the minimum nights condition is not met we skip this promotion
            $minimumNights = $docketPromotion['field_g4_promo_minimum_nights'];
            $numberOfNights = round(
                (strtotime(date('Y-m-d', strtotime($bookingEndDate))) -
                    strtotime(date('Y-m-d', strtotime($bookingStartDate)))
                )/86400
            );
            if ($numberOfNights < $minimumNights) {
                continue;
            }

            $promotion = array(
                'id'        => $docketPromotion['nid'],
                'title'     => $docketPromotion['field_g4_promo_headline'],
                'text'      => $docketPromotion['field_g4_promo_brief'],
                'info_url'  => $docketPromotion['info_url'],
            );

            $promotions[] = $promotion;
        }

        return $promotions;
    }

    /**
     * @param int    $code        Error code
     * @param string $description Error description
     * @param string $level       Error level
     */
    public  function addDocketError($code, $description, $level = 'DOCKETS')
    {
        $this->docketErrors[] = array(
            'code' => $code,
            'description' => $description,
            'level' => $level
        );
    }

    /**
     * Handle the docket errors
     */
    public function handleDocketErrors($message)
    {
        if (count($this->docketErrors)) {
            $this->dispatch('logger.error',
                new \G4\UtilBundle\Events\MessageLoggingEvent($this->getManifestID(), $message,
                    get_class($this), array(), array('error' => $this->docketErrors)));
        }
    }
}
