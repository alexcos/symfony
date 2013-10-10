<?php

namespace G4\UtilBundle\Controller;

use G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes;
use G4\AREBundle\Entity\com\allegiant\are\dto\lookup\LookupInput;
use G4\UtilBundle\Entity\Lookup\Market;
use G4\UtilBundle\Services\Persister\Memcache;
use G4\UtilBundle\Services\Persister\Persister;
use G4\UtilBundle\ServicesCall;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class LookupController
 *
 * @package G4\UtilBundle\Controller
 */
class LookupController extends G4Controller
{
     /**
     * @param string $lookupName
     * @param string $key
     *
     * @return Response
     */
    public function getLookupAction($lookupName, $key)
    {
        $response = $this->getLookup($key, $lookupName);

        return new Response($response);
    }

    public function getOtaLookupAction($lookupName, $key)
    {
        $response = $this->getOtaLookup($lookupName, $key);

        return new Response($response);
    }

    /**
     * @param string $key
     *
     * @return Response
     */
    public function getLookupMarketAction($key)
    {
        $base = 'meta/resweb/Market';
        $memcacheKey = $base .'/'. $key . '.json';
        $persister = $this->get('g4_persister_memcache');
        $value = $this->readFromMemcache($memcacheKey);

        if ($this->isInProgress($value)) {
            $value = $this->pollFromMemcache($memcacheKey);
        }

        if (!$value || is_numeric($value)) {
            $this->flagAsInProgress($memcacheKey);
            $marketsData = $this->loadData('Market');
            foreach ($marketsData as $marketData) {
                $from = substr($marketData['name'], 0, 3);
                $to = substr($marketData['name'], 3, 3);
                if ($key == $from.$to || $key == $to.$from || $key==$marketData['id']) {
                    $this->loadAndCacheMarkets($base, $marketData, $persister);
                }
            }

            $value = $this->readFromMemcache($memcacheKey);
            if (is_numeric($value)) {
                $this->writeToMemcache($memcacheKey, '');
                return new Response('', 404);
            }
        }

        return new Response($value);
    }

    /**
     * @param $lookupName
     *
     * @return mixed
     */
    public function loadOtaData($lookupName)
    {
        $url = $this->container->getParameter('g4_service_customers_lookup').'/'. $lookupName;
        $servicesCall = $this->get('g4_services_call');
        $timeout = $this->container->getParameter('g4_timeout_reswebdefault');
        $servicesCall->addGet($url, $timeout, array('Content-Type: application/json'), 0);
        $dataJson = $servicesCall->execute();
        $data = json_decode($dataJson[0]);

        return $data;
    }

    /**
     * @param string $lookupName
     * @param string $url
     *
     * @return null
     */
    public function loadData($lookupName)
    {
        $url = $this->container->getParameter('g4_search_service_lookup');

        $lookupInput = new LookupInput();
        $lookupInput->setLookupName(array($lookupName));
        $lookupInput->setPayloadAttributes(
            $this->getDefaultPayloadAttributes(
                $this->get('g4_container')->getTransactionId()
            )
        );
        $lookupInput->setCallerInfo($this->getCallerInfo());

        $response = $this->callReswebRemotely(
            $url,
            json_encode($lookupInput),
            $this->get('g4_container')->getManifestId(),
            $this->container->getParameter('g4_timeout_reswebdefault')
        );

        $lookups = $response['lookup'];
        foreach ($lookups as $lookup) {
            if ($lookup['name']) {
                return $lookup['item'];
            }
        }

        return null;
    }

    /**
     * @param string $lookupName name of the lookup, e.g. Country, Gender
     * @param string $key Lookup key, e.g. us. This can be null because we may want the whole list
     *
     * @return string
     */
    public function getOtaLookup($lookupName, $key = null)
    {
        $base = 'meta/ota/' . $lookupName;

        if ($key) {
            $memcacheKey = $base .'/'. $key . '.json';
        } else {
            $memcacheKey = $base . '.json';
        }

        $persister = $this->get('g4_persister_memcache');
        $value = $persister->get($memcacheKey);

        if ($this->isInProgress($value)) {
            $value = $this->pollFromMemcache($memcacheKey);
        }

        if (!$value || is_numeric($value)) {
            $value = $this->loadAndCacheOtaData($lookupName, $base, $memcacheKey);
            if (is_numeric($value)) {
                $this->writeToMemcache($memcacheKey, '');
                $value = '';
            }
        }

        return $value;
    }

    /**
     * @param $key
     * @param $lookupName
     *
     * @return string
     */
    public function getLookup($key, $lookupName)
    {
        $base = 'meta/resweb/' . $lookupName;
        $memcacheKey = $base .'/'. $key . '.json';
        $persister = $this->get('g4_persister_memcache');
        $value = $persister->get($memcacheKey);

        if ($this->isInProgress($value)) {
            $value = $this->pollFromMemcache($memcacheKey);
        }

        if (!$value || is_numeric($value)) {
            $value = $this->loadAndCacheLookupData($lookupName, $base, $memcacheKey);
            if (is_numeric($value)) {
                $this->writeToMemcache($memcacheKey, '');
                $value = '';
            }
        }

        return $value;
    }

    /**
     * @param $lookupName
     * @param $base
     * @param Persister $persister
     * @param $memcacheKey
     * @return mixed
     */
    public function loadAndCacheLookupData($lookupName, $base, $memcacheKey)
    {
        $bookingTypes = $this->loadData($lookupName);
        foreach ($bookingTypes as $bookingType) {
            $idKey = $base .'/'. $bookingType['id'] . '.json';
            $nameKey = $base .'/'. $bookingType['name'] . '.json';
            $this->writeToMemcache($idKey, json_encode($bookingType));
            $this->writeToMemcache($nameKey, json_encode($bookingType));
        }

        $value = $this->readFromMemcache($memcacheKey);

        return $value;
    }

    /**
     * @param string $lookupName  Name of the lookup
     * @param string $base        Base url of the lookup
     * @param string $memcacheKey persister key
     *
     * @return mixed
     */
    public function loadAndCacheOtaData($lookupName, $base, $memcacheKey)
    {
        $lookups = $this->loadOtaData($lookupName);
        $accesor = PropertyAccess::createPropertyAccessor();

        //cache the whole data
        $this->writeToMemcache($base.'.json', json_encode($lookups));
        foreach ($lookups as $lookup) {
            try {
                if (!is_object($lookup)) {
                    continue;
                }
                $idKey = $base .'/'. $accesor->getValue($lookup, 'id') . '.json';
                $nameKey = $base .'/'. $accesor->getValue($lookup, 'name') . '.json';
                $this->writeToMemcache($idKey, json_encode($lookup));
                $this->writeToMemcache($nameKey, json_encode($lookup));
            } catch (NoSuchPropertyException $e) {
                //log lookup error here
            }
        }
        $value = $this->readFromMemcache($memcacheKey);

        return $value;
    }

    /**
     * @param $docket
     * @param $code
     */
    public function buildAirport($docket, $airportData)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $airport = new Market\Airport();
        $airport->setCity($accessor->getValue($docket, '[city]'));
        $airport->setState($accessor->getValue($docket, '[state]'));
        $airport->setCountry($accessor->getValue($docket, '[country]'));
        $airport->setLat($accessor->getValue($docket, '[field_lat]'));
        $airport->setLocationId($accessor->getValue($airportData, '[id]'));
        $airport->setDisplayName($accessor->getValue($docket, '[g4_airport_display_name]'));
        $airport->setAirportCode($accessor->getValue($docket, '[field_airport_code]'));
        $airport->setLong($accessor->getValue($docket, '[field_lon]'));
        $airport->setTimeZone($accessor->getValue($docket, '[field_time_zone]'));
        $airport->setTitle($accessor->getValue($docket, '[title]'));

        return $airport;
    }

    /**
     * @param $market
     * @param $from
     * @param $to
     * @param $fromDocket
     * @param $toDocket
     *
     * @return \G4\UtilBundle\Entity\Lookup\Market
     */
    public function buildMarket($marketData, $from, $to, Market\Airport $fromAirport, Market\Airport $toAirport)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $validity = $this->parseValid($marketData['description']);
        $market = new Market();
        $market->setId($accessor->getValue($marketData, "[id]"));
        $market->setReswebid($accessor->getValue($marketData, "[id]"));
        $market->setName($from . $to);
        $market->setDescription($accessor->getValue($marketData, "[description]"));
        $market->setValidFrom($validity->getFrom());
        $market->setValidTo($validity->getTo());
        $market->setType('Market');
        $market->setFrom($fromAirport);
        $market->setTo($toAirport);

        return $market;
    }

    /**
     * @param $base
     * @param $marketData
     * @param $persister
     */
    public function loadAndCacheMarkets($base, $marketData)
    {
        $idKey = $base . '/' . $marketData['id'] . '.json';

        $from = substr($marketData['name'], 0, 3);
        $to = substr($marketData['name'], 3, 3);

        $docketsUrl = $this->container->getParameter('g4_meta');
        $airportUrl = $this->container->getParameter('g4_docketservice_airport_url');
        $fromAirport = json_decode(@file_get_contents($airportUrl . '/' . $from . '.json'), true);
        $toAirport = json_decode(@file_get_contents($airportUrl . '/' . $to . '.json'), true);

        $fromDocket = json_decode(@file_get_contents($docketsUrl . '/meta/artifacts/airports/' . $from . '.json'), true);
        $toDocket = json_decode(@file_get_contents($docketsUrl . '/meta/artifacts/airports/' . $to . '.json'), true);
        $fromAirport = $this->buildAirport($fromDocket, $fromAirport);
        $toAirport = $this->buildAirport($toDocket, $toAirport);

        if ($fromDocket && $toDocket) {
            $nameKey = $base . '/' . $from . $to . '.json';
            $market = $this->buildMarket($marketData, $from, $to, $fromAirport, $toAirport);
            $this->writeToMemcache($idKey, json_encode($market));
            $this->writeToMemcache($nameKey, json_encode($market));

            $nameKey = $base . '/' . $to . $from . '.json';
            $market = $this->buildMarket($marketData, $to, $from, $toAirport, $fromAirport);
            $this->writeToMemcache($nameKey, json_encode($market));
        }
    }

    /**
     * @param $key
     */
    public function flagAsInProgress($key)
    {
        $this->writeToMemcache($key, time());
    }

    /**
     * @param $key
     *
     * @return null|string
     */
    public function pollFromMemcache($key)
    {
        $value = null;
        for ($i=0; $i < 8; $i++) {
            usleep(250000);
            $value = $this->readFromMemcache($key);
            if ($value && !$this->isInProgress($value)) {
                return $value;
            }
        }

        return $value;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function isInProgress($value)
    {
        if (is_numeric($value) && time()<=$value+30) {
            return true;
        }

        return false;
    }

    /**
     * Lookups cannot have real payload attributes, since that will involve another lookup.
     *
     * @param $transactionIdentifier
     */
    public function getDefaultPayloadAttributes($transactionIdentifier)
    {
        $payloadAttributes = new PayLoadAttributes();
        $payloadAttributes->setBookingChannelID(1);
        $payloadAttributes->setBookingTypeID(1);
        // transactionIdentifier is an optional pass-through value
        $payloadAttributes->setTransactionIdentifier($transactionIdentifier);

        // Our version ID
        $payloadAttributes->setVersion($this->container->getParameter('g4_service_payload_attributes_version'));

        // Simple timestamp
        $payloadAttributes->setTimeStamp(date('Y-m-d\TH:i:s'));

        return $payloadAttributes;
    }

    /**
     * @param string $string
     *
     * @return \G4\UtilBundle\Entity\Lookup\Market\Validity
     * @throws \Exception
     */
    public function parseValid($string)
    {
        $validity = new Market\Validity();
        $dates = explode('|', $string);

        foreach ($dates as $dateString) {
            $date = explode('~', $dateString);
            switch ($date[0]){
                case 'effDate':
                    $validity->setFrom($date[1]);
                    break;
                case 'expDate':
                    $validity->setTo($date[1]);
                    break;
                default:
                    throw new \Exception('unknown format');
                    break;
            }
        }

        return $validity;
    }


}