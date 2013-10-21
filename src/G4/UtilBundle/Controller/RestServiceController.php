<?php

namespace G4\UtilBundle\Controller;

use G4\UtilBundle\ServicesCall;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use G4\UtilBundle\Exception\ConnectionException;
use G4\UtilBundle\Exception\G4Exception;
use G4\UtilBundle\Exception\JsonDecodeException;
use G4\UtilBundle\Exception\ReswebTimeoutException;

/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Controller
 */

/**
 * RestServiceController
 */
abstract class RestServiceController extends G4Controller
{
    const HTTP_GET    = 'GET';
    const HTTP_POST   = 'POST';
    const HTTP_PUT    = 'PUT';
    const HTTP_DELETE = 'DELETE';

    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_NO_CONTENT = 204;
    const CODE_UNAUTHORIZED = 401;
    const CODE_NOT_FOUND = 404;
    const CODE_CONFLICT = 409;
    const CODE_SERVER_ERROR = 500;

    /**
     * Execute a service call
     *
     * @param string $method HTTP method ('GET', 'POST', 'PUT', 'DELETE')
     *
     * @return Response
     */
    public function call($method)
    {
        $this->validateInputs();

        $service = $this->getServicesCall();

        $url = $this->getServiceUrl();
        $timeout = $this->getTimeout();
        $headers = $this->getServiceHeaders();
        $content = json_encode($this->getInputs());
        $key = 'RestServiceCall';

        switch ($method) {
            case self::HTTP_GET:
                $service->addGet($url, $timeout, $headers, $key);
                break;
            case self::HTTP_POST:
                $service->addPost($url, $timeout, $headers, $content, $key);
                break;
            case self::HTTP_PUT:
                $service->addPut($url, $timeout, $headers, $content, $key);
                break;
            case self::HTTP_DELETE:
                $service->addDelete($url, $timeout, $headers, $key);
                break;
            default:
                throw new \RuntimeException("Unsupported HTTP method: '$method'");
        }

        return $this->executeServicesCall($service, $key);
    }


    /**
     * Return input paramters.
     *
     * NOTE: Concrete methods in this class depend upon this method returning an
     * object!  While you can use a plain \stdClass object, I strongly reccomend
     * using an entity similar to {@link G4\FlightAlertsBundle\Entity\Subscription}
     *
     * @abstract
     *
     * @return \stdClass input entity
     */
    public abstract function getInputs();


    /**
     * Will be called before a service call is executed, to validate the
     * inputs being sent to the web service.
     *
     * @abstract
     */
    public abstract function validateInputs();


    /**
     * Returns instance of g4_services_call
     *
     * @return G4\UtilBundle\ServicesCall
     *
     */
    public function getServicesCall()
    {
        $service = $this->get('g4_services_call');

        return $service;
    }


    /**
     * Get the web service URL and perform any variable substitution required.
     *
     * @return String
     *
     * @throws G4Exception
     */
    public function getServiceUrl()
    {
        $service = 'g4_service_' . $this->getType();
        $url = $this->container->getParameter($service);

        $inputs = $this->getInputs();

        foreach ($inputs as $key => $value) {
            $keyToReplace = sprintf('{%s:optional}', $key);
            $url = str_replace($keyToReplace, $value, $url);

            $keyToReplace = sprintf('{%s}', $key);
            $url = str_replace($keyToReplace, $value, $url);
        }

        // remove any optional url segments that were not provided
        $url = preg_replace("/\{.+?:optional\}/", '', $url);

        if (strpos($url, '{') !== false || strpos($url, '}') !== false) {
            throw new G4Exception("Missing URL Inputs", $this->getType());
        }

        return $url;
    }


    /**
     * Returns the name of the service call to correctly get the web service
     * enpoint from getServiceUrl
     *
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
     * Get an array of HTTP headers for use with curl.
     *
     * @return multitype:string
     */
    public function getServiceHeaders()
    {
        return array('Content-Type: application/json');
    }


    /**
     * Executes the services call, process the result for the given key,
     * and return a response formated from postProcessResults
     *
     * @param ServicesCall $service The Services Call
     * @param String       $key     Key used in servicesCall
     *
     * @return Response
     */
    public function executeServicesCall(ServicesCall $service, $key)
    {
        $serviceResults = $service->execute();
        $infoArr = $service->getInfoNo($key);

        $this->verifyHttpCode($infoArr, reset($serviceResults));

        $result = $serviceResults[$key];

        if (is_null($result)) {
            // a successful POST/PUT might not return any content
            $result = array('http_code' => $infoArr['http_code']);
        } else {
            $result = $this->decodeResult($result);
            $this->checkResultFormat($result);
        }

        $response = $this->postProcessResults($result);

        return new Response($response);
    }


    /**
     * Checks HTTP code and throws appropriate Exception if necessary.
     *
     * @param array  $infoArr             infoArr recieved from servicesCall
     * @param string $reswebStringResults error message
     *
     * @return G4Exception
     */
    public function verifyHttpCode(array $infoArr, $reswebStringResults)
    {
        if (!isset($infoArr['http_code'])) {
            throw new \G4\UtilBundle\Exception\RestfulException(
                $reswebStringResults,
                new ConnectionException()
            );
        }

        $code = $infoArr['http_code'];

        if ($code < 200 or $code > 299) {
            throw $this->getException($code, $reswebStringResults);
        }
    }

    /**
     * Decodes result from services call
     *
     * @param String $result
     *
     * @return mixed
     *
     * @throws JsonDecodeException
     */
    public function decodeResult($result)
    {
        $serviceResult = json_decode($result, true);

        if (is_null($serviceResult)) {
            throw new JsonDecodeException("Can't decode response from service");
        }

        return $serviceResult;
    }


    /**
     * Abstract function where child class will check the format of the result
     * recieved from servicesCall
     *
     * @param array $result Result from servicesCall
     */
    public abstract function checkResultFormat(array $result);


    /**
     * Post-process the result before returning the Response.
     * Override in child services for proper implementation.
     *
     * @param array $result result from web service
     *
     * @return string
    */
    public function postProcessResults(array $result)
    {
        if (count($result) == 1 && array_key_exists('http_code', $result)) {
            // a successful POST/PUT might not return any content
            $result = $result['http_code'];
        }

        $response = json_encode($result);

        return $response;
    }


    /**
     * Takes an HTTP Code from services call and generates the correct
     * Exception
     *
     * @param int    $httpCode            The HTTP Code
     * @param string $reswebStringResults error message
     *
     * @return Exception
     */
    public function getException($httpCode, $reswebStringResults)
    {
        switch ($httpCode) {
            case 404:
                return new NotFoundHttpException();

            case 0:
                return new G4Exception(sprintf('Unable able to connect to %s', $this->getServiceUrl()), $this->getType());

            default:
                return new \G4\UtilBundle\Exception\RestfulException($reswebStringResults, $httpCode);
        }
    }
}
