<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Services.G4Container
 * @author   Victor Vacaretu <victor@cloudtroopers.ro>
 */
namespace G4\UtilBundle\Services;

use G4\UtilBundle\Exception\PutContentsNotFoundException;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use G4\UtilBundle\Controller\G4Controller;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;

/**
 * Container service class used for storing keys and variables across the application (manifest it, g4 nache, etc)
 */
class G4Container extends ContainerAware
{
    const REQUEST_TYPE_AJAX     = 'ajax';
    const REQUEST_TYPE_SYMFONY  = 'symfony';

    /**
     * @var Request The Request object
     */
    private $request = null;

    /**
     * @var string The manifest ID
     */
    private $manifestId = null;

    /**
     * @var string The transaction ID
     */
    private $transactionId = null;

    /**
     * @var string The client Ip
     */
    private $clientIp = null;

    /**
     * @var string The drupal session id
     */
    private $drupalSessionId = null;

    /**
     * @var string The drupal user name
     */
    private $drupalUsername = null;

    /**
     * @var string The drupal roles
     */
    private $drupalRoles = null;

    /**
     * @var string The G4 Nache cookie
     */
    private $g4Nache = null;

    /**
     * @var string The request pair key
     */
    private $requestPairKey = null;

    /**
     * @var string The request type : ajax/symfony
     */
    private $requestType = null;

    /** @var string The abTest value sent in the query string to symfony */
    private $abTest = null;

    /**
     * initialize the "global" variables
     */
    public function init()
    {
        $this->setRequestPairKey($this->generatePairKey());
    }

    /**
     * @param string $manifestId
     */
    protected function setManifestId($manifestId)
    {
        $this->manifestId = $manifestId;
    }

    /**
     * @return string
     */
    public function getManifestId()
    {
        if (is_null($this->manifestId)) {
            $this->setManifestId($this->detectManifestId());
        }

        return $this->manifestId;
    }

    /**
     * We get the manifest Id from the request object
     */
    public function detectManifestId()
    {
        /** @var $request Request */
        try {
            $request = $this->container->get('request');
        } catch (InactiveScopeException $e) {
            return 'NoManifestIdCLI';
        }

        //we check if we have the manifestId or manifestid set up as GET parameter (this is when accessing services the extend the ServiceController - and OLCI)
        if ($request->get('manifestId', null) != null) {

            return $request->get('manifestId');
        }

        if ($request->get('manifestid', null) != null) {

            return $request->get('manifestid');
        }

        //what if we have it in the headers
        if ($request->headers->get('content-md5')) {
            return $request->headers->get('content-md5');
        }

        //if not we take the manifest id from the hash GET parameter
        if ($request->get('hash', null) != null) {

            return $request->get('hash');
        }

        //if we did not find it in the GET params then we start looking for the search_hash value inside the cart variable (shopping cart requests)
        try {
            $raw = G4Controller::getPutDataFromRequest($request, 'cart');
            $manifestId = $this->extractJsonValue($raw, 'search_hash');
            if ($manifestId != null) {

                return $manifestId;
            }
        } catch (\G4\UtilBundle\Exception\PutContentsNotFoundException $exception) {
            //do nothing - it's okay not to have a manifest id
        }

        //the online checkin holds the manifest id in the journey variable as confCode json var (we return it's md5 of uppercase value)
        try {
            $raw = G4Controller::getPutDataFromRequest($request, 'journey');
            $manifestId = $this->extractJsonValue($raw, 'confCode');
            if ($manifestId != null) {

                return md5(strtoupper($manifestId));
            }
        } catch (\G4\UtilBundle\Exception\PutContentsNotFoundException $exception) {
            //do nothing - it's okay not to have a manifest id
        }

        //confirmation from
        try {
            $manifestId = G4Controller::getPutDataFromRequest($request, 'search_hash');

            //ajax sends us a json encoded value. we need to be prepared for that, otherwise we wil get ""manifestID""
            if (json_decode($manifestId) != null) {
                return json_decode($manifestId);
            }
            if ($manifestId != null) {
                return $manifestId;
            }
        } catch (PutContentsNotFoundException $e) {
            //do nothing - it's okay not to have a manifest id
        }

        //for profile/customer/filter operation, this is fetched from data.
        try {
            $raw = G4Controller::getPutDataFromRequest($request, 'data');
            $manifestId = $this->extractJsonValue($raw, 'manifestId');
            if ($manifestId != null) {

                return $manifestId;
            }
        } catch (\G4\UtilBundle\Exception\PutContentsNotFoundException $exception) {
            //do nothing - it's okay not to have a manifest id
        }

        return 'NoManifestId';
    }

    /**
     * The method extracts the value of a json variable using string functions
     *
     * @param $raw
     * @param $variableName
     *
     * @return string
     */
    protected function extractJsonValue($raw, $variableName)
    {
        $variableName .= '"';
        $value = null;
        if (strpos($raw, $variableName) !== false) {
            $startPosition = strpos($raw, $variableName) + strlen($variableName);
            if (strpos(substr($raw, $startPosition), '"') !== false) {
                $firstQuote = strpos(substr($raw, $startPosition), '"') + $startPosition + 1;

                if (strpos(substr($raw, $firstQuote + 1), '"') !== false) {
                    $secondQuote = strpos(substr($raw, $firstQuote + 1), '"') + $firstQuote + 1;

                    $value = substr($raw, $firstQuote, $secondQuote - $firstQuote);

                    //if the found value is longer than 32 chars or less than 5
                    if ((strlen($value) > 32) && (strlen($value) < 5)) {
                        return null;
                    }
                }
            }
        }

        return $value;
    }

    /**
     * @param string $requestPairKey
     */
    protected function setRequestPairKey($requestPairKey)
    {
        $this->requestPairKey = $requestPairKey;
    }

    /**
     * @return string
     */
    public function getRequestPairKey()
    {
        if (is_null($this->requestPairKey)) {
            return 'NoPairKey';
        }

        return $this->requestPairKey;
    }

    /**
     * The function generates a pair key to be used in matching requests/responses
     *
     * @return string
     */
    public function generatePairKey()
    {
        $pairKey = md5(microtime() . rand(0, 1000000));

        return $pairKey;
    }

    /**
     * Setter method for requestType
     *
     * @param string $requestType The request type
     */
    public function setRequestType($requestType)
    {
        $this->requestType = $requestType;
    }

    /**
     * Getter method for requestType
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * Setter method for clientIp
     *
     * @param string $clientIp
     */
    protected function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;
    }

    /**
     * Getter method for clientIp
     *
     * @return string
     */
    public function getClientIp()
    {
        if (is_null($this->clientIp)) {
            $this->setClientIp($this->detectClientIp());
        }

        return $this->clientIp;
    }

    /**
     * Gets the client IP from the GET params
     *
     * @return string
     */
    public function detectClientIp()
    {
        try {
            $clientIp = $this->container->get('request')->query->get('client_ip', '0.0.0.0');
        } catch (InactiveScopeException $e) {
            //for unit tests / CLI command
            return '1.1.1.1';
        }

        return $clientIp;
    }

    /**
     * Setter method for transactionId
     *
     * @param string $transactionId
     */
    protected function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Getter method for transactionId
     *
     * @return string
     */
    public function getTransactionId()
    {
        if (is_null($this->transactionId)) {
            $this->setTransactionId($this->detectTransactionId());
        }

        return $this->transactionId;
    }

    /**
     * Gets the transaction ID from the GET params
     */
    public function detectTransactionId()
    {
        try {
            $transactionId = $this->container->get('request')->query->get('transactionIdentifier', 'UID');
        } catch (InactiveScopeException $e) {
            return 'UIDCLI';
        }

        return $transactionId;
    }

    /**
     * Setter method for drupalSessionId
     *
     * @param string $drupalSessionId The drupal Session Id
     */
    protected function setDrupalSessionId($drupalSessionId)
    {
        $this->drupalSessionId = $drupalSessionId;
    }

    /**
     * Getter method for drupalSessionId
     *
     * @return string
     */
    public function getDrupalSessionId()
    {
        if (is_null($this->drupalSessionId)) {
            $this->setDrupalSessionId($this->detectDrupalSessionId());
        }

        return $this->drupalSessionId;
    }

    /**
     * The method finds the drupal session id in GET or POST requests.
     *
     * @return mixed|null|string
     */
    public function detectDrupalSessionId()
    {
        /** @var $request Request */

        try {
            $request = $this->container->get('request');
        } catch (InactiveScopeException $e) {
            return 'NoDrupalSessionIdCLI';
        }


        $drupalSessionId = $request->query->get('sessionID', null);
        if (!is_null($drupalSessionId)) {

            return $drupalSessionId;
        }

        //search the session id in the search POST params
        try {
            $raw = G4Controller::getPutDataFromRequest($request, 'search');
            $drupalSessionId = $this->extractJsonValue($raw, 'sessionID');
            if ($drupalSessionId != null) {

                return $drupalSessionId;
            }
        } catch (\G4\UtilBundle\Exception\PutContentsNotFoundException $exception) {
            //do nothing - it's okay not to have a drupal session id
        }

        //search the session id in the cart POST params
        try {
            $raw = G4Controller::getPutDataFromRequest($request, 'cart');
            $drupalSessionId = $this->extractJsonValue($raw, 'sessionID');
            if ($drupalSessionId != null) {

                return $drupalSessionId;
            }
        } catch (\G4\UtilBundle\Exception\PutContentsNotFoundException $exception) {
            //do nothing - it's okay not to have a drupal session id
        }

        return 'NoDrupalSessionId';
    }

    /**
     * Setter method for drupalUsername
     *
     * @param $drupalUsername
     */
    protected function setDrupalUsername($drupalUsername)
    {
        $this->drupalUsername = $drupalUsername;
    }

    /**
     * Getter method for drupalUsername
     *
     * @return string
     */
    public function getDrupalUsername()
    {
        if (is_null($this->drupalUsername)) {
            $this->setDrupalUsername($this->detectDrupalUsername());
        }

        return $this->drupalUsername;
    }

    /**
     * Grab the drupalUsername from the cookies
     */
    public function detectDrupalUsername()
    {
        try {
            $drupalUsername = $this->container->get('request')->cookies->get('user_name', 'NoDrupalUsername');
        } catch (InactiveScopeException $e) {
            return 'NoDrupalUsernameCLI';
        }

        return $drupalUsername;
    }

    /**
     * Setter method for drupalRoles
     *
     * @param string $drupalRoles
     */
    protected function setDrupalRoles($drupalRoles)
    {
        $this->drupalRoles = $drupalRoles;
    }

    /**
     * Getter method for drupalRoles
     *
     * @return string
     */
    public function getDrupalRoles()
    {
        if (is_null($this->drupalRoles)) {
            $this->setDrupalRoles($this->detectDrupalRoles());
        }

        return $this->drupalRoles;
    }

    /**
     * Grab the drupalRoles from the cookies
     */
    public function detectDrupalRoles()
    {
        try {
            $drupalRoles = str_replace(' ', '_', $this->container->get('request')->cookies->get('user_roles', 'NoDrupalRoles'));
        } catch (InactiveScopeException $e) {
            return 'NoDrupalRolesCLI';
        }

        return $drupalRoles;
    }

    /**
     * Setter method for g4Nache
     *
     * @param string $g4Nache The g4_nache cookie parameter
     */
    protected function setG4Nache($g4Nache)
    {
        $this->g4Nache = $g4Nache;
    }

    /**
     * Getter method for g4Nache
     *
     * @return string
     */
    public function getG4Nache()
    {
        if (is_null($this->g4Nache)) {
            $this->setG4Nache($this->detectG4Nache());
        }

        return $this->g4Nache;
    }

    /**
     * grab the g4_nache cookie value
     */
    public function detectG4Nache()
    {
        try {
            $g4Nache = $this->container->get('request')->cookies->get('g4_nache', 'NoG4Nache');
        } catch (InactiveScopeException $e) {
            return 'NoG4NacheCLI';
        }

        return $g4Nache;
    }

    /**
     * Setter method for abTest
     *
     * @param string $abTest
     */
    protected function setAbTest($abTest)
    {
        $this->abTest = $abTest;
    }

    /**
     * Getter method for abTest
     *
     * @return string
     */
    public function getAbTest()
    {
        if (is_null($this->abTest)) {
            $this->setAbTest($this->detectAbTest());
        }

        return $this->abTest;
    }

    /**
     * Gets the abTest from the GET params
     */
    public function detectAbTest()
    {
        try {
            $abTest = $this->container->get('request')->query->get('abTest', null);
        } catch (InactiveScopeException $e) {
            return null;
        }

        return $abTest;
    }

    /**
     * Compute the booking channel ID based on the drupal role
     *
     * @return int
     */
    public function getBookingChannelID()
    {
        /** @var $request Request */
        try {
            $request = $this->container->get('request');
        } catch (InactiveScopeException $e) {
            return $this->container->getParameter('g4_booking_channel_id');
        }

        $role = '';

        //try to find out the role in the search object
        try {
            $raw = G4Controller::getPutDataFromRequest($request, 'search');
            $role = $this->extractJsonValue($raw, 'role');
        } catch (PutContentsNotFoundException $exception) {
            //do nothing - it's okay not to have a role
        }

        //try to find the role in the cart object
        if (!$role) {
            try {
                $raw = G4Controller::getPutDataFromRequest($request, 'cart');
                $role = $this->extractJsonValue($raw, 'role');
            } catch (PutContentsNotFoundException $exception) {
                //do nothing - it's okay not to have a role
            }
        }

        //try to find the role in the legacy_customer_nbr object
        if (!$role) {
            try {
                $raw = G4Controller::getPutDataFromRequest($request, 'legacy_customer_nbr');
                $role = $this->extractJsonValue($raw, 'role');
            } catch (PutContentsNotFoundException $exception) {
                //do nothing - it's okay not to have a role
            }
        }

        $bookingChannelId = $this->container->get('g4_lookup')->getBookingChannelIdByRole($role);

        return $bookingChannelId;
    }
}
