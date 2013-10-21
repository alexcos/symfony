<?php

/**
 * Allegiant G4 utility package.
 *
 * @category  Allegiant
 * @package   G4.FlightBundle.Controller
 */
namespace G4\UtilBundle;

use G4\AREBundle\Entity\com\allegiant\are\dto\lookup\LookupInput;
use Symfony\Component\DependencyInjection\ContainerAware;
use G4\UtilBundle\Exception\BookingProcessException;

/**
 * Provides methods to query the lookup service
 *
 * @author Dan Crowe <Daniel.Crowe@allegiantair.com>
 * @author Georgiana Gligor <georgiana@lolaent.com>
 */
class ReswebLookup extends ContainerAware
{

    /**
     * Given a booking code, get the bookingTypeID.
     *
     * @param string $booking Collection of letters that represent the items being booked.
     *
     * @throws Exception\BookingProcessException
     * @return integer bookingTypeID
     */
    public function lookupBookingTypeID($booking)
    {
        $filename = self::getBookingTypeFilename($booking);
        if (!$filename) {
            $response = new \stdClass;
            $response->error = array(
                array(
                    'level' => 'META',
                    'type' => 'Lookup',
                    'code' => ErrorMapper::WRONG_REQUEST,
                    'description' => 'Lookup does not know where to find bookingType for ' .$booking .'.',
                    'errorDateTime' => date('c'),
                ),
            );
            throw new BookingProcessException($response, 409);
        }

        $fetchUrl = $this->container->getParameter('meta_lookup_url') . '/BookingType/' . urlencode($filename);
        $results = json_decode(@file_get_contents($fetchUrl));

        if (!is_object($results) or !property_exists($results, 'id') or !is_int($results->id)) {
            $response = new \stdClass;
            $response->error = array(
                array(
                    'level' => 'META',
                    'type' => 'Lookup',
                    'code' => ErrorMapper::WRONG_REQUEST,
                    'description' => sprintf('Lookup could not find bookingTypeID for "%s" in "%s"', $booking, $fetchUrl),
                    'errorDateTime' => date('c'),
                ),
            );
            throw new BookingProcessException($response, 409);
        }

        return $results->id;
    }

    /**
     * Given a requestSource code, get the requestSourceID.
     *
     * @param string $requestSourceName Collection of letters that represent the items being booked.
     *
     * @throws Exception\BookingProcessException
     * @return string requestSourceId
     */
    public function lookupRequestSourceID($requestSourceName)
    {
        $fetchUrl = $this->container->getParameter('meta_lookup_url').'/RequestSource/' . urlencode($requestSourceName).".json";
        $results = json_decode(@file_get_contents($fetchUrl));

        if (!is_object($results) or !property_exists($results, 'id') or !is_int($results->id)) {
            $response = new \stdClass;
            $response->error = array(
                array(
                    'level' => 'META',
                    'type' => 'Lookup',
                    'code' => ErrorMapper::WRONG_REQUEST,
                    'description' => sprintf('Lookup could not find requestSourceID for "%s" in "%s"', $requestSourceName, $fetchUrl),
                    'errorDateTime' => date('c'),
                ),
            );
            throw new BookingProcessException($response, 409);
        }

        return $results->id;
    }

    /**
     * Given two airport codes, get the marketID (ex: 70)
     *
     * @param string $code1 airport code
     * @param string $code2 airport code
     *
     * @throws \RuntimeException
     * @return integer marketID
     */
    public function lookupMarketID($code1, $code2)
    {
        $results = $this->lookupMarketDetails($code1, $code2);

        return $results->id;
    }

    /**
     * Given two airport codes, get the market details (full docket)
     *
     * @param string $code1 airport code
     * @param string $code2 airport code
     *
     * @throws Exception\BookingProcessException
     * @return \stdClass json-decoded instance of the given market details
     */
    public function lookupMarketDetails($code1, $code2)
    {
        $marketCode = $this->getMarketCodeNotAlphabetised($code1, $code2);
        $fetchUrl = $this->container->getParameter('meta_lookup_url') . '/Market/' . $marketCode . '.json';
        $results = json_decode(@file_get_contents($fetchUrl));

        if (!is_object($results) or !property_exists($results, 'id') or !is_int($results->id)) {
            $response = new \stdClass;
            $response->error = array(
                array(
                    'level' => 'META',
                    'type' => 'Lookup',
                    'code' => ErrorMapper::WRONG_REQUEST,
                    'description' => sprintf('Lookup could not find market details for `%s` when searching under `%s`.', $marketCode, $fetchUrl),
                    'errorDateTime' => date('c'),
                ),
            );
            throw new BookingProcessException($response, 409);
        }

        return $results;
    }

    /**
     * Given two airport codes, get the marketCode (ex: "BLILAS")
     *
     * @param string $code1 airport code
     * @param string $code2 airport code
     *
     * @return string marketCode
     * @static
     *
     * @todo remove this in future, if not needed
     */
    public static function getMarketCode($code1, $code2)
    {
        // alphabetize the airport codes
        if (strcmp($code1, $code2) < 0) {
            $marketCode = $code1 . $code2;
        } else {
            $marketCode = $code2 . $code1;
        }

        return strtoupper($marketCode);
    }

    /**
     * Given two airport codes, get the marketCode (ex: "BLILAS" or "LASBLI"), not alphabetised
     *
     * @param string $code1 airport code
     * @param string $code2 airport code
     *
     * @return string marketCode
     */
    private function getMarketCodeNotAlphabetised($code1, $code2)
    {
        return strtoupper($code1 . $code2);
    }

    /**
     * Get the filename associated with this booking combination.
     *
     * @param string $booking Collection of letters that represent the items being booked.
     *
     * @return string filename
     * @static
     * @access private
     */
    private static function getBookingTypeFilename($booking)
    {
        // This is so silly
        $map = array(
            'F' => 'Flight%20Only.json',
            'H' => 'Hotel%20Only.json',
            'P' => 'Product%20Only.json',
            'V' => 'Vehicle%20Only.json',
        );
        if (array_key_exists($booking, $map)) {
            return $map[$booking];
        }

        // packages
        if ((strpos($booking, 'F')) !== false) {
            return 'Package%20With%20Flight.json';
        }

        return 'Package%20Land%20Only.json';
    }

    /**
     * Obtains payment type ID knowing its name
     *
     * @param string  $typeName       Type name
     * @param string  $lookupUrl      Location of the lookup cache.
     * @param integer $serviceTimeout How many seconds should we wait for docket data?
     *
     * @return integer
     *
     * @todo refactor this static approach, it has multiple disadvantages:
     *      - static methods are as close to procedural programming as one can get, http://ak33m.com/?p=169
     *      - it is not allowing the method to get the $lookupUrl itself, we must manually provide it every time
     */
    public static function paymentTypeIDByName($typeName, $lookupUrl, $serviceTimeout)
    {
        $c = new ServicesCall();
        $c->addGet(
            sprintf('%s/%s.json', $lookupUrl, strtoupper($typeName)),
            $serviceTimeout,
            array('Content-Type: application/json'),
            $typeName
        );
        $results = $c->execute();
        if (isset($results[$typeName])) {
            $paymentType = json_decode($results[$typeName]);
            if (is_object($paymentType) && is_numeric($paymentType->id) && $paymentType->id > 0) {
                return ((int) $paymentType->id);
            }
        }

        $response = new \stdClass;
        $response->error = array(
            array(
                'level' => 'META',
                'type' => 'Lookup',
                'code' => ErrorMapper::WRONG_REQUEST,
                'description' => sprintf('Lookup could not find paymentTypeID (in TypeIdByName) for `%s` when searching under `%s`. - %s', $typeName, $lookupUrl, print_r($results, true)),
                'errorDateTime' => date('c'),
            ),
        );
        throw new BookingProcessException($response, 409);


    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws Exception\BookingProcessException
     */
    public function getPaymentTypeById($id)
    {
        $lookupUrl = $this->container->getParameter('g4_docketservice_paymenttype_url');
        $serviceTimeout = $this->container->getParameter('g4_timeout_docket');

        $paymentUrl = sprintf('%s/%s.json', $lookupUrl, intval($id));

        $typeName = 'payment';
            $c = new ServicesCall();
            $c->addGet(
                $paymentUrl,
                $serviceTimeout,
                array('Content-Type: application/json'),
                $typeName
            );
            $results = $c->execute();
            if (isset($results[$typeName])) {
                $paymentType = json_decode($results[$typeName]);
                if (is_object($paymentType) && is_numeric($paymentType->id) && $paymentType->id > 0) {
                    return ($paymentType);
                }
            }

            $curlInfo = $c->getInfoNo($typeName);
            $response = new \stdClass;
            $response->error = array(
                array(
                    'level' => 'META',
                    'type' => 'Lookup',
                    'code' => ErrorMapper::WRONG_REQUEST,
                    'description' => sprintf('Lookup could not find paymentTypeID (in TypeById) for `%s` when searching under `%s`. - %s', $id, $paymentUrl, print_r($curlInfo, true)),
                    'errorDateTime' => date('c'),
                ),
            );
            throw new BookingProcessException($response, 409);
    }

    /**
     * Fetch the booking channel ID based on role
     *
     * @param $role
     *
     * @return int
     *
     * @throws Exception\BookingProcessException
     */
    public function getBookingChannelIdByRole($role)
    {
        switch (strtolower($role)) {
            case 'cc':
                $filename = 'Call%20Center.json';
                break;
            case 'ta':
                $filename = 'Travel%20Agent.json';
                break;
            default:
                $filename = 'Web.json';
                break;
        }

        $fetchUrl = $this->container->getParameter('meta_lookup_url') . '/Channel/' . urlencode($filename);
        $results = json_decode(@file_get_contents($fetchUrl));

        if (isset($results->id)) {
            return $results->id;
        }

        $response = new \stdClass;
        $response->error = array(
            array(
                'level' => 'META',
                'type' => 'Lookup',
                'code' => ErrorMapper::WRONG_REQUEST,
                'description' => sprintf('Lookup could not find ChannelId for `%s` role when searching under `%s`', $role, $fetchUrl),
                'errorDateTime' => date('c'),
            ),
        );
        throw new BookingProcessException($response, 409);
    }


    public function loadData($lookupName, $url)
    {
        $url = $this->container->getParameter('meta_lookup_url');

        $lookupInput = new LookupInput();
        $lookupInput->setLookupName(array($lookupName));
       // $lookupInput->setPayloadAttributes()
    }
}
