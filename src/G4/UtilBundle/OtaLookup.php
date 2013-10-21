<?php

/**
 * Allegiant G4 utility package.
 *
 * @category  Allegiant
 * @package   G4.FlightBundle.Controller
 */
namespace G4\UtilBundle;

use G4\UtilBundle\Exception\OtaLookupException;
use Symfony\Component\DependencyInjection\ContainerAware;
use G4\UtilBundle\Exception\BookingProcessException;

/**
 * Provides methods to query the ota lookup service
 *
 * @author Serban Bajdechi <serban@lolaent.com>
 * @author Victor Vacaretu <victor@cloudtroopers.ro>
 */
class OtaLookup extends ContainerAware
{
    protected $typeName = 'response';


    /**
     * @param $code
     *
     * @return object
     *
     * @throws Exception\BookingProcessException
     */
    public function lookupStateByCode($countryCode, $code)
    {
        $country = $this->lookupCountryByCode($countryCode);
        $selectedState = null;
        try {
            // we look for the state in the country docket
            $selectedState = $this->findStateInCountry($country, $code);
            if (!$selectedState) {
                throw new \Exception("No state found in country");
            }
        } catch (\Exception $e) {
            throw new OtaLookupException(
                409,
                ErrorMapper::RESWEB_LOOKUP_NOT_FOUND,
                'META',
                'Lookup',
                sprintf('Lookup could not find state for `%s` in `%s`', $code, $country)
            );
        }

        return $selectedState;
    }

    /**
     * @param string $code
     *
     * @return \stdClass
     *
     * @throws Exception\BookingProcessException
     */
    public function lookupCountryByCode($code)
    {
        $lookupUrl = $this->container->getParameter('g4_service_customers_lookup_country');
        $persisterKey = $this->container->getParameter('g4_docketservice_country_url');
        $item = $this->getFromCache($persisterKey.'/'.$code);

        //if this has not been cached into persister, run the lookup and try again.
        if (!$item) {
            $this->loadCountries($persisterKey, $lookupUrl);
            $item = $this->getFromCache($persisterKey.'/'.$code);
        }

        if (!$item) {
            throw new OtaLookupException(
                409,
                ErrorMapper::RESWEB_LOOKUP_NOT_FOUND,
                'META',
                'Lookup',
                sprintf('Lookup could not find country for `%s` when searching under `%s`.', $code, $lookupUrl)
            );
        }

        return $item;
    }

    /**
     * @param int $id
     *
     * @throws Exception\BookingProcessException
     * @return \stdClass
     */
    public function lookupPhoneNumberTypeById($id)
    {
        $lookupUrl = $this->container->getParameter('g4_service_customers_lookup_phone');
        $persisterKey = $this->container->getParameter('g4_docketservice_phone_url');
        $item = $this->getFromCache($persisterKey.'/'.$id);

        //if this has not been cached into persister, run the lookup and try again.
        if (!$item) {
            $this->loadPhoneTypes($persisterKey, $lookupUrl);
            $item = $this->getFromCache($persisterKey.'/'.$id);
        }

        if (!$item) {
            throw new OtaLookupException(
                409,
                ErrorMapper::RESWEB_LOOKUP_NOT_FOUND,
                'META',
                'Lookup',
                sprintf('Lookup could not find phone for `%s` when searching under `%s`.', $id, $lookupUrl)
            );
        }

        return $item;
    }

    /**
     * @param int $id
     *
     * @throws Exception\BookingProcessException
     * @return \stdClass
     */
    public function lookupGenderTypeById($id)
    {
        $lookupUrl = $this->container->getParameter('g4_service_customers_lookup_gender');
        $persisterKey = $this->container->getParameter('g4_docketservice_gender_url');
        $item = $this->getFromCache($persisterKey.'/'.$id);

        //if this has not been cached into persister, run the lookup and try again.
        if (!$item) {
            $this->loadGenders($persisterKey, $lookupUrl);
            $item = $this->getFromCache($persisterKey.'/'.$id);
        }

        if (!$item) {
            throw new OtaLookupException(
                409,
                ErrorMapper::RESWEB_LOOKUP_NOT_FOUND,
                'META',
                'Lookup',
                sprintf('Lookup could not find gender for `%s` when searching under `%s`.', $id, $lookupUrl)
            );
        }

        return $item;
    }

    /**
     * @param string $name
     *
     * @return object
     *
     * @throws Exception\BookingProcessException
     */
    public function lookupGenderTypeByName($name)
    {
        $lookupUrl = $this->container->getParameter('g4_service_customers_lookup_gender');
        $persisterKey = $this->container->getParameter('g4_docketservice_gender_url');
        $item = $this->getFromCache($persisterKey.'/'.$name);

        //if this has not been cached into persister, run the lookup and try again.
        if (!$item) {
            $this->loadGenders($persisterKey, $lookupUrl);
            $item = $this->getFromCache($persisterKey.'/'.$name);
        }

        if (!$item) {
            throw new OtaLookupException(
                409,
                ErrorMapper::RESWEB_LOOKUP_NOT_FOUND,
                'META',
                'Lookup',
                sprintf('Lookup could not find gender for `%s` when searching under `%s`.', $name, $lookupUrl)
            );
        }

        return $item;
    }

    /**
     * @param $type
     *
     * @return object
     *
     * @throws Exception\BookingProcessException
     */
    public function lookupPhoneNumberTypeIdByType($type)
    {
        $lookupUrl = $this->container->getParameter('g4_service_customers_lookup_phone');
        $persisterKey = $this->container->getParameter('g4_docketservice_phone_url');
        $item = $this->getFromCache($persisterKey.'/'.$type);

        //if this has not been cached into persister, run the lookup and try again.
        if (!$item) {
            $this->loadPhoneTypes($persisterKey, $lookupUrl);
            $item = $this->getFromCache($persisterKey.'/'.$type);
        }

        if (!$item) {
            throw new OtaLookupException(
                409,
                ErrorMapper::RESWEB_LOOKUP_NOT_FOUND,
                'META',
                'Lookup',
                sprintf('Lookup could not find phoneType for `%s` when searching under `%s`.', $type, $lookupUrl)
            );
        }

        return $item;
    }

    /**
     * Lookup SSRs by BookingChannelId
     *
     * @param $bookingChannelId
     *
     * @throws Exception\OtaLookupException
     *
     * @return \stdClass
     */
    public function lookupSpecialServiceRequestTypeByChannelId($bookingChannelId)
    {
        $lookupUrl = $this->container->getParameter('g4_service_customers_lookup_ssr') . '?filter=channelId(' . $bookingChannelId . ')';
        $persisterKey = $this->container->getParameter('g4_docketservice_ssr_url');
        $ssrs = $this->getFromCache($persisterKey . '/' . $bookingChannelId);

        if (!$ssrs) {
            $this->loadSpecialServiceRequestTypes($persisterKey . '/' . $bookingChannelId, $lookupUrl);
            $ssrs = $this->getFromCache($persisterKey . '/' . $bookingChannelId);
        }

        if (!$ssrs) {
            throw new OtaLookupException(
                409,
                ErrorMapper::RESWEB_LOOKUP_NOT_FOUND,
                'META',
                'Lookup',
                sprintf('Lookup could not find SpecialServiceRequestType for `%s` when searching under `%s`.', $bookingChannelId, $lookupUrl)
            );
        }

        return $ssrs;
    }

    /**
     * Fetch the SSRs from the OTA DB service
     *
     * @param $cacheKey
     * @param $lookupUrl
     */
    public function loadSpecialServiceRequestTypes($cacheKey, $lookupUrl)
    {
        $items = $this->loadData($lookupUrl);
        if ($items && count($items)) {
            $this->saveToCache($cacheKey, $items);
        }
    }

    /**
     * Lookup waive fees reasons by channelId
     *
     * @param $bookingChannelId
     *
     * @return \stdClass
     *
     * @throws Exception\OtaLookupException
     */
    public function lookupWaiveFeesReasonsByChannelId($bookingChannelId)
    {
        $lookupUrl = $this->container->getParameter('g4_service_customers_lookup_waive_fees') . '?filter=channelId(' . $bookingChannelId . ')';
        $persisterKey = $this->container->getParameter('g4_docketservice_waive_fees_url') . '/' . $bookingChannelId;
        $waiveFees = $this->getFromCache($persisterKey);

        if (!$waiveFees) {
            $this->loadWaiveFeesReasons($persisterKey, $lookupUrl);
            $waiveFees = $this->getFromCache($persisterKey);
        }

        if (!$waiveFees) {
            throw new OtaLookupException(409, ErrorMapper::RESWEB_LOOKUP_NOT_FOUND, 'META', 'Lookup', sprintf('Lookup could not find waive fees for `%s` when searching under `%s`.', $bookingChannelId, $lookupUrl));
        }

        return $waiveFees;
    }

    /**
     * Fetch the waive fees from the OTA DB service
     *
     * @param $cacheKey
     * @param $lookupUrl
     */
    public function loadWaiveFeesReasons($cacheKey, $lookupUrl)
    {
        $items = $this->loadData($lookupUrl);
        if ($items && count($items)) {
            $this->saveToCache($cacheKey, $items);
        }
    }

    /**
     * Look for state object in the country docket
     *
     * @param \stdClass $country The country object
     * @param string    $code    The state code
     *
     * @return null
     */
    public function findStateInCountry(\stdClass $country, $code)
    {
        $selectedState = null;
        foreach ($country->states as $state) {
            if (strtoupper($state->abbrv) == strtoupper($code)) {
                $selectedState = $state;
                break;
            }
        }

        return $selectedState;
    }

    /**
     * Get countries list from lookup service.
     *
     * @param string $cacheKey
     * @param string $lookupUrl
     *
     */
    public function loadCountries($cacheKey, $lookupUrl)
    {
        $items = $this->loadData($lookupUrl);
        if ($items) {
            if (is_array($items)) {
                foreach ($items as $item) {
                    // persist the results by code and id.
                    $this->saveToCache($cacheKey.'/'.strtoupper($item->alpha2Code), $item);
                    $this->saveToCache($cacheKey.'/'.$item->id, $item);
                }
            }
        }
    }

    /**
     * Get gender list
     *
     * @param $cacheKey
     * @param $lookupUrl
     */
    public function loadGenders($cacheKey, $lookupUrl)
    {
        $items = $this->loadData($lookupUrl);
        if ($items) {
            if (is_array($items)) {
                foreach ($items as $item) {
                    // persist the results by code and id.
                    $this->saveToCache($cacheKey.'/'.strtoupper($item->name), $item);
                    $this->saveToCache($cacheKey.'/'.$item->id, $item);
                }
            }
        }
    }

    /**
     * Get phoneType list
     *
     * @param $cacheKey
     * @param $lookupUrl
     */
    public function loadPhoneTypes($cacheKey, $lookupUrl)
    {
        $items = $this->loadData($lookupUrl);
        if ($items) {
            if (is_array($items)) {
                foreach ($items as $item) {
                    // persist the results by code and id.
                    $this->saveToCache($cacheKey.'/'.strtoupper($item->name), $item);
                    $this->saveToCache($cacheKey.'/'.$item->id, $item);
                }
            }
        }
    }

    /**
     * @param string $persisterKey
     *
     * @return \stdClass
     */
    public function getFromCache($persisterKey)
    {
        $cachedValue = json_decode($this->container->get("g4_persister_memcache")->get($persisterKey));

        return $cachedValue;
    }

    /**
     * Fetch data from lookup url
     *
     * @param string $url
     *
     * @return mixed
     */
    public function loadData($url)
    {
        $serviceTimeout = $this->container->getParameter('g4_timeout_reswebdefault');
        $c = new ServicesCall();
        $c->addGet(
            $url,
            $serviceTimeout,
            array('Content-Type: application/json'),
            $this->typeName
        );

        return $this->execute($c);
    }

    /**
     * @param $persisterKey
     * @param $data
     */
    public function saveToCache($persisterKey, $data)
    {
        $this->container->get("g4_persister_memcache")->set($persisterKey, json_encode($data));
    }

    /**
     * Fetch data from lookup url
     *
     * @param string $url
     *
     * @return mixed
     */
    public function execute(ServicesCall $c)
    {
        $results = $c->execute();

        $curlInfo = $c->getInfoNo($this->typeName);
        if ($curlInfo['http_code'] != 200) {
            $description = '';
            switch ($curlInfo['http_code']) {
                case 0:
                    $description = sprintf('Lookup could not reach `%s`', $curlInfo['url']);
                    break;
                case 204:
                    $description = sprintf('Lookup tables may be empty `%s`, received 204 http code', $curlInfo['url']);
                    break;
                case 404:
                    $description = sprintf('Lookup could not get any data from `%s`, received 404 http code', $curlInfo['url']);
                    break;
                case 500:
                    $description = sprintf('Lookup could not get any data from `%s` probably lookup service internal error, received 500 http code', $curlInfo['url']);
                    break;
                default:
                    $description = sprintf('Unrecognized http code %s received at %s', $curlInfo['http_code'], $curlInfo['url']);
                    break;
            }

            throw new OtaLookupException(
                500,
                ErrorMapper::WRONG_REQUEST,
                'META',
                'Lookup',
                $description
            );
        }

        return json_decode($results[$this->typeName]);
    }
}
