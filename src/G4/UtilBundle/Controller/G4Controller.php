<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.HotelBundle.Controller
 */

namespace G4\UtilBundle\Controller;

use G4\UtilBundle\Exception\BookingProcessException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use G4\UtilBundle\Exception\PutContentsNotFoundException;
use G4\UtilBundle\Exception\JsonDecodeException;
use G4\UtilBundle\Exception\ReswebTimeoutException;
use G4\UtilBundle\Exception\ReswebJsonDecodeException;
use G4\UtilBundle\Services\Json;
use G4\UtilBundle\Events\ReswebCallEvent;
use G4\UtilBundle\Events\MemcacheEvent;

use \G4\AREBundle\Entity\com\allegiant\are\dto\common as AreCommon;

// for the exception handler
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

use G4\UtilBundle\Events\LoggingEvent;
use G4\UtilBundle\Events\MessageLoggingEvent;

/**
 * G4Controller
 */
abstract class G4Controller extends Controller
{
    //handle for multi_curl.
    public static $masterHandle;
    // sequential logging id
    public static $no = 0;

    // search types
    const _FLIGHT                   = 'flight';
    const _PRODUCT                  = 'product';
    const _HOTEL                    = 'hotel';
    const _VEHICLE                  = 'vehicle';
    const _SEATMAP                  = 'seatmap';
    const _TRANSPORT                = 'transport';
    const _LEGACY_CUSTOMER_NBR      = 'legacy_customer_nbr';
    const _JOURNEY                  = 'journey';
    const _CHECKIN_BEGIN            = 'checkin_begin';
    const _CHECKIN_COMPLETE         = 'checkin_complete';
    const _CHECKIN_BOARDING_PASS    = 'checkin_bp';
    const _REQUEST_SEAT             = 'request_seat';
    const _KAYAK_FLIGHT             = 'kayak_flight';
    const _GET_ORDER                = 'get_order';

    // memcache keys suffixes for the search services
    const _KEY_FLIGHT               = 'F';
    const _KEY_PRODUCT              = 'P';
    const _KEY_HOTEL                = 'H';
    const _KEY_VEHICLE              = 'V';
    const _KEY_TRANSPORT            = 'T';
    const _KEY_SEATMAP              = 'S';
    const _KEY_PROFILE              = 'U'; // from user, trying not to conflict with self::_KEY_PRODUCT
    const _KEY_JOURNEY              = 'J'; // @todo check if this is necessary
    const _KEY_REQUESTSEAT          = 'RS'; // @todo check if this is necessary
    const _KEY_GET_ORDER            = 'O';
    const _KEY_VOUCHER              = 'VO';
    const _KEY_CART_ITEMS           = 'CI';

    const DIRECTION_ONEWAY = 'oneway';
    const DIRECTION_RETURN = 'return';

    /**
     * Maps the single character in the PUT to a string value
     *
     * @var array
     * @access private
     */
    public static $filterMapping = array(
        self::_KEY_FLIGHT => array(self::_FLIGHT),
        self::_KEY_HOTEL => array(self::_HOTEL),
        self::_KEY_VEHICLE => array(self::_VEHICLE),
        self::_KEY_PRODUCT => array(self::_PRODUCT),
        self::_KEY_TRANSPORT => array(self::_TRANSPORT),
        self::_KEY_SEATMAP => array(self::_SEATMAP),
        // self::_KEY_PROFILE   => array(self::_LEGACY_CUSTOMER_NBR), // not a searchable service
    );

    /**
     * The url to be used in the manifest returned to the drupal put
     *
     * Points to where the AJAX will retrieve the cached seatch data.
     *
     * @var string
     * @access private
     */
    private $_cloudurl = null;

    /**
     * The memcache interface
     *
     * @var \G4\UtilBundle\Services\Persister\Memcache
     * @access private
     */
    protected $_memcache = null;

    /**
     * @var AreCommon\PayLoadAttributes
     */
    protected $payloadAttributes = null;

    /**
     * This is the unique identifier throughout the booking process
     *
     * @var string the search hash / manifest ID / the Md5 of the PUT val
     */
    protected $manifestID = '';

    /**
     * set the cloud url where the client will look for the returned results
     *
     * @param string $url The url
     *
     * @access public
     * @return void
     */
    public function setCloudUrl($url)
    {
        $this->_cloudurl = $url;
    }

    /**
     * The url to be used in the manifest returned to the drupal put
     *
     * @see $_cloudurl
     * @access public
     * @return string (url) stub
     */
    public function getCloudUrl()
    {
        if (empty($this->_cloudurl)) {
            $url = $this->container->getParameter('g4_memcache_cloudurl');
            $this->_cloudurl = rtrim($url, '/') . '/';
        }

        return $this->_cloudurl;
    }

    /**
     * Creates a memcache key for these parameters
     *
     * it will have the form:
     *
     *     sessionID+CODE_TIME.CODE_TIME+TYPE
     *
     * e.g.
     *
     *     sessionID+G4-276_BLI-LAS_1326380400.G4-277_LAS-BLI_1378380400+H
     *
     * This data will then be available at
     *
     *     /search/sessionID/G4-276_BLI-LAS_1326380400.G4-277_LAS-BLI_1378380400/H
     *
     * @param string $sessionId  The unique sessioin ID
     * @param string $codeOut    Airport code and timestamp for the outward airport
     * @param string $codeReturn Airport code and timestamp for the return airport
     * @param string $type       The type of the search
     * @param string $prefix     Service may want to append specific information to url
     *
     * @access public
     * @return string
     */
    public function createServiceMemcacheKey($sessionId, $codeOut, $codeReturn, $type, $prefix = null)
    {
        return self::createServiceMemcacheKeyStatic($sessionId, $codeOut, $codeReturn, $type, $prefix);
    }

    /**
     * TODO: this method should be used static all over the place
     * Exact same method as above just static
     *
     * @static
     *
     * @param $sessionId
     * @param $codeOut
     * @param $codeReturn
     * @param $type
     * @param null $prefix
     * @return string
     */
    public static function createServiceMemcacheKeyStatic($sessionId, $codeOut, $codeReturn, $type, $prefix = null)
    {
        $flightComboId = $codeOut;
        if (strlen($codeReturn)) {
            $flightComboId .= '_' . $codeReturn;
        }
        $key = sprintf(
            '%s~%s~%s',
            $sessionId,
            $flightComboId,
            $type
        );

        $key .= (isset($prefix)) ? '~' . $prefix : '';

        return $key;
    }


    /**
     * Creates memcache keys for the types specified in $types parameter. the $prefixes parameter has to have the same
     * number of elements, or be empty.
     *
     * @param string $sessionId  The unique sessioin ID
     * @param string $codeOut    Airport code and timestamp for the outward airport
     * @param string $codeReturn Airport code and timestamp for the return airport
     * @param array  $types      The type of the search
     * @param array  $prefixes   Service may want to append specific information to url
     *
     * @throws \RuntimeException
     * @return array
     */
    public function createServiceMemcacheKeys($sessionId, $codeOut, $codeReturn, array $types, array $prefixes = array())
    {
        if (count($prefixes) > 0 && count($prefixes) != count($types)) {
            throw new \RuntimeException("types and prefixes arrays have to have the same number of elements, or prefixes needs to be empty");
        }

        $keys = array();
        foreach ($types as $k => $type) {
            $prefix = (isset($prefixes[$k])) ? $prefixes[$k] : null;
            $keys[$type] = $this->createServiceMemcacheKey($sessionId, $codeOut, $codeReturn, $type, $prefix);
        }

        return $keys;
    }

    /**
     * Parses given flight combo like G4-779_ATW-SFB_1328295900 or G4-778_SFB-ATW_1328545200
     *
     * @param string $flightCombo AIRLINEcode-FLIGHTnbr_FROMairport-FROMairport_DEPARTUREtimestamp
     *
     * @return array
     * @throws RuntimeException
     */
    public function parseFlightCombo($flightCombo)
    {
        $pieces = explode('_', $flightCombo);
        if (3 == count($pieces)) {
            $carrierFlight = explode('-', $pieces[0]);
            $fromTo = explode('-', $pieces[1]);
            if (2 == count($carrierFlight) && 2 == count($fromTo)) {
                return array(
                    'airline_code' => $carrierFlight[0],
                    'flight_no' => $carrierFlight[1],
                    'from' => $fromTo[0],
                    'to' => $fromTo[1],
                    'departs' => $pieces[2]
                );
            }
        }

        throw new \RuntimeException(sprintf('Unable to parse flight `%s`', $flightCombo));
    }

    /**
     * Obtain data from the PUT request body at the specified key
     *
     * @param string $key The key at which we should look for the content
     *
     * @final
     * @access protected
     * @throws \G4\UtilBundle\Exception\PutContentsNotFoundException
     *
     * @return The PUT data from $key as a string
     */
    protected final function getPutData($key = 'search')
    {
        $returnData = $this->_getPutData($key);

        return $returnData;
    }

    private final function _getPutData($key)
    {
        /** @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $this->get('request');

        return self::getPutDataFromRequest($request, $key);
    }

    public static final function getPutDataFromRequest(\Symfony\Component\HttpFoundation\Request $request, $key)
    {
        $receivedPutData = $request->request->get($key, null);
        if ($receivedPutData) {
            return $receivedPutData;
        }

        // try and get the data from a get request
        $receivedPutData = $request->query->get($key, null);
        if ($receivedPutData) {
            return $receivedPutData;
        }

        // if it's still empty :-(
        if ($receivedPutData == null /* && false !== strpos(PHP_OS, 'Darwin') */) {
            // START the hack for the _PUT
            // @see http://inchoo.net/tools-frameworks/simfony2-rest-put-request/
            $putStr = $request->getContent();
            parse_str($putStr, $_put);
            if (!isset($_put[$key])) {
                $errorMsg = sprintf('Unable to find data at key %s', $key);
                throw new PutContentsNotFoundException($errorMsg, $key);
            }
            $receivedPutData = stripslashes($_put[$key]);
        }

        if ($receivedPutData == null) {
            // In case of Error stop and return
            $error = 'Received put data not present.';
            throw new PutContentsNotFoundException('No method of finding PUT contents worked!', $key);
        }

        return $receivedPutData;
    }

    /**
     * Translates the single digit type (FHVP) into the full name.
     *
     * @param string $type the single digit type
     *
     * @access public
     * @return string the full name of the type
     */
    public function getFilterKeyMapping($type)
    {
        if (isset(self::$filterMapping[$type][0])) {
            return self::$filterMapping[$type][0];
        }
    }

    /**
     * Write the given data to the given key in memcache
     *
     * @param string $key   The key
     * @param string $value The value
     *
     * @access public
     * @return void
     */
    public function writeToMemcache($key, $value)
    {
        if (!$this->_memcache) {
            $this->_memcache = $this->get('g4_persister_memcache');
        }
        $this->_memcache->set($key, $value);

        $dispatcher = $this->container->get('event_dispatcher');
        $dispatcher->dispatch('utilbundle.memcachewrite', new MemcacheEvent($key, $value, get_class($this)));
    }

    /**
     * Dispatch an event
     *
     * A wrapper for get->dispatcher->dispatch
     *
     * @param string                             $name  The type of event to be logged
     * @param \G4\UtilBundle\Events\LoggingEvent $event The logging event instance that we are going to log
     *
     * @access public
     * @return void
     */
    public function dispatch($name, LoggingEvent $event)
    {
        $dispatcher = $this->container->get('event_dispatcher');
        $event->setClass(get_class($this));
        $dispatcher->dispatch($name, $event);
    }

    /**
     * readFromMemcache
     *
     * @param string $key The key
     *
     * @access public
     * @return string The value
     */
    public function readFromMemcache($key)
    {
        if (!$this->_memcache) {
            $this->_memcache = $this->get('g4_persister_memcache');
        }
        $value = $this->_memcache->get($key);

        $dispatcher = $this->container->get('event_dispatcher');
        $dispatcher->dispatch('utilbundle.memcacheread', new MemcacheEvent($key, $value, get_class($this)));

        return $value;
    }

    /**
     * Clear key from memcache
     *
     * @param string $key the key to be cleaned
     *
     * @return void
     *
     * @access public
     */
    public function deleteFromMemcache($key)
    {
        if (!$this->_memcache) {
            $this->_memcache = $this->get('g4_persister_memcache');
        }
        $this->_memcache->delete($key);
    }


    /**
     * Persist decoded json response
     * @param string                              $key           key
     * @param array|stdClass                      $object        object to be stored
     * @param \G4\UtilBundle\Entity\ServiceParams $serviceParams request data information
     *
     * @return void
     */
    public function persistReswebResponse($key, $object, $serviceParams)
    {
        if ($serviceParams->getFetchAdditional() == true) {
            $object = $this->appendToPersistedReswebResponse($key, $decodedData = json_decode(json_encode($object)), $serviceParams);
        }

        $persisterUrl = sprintf(
            '%s/%s/%s/%s.%s',
            $this->container->getParameter('g4_persisterservice_url'),
            $key,
            'resweb',
            'response',
            'json'
        );
        $persistTimeout = $this->container->getParameter('g4_timeout_persister');
        $commKey = 'persisting';
        $dataForSaving = json_encode($object);

        $persist = new \G4\UtilBundle\ServicesCall();
        $persist->addPost(
            $persisterUrl,
            $persistTimeout,
            array('Content-Type: application/json'),
            $dataForSaving,
            $commKey
        );
        $result = $persist->execute();

        $success = (isset($result[$commKey]['success'])) ? (bool)$result[$commKey]['success'] : false;

        if ($success) {
            $this->dispatch('logger.debug', new MessageLoggingEvent($this->getManifestID(), sprintf('PERSISTER key %s set with %s-length of data', $key, number_format(strlen($dataForSaving)))));
        } else {
            // TODO Should this be an error
            $this->dispatch('logger.warn', new MessageLoggingEvent($this->getManifestID(), sprintf('PERSISTER *failed* to set key %s with %s-length of data', $key, number_format(strlen($dataForSaving)))));
        }
    }

    /**
     * persist resweb response for future use
     *
     * @param string                              $key           persister key
     * @param \stdClass                           $data          persister data
     * @param \G4\UtilBundle\Entity\ServiceParams $serviceParams params
     *
     * @return void
     */
    public function appendToPersistedReswebResponse($key, \stdClass $data, \G4\UtilBundle\Entity\ServiceParams $serviceParams)
    {
    }

    /**
     * Retrieve resweb results from persister
     *
     * - in the application the function will only receive one parameter : $key. The other 3 parameters are being
     * used only for the recursive calls : iteration is being incremented at each call while maxtries and sleep is
     * being fetched from the configuration parameters and then passed along to the next calls.
     *
     * @param string $key              persister key
     * @param int    $iteration        Current Iteration number
     * @param int    $memcacheMaxtries Maximum number of tries we should read from memcache is the key is not found
     * @param int    $memcacheSleep    The number of seconds we will sleep between memcache requests
     *
     * @throws \G4\UtilBundle\Exception\JsonDecodeException
     * @return object
     */
    public function getPersistedReswebResponse($key, $iteration = 0, $memcacheMaxtries = null, $memcacheSleep = null)
    {
        $persisterUrl = sprintf(
            '%s/%s/%s/%s.%s',
            $this->container->getParameter('g4_persisterservice_url'),
            $key,
            'resweb',
            'response',
            'json'
        );

        $persistKey = 'resweb_response';
        $persistTimeout = $this->container->getParameter('g4_timeout_persister');
        $persist = new \G4\UtilBundle\ServicesCall();
        $persist->addGet($persisterUrl, $persistTimeout, array('Content-Type: application/json'), $persistKey);
        $reswebResults = $persist->execute();
        $decoded = json_decode($reswebResults[$persistKey]);
//$this->get('logging')->err(sprintf('asdfasdf > looking for key %s', $key));
        if (is_null($decoded)) {

            if (!$memcacheMaxtries) {
                $memcacheMaxtries = $this->container->getParameter('g4_memcache_maxtries');
            }

            if (!$memcacheSleep) {
                $memcacheSleep = $this->container->getParameter('g4_memcache_sleep');
            }

            if ($iteration <= $memcacheMaxtries) {
                sleep($memcacheSleep);

                return $this->getPersistedReswebResponse($key, $iteration + 1, $memcacheMaxtries, $memcacheSleep);
            } else {
                throw new JsonDecodeException(sprintf('Unable to decode resweb results for key %s: %s', $key, print_r($reswebResults, true)));
            }
        }

        return ($decoded);
    }

    /**
     * TODO extract this functionality in the g4_logging service
     */
    public function preAction()
    {
    }

    /**
     * Audit info required in every web service call.  Also known as UserProfile.
     *
     * @param string $sessionID The session ID used between requests
     * @param string $ipAddress The IP Address of the client visiting the site.
     *
     * @access public
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile
     * @throws \G4\UtilBundle\Exception\ContainerNotInitializedException
     * @throws \RuntimeException
     */

    public function getCallerInfo($sessionID = '', $ipAddress = '', $requestSource = '')
    {
        /** @var $g4Container \G4\UtilBundle\Services\G4Container */
        $g4Container = $this->get('g4_container');

        $callerInfo = new AreCommon\UserProfile();

        // name is the system user
        $callerInfo->setName($this->container->getParameter('g4_service_caller_info_name'));

        // pwd is unused, ignore
        $callerInfo->setPwd($this->container->getParameter('g4_service_caller_info_pwd'));

        // appName is the calling class
        $callerInfo->setAppName(get_class($this));

        // moduleName is service type - just the silo name: specific request from John Faircloth
        $callerInfo->setModuleName(sprintf(
            "%s", $this->container->getParameter('g4_silo')
        ));

        // sessionID of the customer
        if (!strlen($sessionID)) {
            $sessionID = 'PRD_OO1';
            $this->dispatch('logger.warn', new MessageLoggingEvent($g4Container->getManifestId(), sprintf('%s() called without sessionID in %s', __METHOD__, get_class($this))));
        }
        $callerInfo->setSessionID($sessionID);

        //set the ip address
        if (!strlen($ipAddress)) {
            $ipAddress = '0.0.0.0';
            $this->dispatch('logger.warn', new MessageLoggingEvent($g4Container->getManifestId(), sprintf('%s() called without ipAddress is %s', __METHOD__, get_class($this))));
        }
        $callerInfo->setIpAddress($ipAddress);

        /**
         * fetch the requestSourceId. if there is no result,
         * log a warning and continue with the booking process.
         */
        if ($requestSource) {
            try {
                $requestSourceId = $this->get('g4_lookup')->lookupRequestSourceID($requestSource);
                $callerInfo->setRequestSourceId($requestSourceId);
            } catch (BookingProcessException $e) {
                $this->dispatch(
                    'logger.warn',
                    new MessageLoggingEvent(
                        $this->getManifestID(),
                        sprintf('requestSource "%s" provided, but not found on lookup! booking will not be interupted. ', $requestSource),
                        'default',
                        array(),
                        $e->getData()
                    )
                );
            }
        }

        return ($callerInfo);
    }


    /**
     * Common variables required in every web service call.
     *
     * @param array $putData The data inside PUT body request
     *
     * @access public
     * @return void
     * @throws \RuntimeException
     */
    public function setPayloadAttributes($putData)
    {
        if (is_array($putData)) {
            $putData = (object)$putData;
        }

        $payloadAttributes = new AreCommon\PayLoadAttributes();

        $payloadAttributes->setBookingChannelID($this->get('g4_container')->getBookingChannelID());

        // transactionIdentifier is an optional pass-through value
        if (isset($putData->transactionIdentifier)) {
            $payloadAttributes->setTransactionIdentifier($putData->transactionIdentifier);
        }

        // bookingTypeID indicates if this is flight, flight+hotel, etc.
        if (isset($putData->bookingTypeID) && is_numeric($putData->bookingTypeID)) {
            $payloadAttributes->setBookingTypeID($putData->bookingTypeID); // seatmap requests will already know bookingTypeID
        } else {
            if (isset($putData->product['components'])) {
                $availableKeys = "";
                foreach ($putData->product['components'] as $key => $value) {
                    if ((isset($value)) && ($value['mode'] == "sell")) {
                        $availableKeys .= $key;
                    }
                }
                $bookingTypeID = $this->container->get('g4_lookup')->lookupBookingTypeID($availableKeys);
                $payloadAttributes->setBookingTypeID($bookingTypeID);
            } else {
                $payloadAttributes->setBookingTypeID(null);
            }
        }

        // Our version ID
        $payloadAttributes->setVersion($this->container->getParameter('g4_service_payload_attributes_version'));

        // Simple timestamp
        $payloadAttributes->setTimeStamp(date('Y-m-d\TH:i:s'));

        $this->payloadAttributes = $payloadAttributes;
    }

    /**
     * Calculate the payload attributes
     *
     * @param string $transactionIdentifier
     * @param array  $components
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes
     */
    public function preparePayloadAttributes($transactionIdentifier, $components)
    {

        $availableKeys = '';
        foreach ($components as $key => $value) {
            if ((isset($value)) && ($value['mode'] == 'sell')) {
                $availableKeys .= $key;
            }
        }
        $bookingTypeID = $this->container->get('g4_lookup')->lookupBookingTypeID($availableKeys);

        return $this->preparePayloadAttributesByBookingType($transactionIdentifier, $bookingTypeID);
    }

    public function preparePayloadAttributesByBookingType($transactionIdentifier, $bookingTypeID)
    {
        $payloadAttributes = new AreCommon\PayLoadAttributes();

        // bookingChannelID identifies the front-end website
        $payloadAttributes->setBookingChannelID($this->get('g4_container')->getBookingChannelID());

        // transactionIdentifier is an optional pass-through value
        $payloadAttributes->setTransactionIdentifier($transactionIdentifier);

        // bookingTypeID indicates if this is flight, flight+hotel, etc.
        $payloadAttributes->setBookingTypeID($bookingTypeID);

        // Our version ID
        $payloadAttributes->setVersion($this->container->getParameter('g4_service_payload_attributes_version'));

        // Simple timestamp
        $payloadAttributes->setTimeStamp(date('Y-m-d\TH:i:s'));

        return ($payloadAttributes);
    }

    /**
     * Common variables required in every web service call.
     *
     * @access public
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes|AreCommon\PayLoadAttributes|null
     */
    public function getPayloadAttributes()
    {
        if (!isset($this->payloadAttributes)) {
            throw new \RuntimeException("No payload attributes found.", 500);
        }

        return $this->payloadAttributes;
    }

    /**
     * Detect if we are running in a web environment, in which case we need to send specific headers.
     *
     * @return bool true if running in a web environment
     */
    public function isWebEnvironment()
    {
        return ('test' != $this->container->get('kernel')->getEnvironment());
    }

    /**
     * Perform call to resweb endpoint at $url sending data from $json and wait for $timeout
     *
     * @param string  $url        Resweb endpoint
     * @param string  $json       Data to send to resweb, in minified json string format.
     * @param string  $manifestId Booking process hash.
     * @param integer $timeout    Number of seconds to wait for a response from resweb.
     *
     * @return string
     * @throws ReswebBookCartTimeoutException
     */
    public function callReswebRemotely($url, $json, $manifestId, $timeout)
    {
        //here we generate the pairKey. this key is used to identify response for each request, and it's unique per request/response pair
        $pairKey = md5($manifestId . microtime(true));

        $service = $this->container->get('g4_services_call');
        $serviceKey = 'reswebCall';
        $service->addPost(
            $url,
            $timeout,
            array('Content-Type: application/json'),
            $json,
            $serviceKey
        );


        // $this->get('g4_logging')->fileLog($json, 'Data sent to resweb', $this->_logToFiles);
        $this->dispatch('logger.debug', new MessageLoggingEvent(
            $manifestId,
            sprintf('SERVICE > Access rest service'),
            'default',
            array(
                'url' => $url,
            ),
            $json
        ));

        $this->get('event_dispatcher')->dispatch('utilbundle.reswebrequest', new ReswebCallEvent($manifestId, $json, get_class($this), $url, $pairKey, 0));

        $time = microtime(true);
        $results = $service->execute();
        $executionTime = microtime(true) - $time;

        $this->get('event_dispatcher')->dispatch('utilbundle.executiontime', new \G4\UtilBundle\Events\Stat\ReswebStatEvent($manifestId, $url, $pairKey, $executionTime));

        //if the execution time is over a certain limit we should log an error.
        //This is done directly through the logger.error so we can have it in prod.
        $overtime = $this->container->getParameter('g4_overtime_default');

        if ($url == $this->container->getParameter('g4_search_service_cart_book')) {
            $overtime = $this->container->getParameter('g4_overtime_bookcart');
        }

        if ($executionTime > $overtime) {
            //we need to log this one
            $data = array(
                'url' => $url,
                'executionTime' => $executionTime,
                'overtimeLimit' => $overtime,
                'pairKey' => $pairKey,
            );
            $event = new \G4\UtilBundle\Events\MessageLoggingEvent($manifestId, "Resweb " . $url . " took more than " . $overtime . " seconds (actual: " . $executionTime . ")", 'default', $data);
            $event->setClass(get_class($this));
            $this->get('event_dispatcher')->dispatch("logger.error", $event);
        }

        $infoArr = $service->getInfoNo($serviceKey);

        if (is_null($results[$serviceKey])) {
            $totalTime = $infoArr['total_time'];
            if ($totalTime < 5) {
                //if total time is less then 5 seconds then it was a connection refused
                $exMsg = sprintf('Connection refused by resweb');
            } else {
                //if total time is higher, then it's a timeout
                $exMsg = sprintf('Resweb has timed out after %s seconds.', $timeout);
            }

            $this->get('event_dispatcher')->dispatch('utilbundle.reswebresponse', new ReswebCallEvent($manifestId, json_encode($exMsg), get_class($this), $url, $pairKey, 0, $infoArr));
            throw new ReswebTimeoutException($exMsg, $url, $json, $serviceKey, $manifestId, \G4\UtilBundle\ErrorMapper::SERVICES_TIMEOUT);
        }


        $this->get('event_dispatcher')->dispatch('utilbundle.reswebresponse', new ReswebCallEvent($manifestId, $results[$serviceKey], get_class($this), $url, $pairKey, $infoArr['http_code'], $infoArr));

        $serviceResponse = json_decode($results[$serviceKey], true);

        if (is_null($serviceResponse)) {
            $exMsg = 'Resweb sent undecodeable data (malformed json)';
            throw new ReswebJsonDecodeException($exMsg, $url, $json, $serviceKey, $manifestId, \G4\UtilBundle\ErrorMapper::SERVICES_TIMEOUT);
        }

        // TODO handle case when the content is not valid json
        //      might be 404 html for example
        if (!is_array($serviceResponse)) {
            throw new \G4\UtilBundle\Exception\BadResWebException($service, $results[$serviceKey], 'KEY');
        }

        return ($serviceResponse);
    }


    /**
     * Appends a memcache key for these parameters
     * @param \G4\ShoppingCartBundle\Entity\CartRequest $data Json data
     *
     * @return string
     */
    public function memcacheKeyPrefix(\G4\ShoppingCartBundle\Entity\CartRequest $data)
    {
        return;
    }

    /**
     * Set the manifest ID of the current operation
     *
     * @param string $manifestID
     *
     * @return void
     */
    public function setManifestID($manifestID)
    {
        $this->manifestID = $manifestID;
    }

    /**
     * Retrieve the manifest ID of the current operation
     *
     * @return string
     */
    public function getManifestID()
    {
        return $this->manifestID;
    }
}
