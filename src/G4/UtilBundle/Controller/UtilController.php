<?php

namespace G4\UtilBundle\Controller;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use G4\UtilBundle\CouchDocument\Put;
use G4\UtilBundle\CouchDocument\Error;
use G4\UtilBundle\CouchDocument\Search;
use G4\DefaultBundle\Controller\DefaultController;

/**
 * UtilController
 */
class UtilController extends DefaultController
{
    /**
    * returns resweb url for drupal
    *
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function resweburlAction()
    {
        $con = $this->container;
        $g4Resweb = $con->getParameter('g4_resweb');

        return $this->render(
            'G4UtilBundle:Util:resweburl.html.twig',
            array(
                'resweburl' => $g4Resweb
            )
        );
    }

    /**
     * returns REST parameters for versioning NOC tool
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resturlAction()
    {
        $con = $this->container;
        $g4FlightOps = $con->getParameter('g4_flightops');
        $g4FlightAlerts = $con->getParameter('g4_flightalerts');
        $g4OtaDb = $con->getParameter('g4_otadb');
        $g4PieKey = $con->getParameter('g4_pie_key');
        $g4PieLib = $con->getParameter('g4_pie_lib');
        $g4VoucherDb = $con->getParameter('g4_voucherdb');

        return $this->render(
            'G4UtilBundle:Util:resturl.html.twig',
            array(
                'g4FlightOps'    => $g4FlightOps,
                'g4FlightAlerts' => $g4FlightAlerts,
                'g4OtaDb'        => $g4OtaDb,
                'g4PieKey'       => $g4PieKey,
                'g4PieLib'       => $g4PieLib,
                'g4VoucherDb'    => $g4VoucherDb,
            )
        );
    }

    /**
     * Load the test page
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testAction()
    {
        $con = $this->container;

        $version = apache_get_version();
        return $this->render(
            'G4UtilBundle:Util:test.twig.html', array(
                'env' => $this->get('kernel')->getEnvironment(),
                'host' => gethostname(),
                'version' => $version
            )
        );
    }

    /**
     * Writes and reads to and from memcache
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testmemcacheAction()
    {
        $ret = array('Testing memcache');

        $key = md5(time());
        $data = 'Test memcache data';
        $ret[] = sprintf('Writing "%s" to memcache key %s', $data, $key);

        try {
            $memcache = $this->container->get('g4_persister_memcache');
            $memcache->set($key, $data);
            $_data = $memcache->get($key);

            $status = true;
            if ($data != $_data) {
                $status = false;
                $ret[] = sprintf('Memcache data not put/got correctly, "%s" != "%s"', $data, $_data);
            } else {
                $ret[] = sprintf('Memcache data matched "%s"', $_data);
            }
        } catch (\G4\UtilBundle\Exception\MemcacheException $e) {
            $status = false;
            $ret[] = sprintf('Memcache data not put/got correctly, "%s"', $e->getMessage());
        }


        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }


    /**
     * Controller - tests if we can connect to the couch database
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testcouchavailableAction()
    {
        $status = true;
        $ret = array('Checking couch database [CARTS]');

        try {
            $dm = $this->get('doctrine_couchdb.odm.default_document_manager');


            try {
                $dm->getCouchDBClient()->getVersion();
                $ret[] = 'Successfuly connected to Couch Database [CARTS]';
            } catch (\Exception $e) {
                $status = false;
                $ret[] = 'Could not connect to Couch Database [CARTS]';
            }
        } catch (\Exception $e) {
            $status = false;
            $ret[] = 'doctrine_couchdb is not defined, config_couch.yml is not imported';
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret
                )
            )
        );
    }


    /**
     * Controller - test if the database exists
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testcouchdbexistsAction()
    {
        $status = true;
        $ret = array('Checking if database exists [CARTS]');

        $dm = $this->get('doctrine_couchdb.odm.default_document_manager');

        $databases = $dm->getCouchDBClient()->getAllDatabases();
        $cartsDatabase = $dm->getCouchDBClient()->getDatabase();

        if (!in_array($cartsDatabase, $databases)) {
            $status = false;
            $ret[] = 'Database does not exist [CARTS]';
        } else {
            $ret[] = 'Database found [CARTS]';
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret
                )
            )
        );
    }


    /**
     * Controller - test if the views exists
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testcouchviewsexistsAction()
    {
        $status = true;
        $ret = array('Checking if views exists [CARTS]');

        $dm = $this->get('doctrine_couchdb.odm.default_document_manager');

        $existingViews = $dm->getConfiguration()->getDesignDocumentNames();

        $views = array(
            'doctrine_associations',
            'doctrine_repositories',
            'stats',
            'foo',
        );

        foreach ($views as $view) {
            if (!in_array($view, $existingViews)) {
                $status = false;
                $ret[] = 'View ' . $view . ' not found [CARTS]';
            } else {
                $ret[] = 'View ' . $view . ' found [CARTS]';
            }
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret
                )
            )
        );
    }


    /**
     * Controller - tests if we can read/write into the couch database
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testcouchreadwriteAction()
    {

        $status = true;
        $ret = array('Checking if read/write operations can be performed [CARTS]');

        $dm = $this->get('doctrine_couchdb.odm.default_document_manager');

        try {
            $document = $dm->getCouchDBClient()->postDocument(array('testingwrite' => true));
            $ret[] = 'Writing into database [CARTS]';
            $documentId = $document[0];
            $revision = $document[1];
            $dm->getCouchDBClient()->deleteDocument($documentId, $revision);
            $ret[] = 'Deleting from database [CARTS]';
        } catch (\Exception $e) {
            $ret[] = 'Could not perform write/delete operation on database [CARTS]';
            $status = false;
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret
                )
            )
        );
    }


    /**
     * Tests couch is there
     *
     * TODO We need a test for carts as well as timeline
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testcouchAction()
    {
        $status = true;
        $ret = array('Checking couch');
        $loggingActive = $this->container->getParameter('g4_timeline_log');

        try {
            if (!$loggingActive) {
                $ret[] = "Skip Test, g4_timeline_log is false";
                $status = false;
            } else {
                $logging = $this->container->get('g4_logging_timeline');

                $hash = md5(microtime());
                $testData = array();
                for ($i=0; $i<100; $i++) {
                    $testData[rand(0, 10000000)] = rand(0, 10000000);
                }

                $newId = $logging->timelineLog($hash, "test", array($testData), get_class($this), true);
                $json = file_get_contents($logging->getServer() . $newId);

                if (strpos($json, json_encode($testData)) !== false) {
                    $ret[] = 'Time line data saved and retrieved successfully';
                    $status = true;
                } else {
                    $ret[] = 'Failed to save and receive time line data';
                    $status = false;
                }
            }
        } catch (\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $e) {
            $status = false;
            $ret[] = sprintf('Skip Test, Timeline couch not used: "%s<br> config_couch.yml is not imported"', $e->getMessage());
        } catch (\Exception $e) {
            $status = false;
            $ret[] = sprintf('Timeline couch failed: "%s"', $e->getMessage());
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }

    /**
     * Test the dockets and meta data endpoints
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testmetaAction()
    {
        $cont = $this->container;
        $status = true;
        $ret = array('Checking metadata and dockets');

        try {
            // meta_lookup_url
            $url = sprintf(
                '%s/VehicleType/Car.json',
                $cont->getParameter('meta_lookup_url')
            );
            $ret[] = self::testMetaData(
                $url, array('name' => 'Car', 'type' => 'VehicleType')
            );

            // g4_docketservice_paymenttype_url
            $url = sprintf(
                '%s/1.json',
                $cont->getParameter('g4_docketservice_paymenttype_url')
            );
            $ret[] = self::testMetaData(
                $url, array(
                    'name' => 'MC',
                    'type' => 'PaymentType',
                    'description' => 'MasterCard Credit'
                )
            );
            // g4_docketservice_market_url
            $url = sprintf(
                '%s/1.json',
                $cont->getParameter('g4_docketservice_market_url')
            );
            $ret[] = self::testMetaData(
                $url, array(
                    'name' => 'BILLAS',
                    'type' => 'Market',
                    // 'description' => 'BILLAS',
                )
            );
            // g4_docketservice_product_url
            $url = sprintf(
                '%s/LAS.json',
                $cont->getParameter('g4_docketservice_product_url')
            );
            $ret[] = self::testService($url);
            // g4_docketservice_hotel_url
            $url = sprintf(
                '%s/LAS.json',
                $cont->getParameter('g4_docketservice_hotel_url')
            );
            $ret[] = self::testService($url);
            // g4_docketservice_vehicle_url
            $url = sprintf(
                '%s/LAS.json',
                $cont->getParameter('g4_docketservice_vehicle_url')
            );
            $ret[] = self::testService($url);
            // g4_docketservice_flight_url
            $url = sprintf(
                '%s/1.json',
                $cont->getParameter('g4_docketservice_flight_url')
            );
            $ret[] = self::testMetaData(
                $url, array(
                    'name' => 'BILLAS',
                    'type' => 'Market',
                    // 'description' => 'BILLAS'
                )
            );
        } catch (\Exception $e) {
            $status = false;
            $ret[] = sprintf('<error>Metadata test failed, %s</error>', $e->getMessage());
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }

    /**
     * Test ResWeb responses
     *
     * @throws \RuntimeException
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testreswebAction()
    {
        $cont = $this->container;
        $status = true;
        $ret = array('Testing resweb');

        try {
            $param = $cont->getParameter('g4_search_service_getavail_hotel');
            $ret[] = self::testResWeb($param, 'hotel');

            $param = $cont->getParameter('g4_search_service_getavail_vehicle');
            $ret[] = self::testResWeb($param, 'vehicleClass');

            $param = $cont->getParameter('g4_search_service_getavail_product');
            $ret[] = self::testResWeb($param, 'productBrand');

            $param = $cont->getParameter('g4_search_service_getavail_flight');
            $ret[] = self::testResWeb($param, 'journeySet');

            $param = $cont->getParameter('g4_search_service_getavail_transport');
            $ret[] = self::testResWeb($param, 'productBrand');

            $param = $cont->getParameter('g4_search_service_getavail_seatmap');
            $ret[] = self::testResWeb($param, 'flight');

            $param = $cont->getParameter(
                'g4_search_service_getavail_legacy_customer_nbr'
            );
            $ret[] = self::testResWeb($param, 'customerNbr');

            $param = $cont->getParameter('g4_search_service_cart_book');
            $ret[] = self::testResWeb($param, 'cart');

            $param = $cont->getParameter('g4_book_service_get_cart_total');
            $ret[] = self::testResWeb($param, 'cartTotal');

            $param = $cont->getParameter('g4_book_service_send_confirmation');
            $ret[] = self::testResWeb($param, 'custComInfo');
        } catch (\Exception $e) {
            $ret[] = sprintf('Resweb fails with "%s"', $e->getMessage());
            $status = false;
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }

    /**
     * Test ResWeb responses
     *
     * @throws \RuntimeException
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testotaresAction()
    {
        $cont = $this->container;
        $status = true;
        $ret = array('Testing otares');

        try {
            $param = $cont->getParameter('g4_service_customers_filter');
            $searchUrl = $param.'?filter=lastName(mcneice)';
            $ret[] = self::testOtaResCustomerSearch($searchUrl);
        } catch (\Exception $e) {
            $ret[] = sprintf('Resweb fails with "%s"', $e->getMessage());
            $status = false;
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }

    /**
     * Test ResWeb Voucher responses
     *
     * @throws \RuntimeException
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testvouchersAction()
    {
        $cont = $this->container;
        $status = true;
        $ret = array('Testing voucherDb');

        try {
            $url = $cont->getParameter('g4_voucherdb');
            $searchUrl = $url.'/vouchers?lname=smith&fname=john';
            $ret[] = self::testVouchersSearch($searchUrl);
        } catch (\Exception $e) {
            $ret[] = sprintf('Resweb fails with "%s"', $e->getMessage());
            $status = false;
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }

    /**
     * Test the REST ResWeb for Flight Status and Flight Alerts and PIE params if g4_pie_enabled
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testrestAction()
    {
        $cont = $this->container;
        $status = true;
        $ret = array('Testing rest and pie params');

        $goodParams = $cont->getParameter('g4_good_params');
        $g4ResWeb = $this->container->getParameter('g4_resweb');
        if (is_array($goodParams) && array_key_exists($g4ResWeb, $goodParams)) {
            try {
                $param = $cont->getParameter('g4_flightops');
                $ret[] = self::testResWebRelated($param, $goodParams[$g4ResWeb][0], 'g4_flightops');

                $param = $cont->getParameter('g4_flightalerts');
                $ret[] = self::testResWebRelated($param, $goodParams[$g4ResWeb][1], 'g4_flightalerts');

                if ($cont->getParameter('g4_pie_enabled')) {
                    $param = $cont->getParameter('g4_pie_key');
                    $ret[] = self::testResWebRelated($param, $goodParams[$g4ResWeb][2], 'g4_pie_key');

                    $param = $cont->getParameter('g4_pie_lib');
                    $ret[] = self::testResWebRelated($param, $goodParams[$g4ResWeb][3], 'g4_pie_lib');
                } else {
                    $ret[] = sprintf('g4_pie_enabled is false, so no need to test PIE params"');
                }
            } catch (\Exception $e) {
                $ret[] = sprintf('Resweb related param are incorrect: "%s"', $e->getMessage());
                $status = false;
            }
        } else {
            $ret[] = sprintf('Skip Test, g4_good_params from config.yml does not have ResWeb array related param defined for "%s"', $g4ResWeb);
            $status = false;
        };

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }

    /**
     * Check that the front page of the symfony used for services is good
     *
     * Loads the fron page of the g4_sy2mnt parameter and checks that the
     * version is returned
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testsy2mntAction()
    {
        $ret = array('Testing symfony mounting');

        $url = $this->container->getParameter('g4_sy2mnt');
        $data = file_get_contents($url);
        $expected = $this->getVersion();

        $ret[] = sprintf('Sy2 URL is %s', $url);
        $ret[] = sprintf('Expecting response to start with ', $expected);

        if (strpos($data, $expected) === 0) {
            $status = true;
            $ret[] = sprintf('Response is correct "%s"', $data);
        } else {
            $status = false;
            $ret[] = sprintf('The data from %s does not parse as valid json, expected "%s" got "%s"', $url, $expected, $data);
        }

        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $ret,
                )
            )
        );
    }

    /**
     * Searched the code tree for getParameter calls
     *
     * And the tests that the parameter is present
     *
     * @access public
     * @return void
     */
    public function testparamsAction()
    {
        $status = true;
        $text = array();
        $rows = array();

        $output = array();
        $root = $this->get('kernel')->getRootDir();
        $cmd = \sprintf('grep -Rn getParameter %s/../src|grep -v Test', $root);
        exec($cmd, $output);

        $grepParams = array();
        foreach ($output as $line) {
            $paramArray = $this->splitgrepline($line);
            if (isset($paramArray[0]['name'])) {
                $keyFound = array_search($paramArray[0]['name'], $grepParams);
                if ($keyFound) {
                    //it is a duplicate parameter, so only add the path for founded param
                    $rows[$keyFound]['path'] = $rows[$keyFound]['path'].' '.$rows[$keyFound]['line']."\n".$paramArray[0]['path'].' '.$paramArray[0]['line'];
                    $rows[$keyFound]['line'] = '';
                } else {
                    $grepParams[] = $paramArray[0]['name'];
                    $rows = array_merge($rows, $paramArray);
                }
            }

        }

        foreach ($rows as $row) {
            $status = ($status && $row['status']);
            if (!$status) {
                break;
            }
        }

        //get the others params: not used or symfony core/vendor params
        $params = $this->container->getParameterBag()->all();
        ksort($params);

        foreach ($params as $param => $value) {
            //do not displayed if it is already checked/displayed by grep getParameter command
            if (!in_array($param, $grepParams)) {
                $rows = array_merge($rows, array(array(
                    'line' => 'Extra/Core Params',
                    'name' => $param,
                    'value'  => $value,
                    'status' => 2,
                )));
            }
        }



        return new Response(
            json_encode(
                array(
                    'status' => $status,
                    'text' => $text,
                    'rows' => $rows,
                )
            )
        );
    }

    /**
     * Gets and tests parameters in the code tree
     *
     * Splits the response from a grep into an array and tests that the param
     * is present in the config
     *
     * The response from the grep is:
     *     /path/to/file:line: matched text
     *
     * @param string $text
     *
     * @final
     * @access private
     * @return void
     */
    private final function splitgrepline($text = '')
    {
        $ret = array();

        $list = explode(':', $text);

        if (count($list) > 2) {
            $path = array_shift($list);
            $path = substr($path, strpos($path, 'src'));
            $file = basename($path);
            $line = array_shift($list);

            $match = array();
            preg_match_all("/getParameter\('([^']*)'\K/", implode(':', $list), $match);
            $params = $match[1];

            $con = $this->container;

            foreach ($params as $param) {
                if ($param == 'g4_search_service_getavail_') {
                    // skip this, it's built built in the Service controller and the actual parameter is checked elsewhere
                    continue;
                }
                if (strpos('#'.$param, 'couch_')) {
                    // skip this, do not use couch anymore
                    continue;
                }
                try {
                    $val = $con->getParameter($param);
                    $ret[] = array(
                        'file' => $file,
                        'path' => $path,
                        'line' => $line,
                        'name' => $param,
                        'value'  => $val,
                        'status' => true,
                    );
                } catch (\Exception $e) {
                    $ret[] = array(
                        'file' => $file,
                        'path' => $path,
                        'line' => $line,
                        'name' => $param,
                        'value'  => $e->getMessage(),
                        'status' => false,
                    );
                }
            }
        } else {
            $ret['error'] = $text . ' ' . count($list);
        }

        return $ret;
    }

    /**
     * Loads and checks a given URL returns good json
     *
     * @param mixed $url       The url of the metadata service to access
     * @param mixed $checkdata An array of name/value pairs to be matched in the return data
     *
     * @throws \RuntimeException
     * @access protected
     * @return void
     */
    protected static function testMetaData($url, $checkdata)
    {
        $data = self::file_get_contents($url);
        if (!$data) {
            throw new \RuntimeException(sprintf('No data returned from %s', $url));
        }
        $json = json_decode($data, true);
        if (!$json || empty($json) || count($json) == 0) {
            throw new \RuntimeException(
                sprintf('Data from %s failed to decode', $url)
            );
        }
        if (!is_array($checkdata)) {
            return true;
        }
        foreach ($checkdata as $key => $val) {
            if (!isset($json[$key])) {
                throw new \RuntimeException(
                    sprintf(
                        'No data in the JSON for index %s from %s', $key, $url
                    )
                );
            } else if ($json[$key] != $val) {
                throw new \RuntimeException(
                    sprintf(
                        'Unexpected data in the key %s from %s, '
                        . 'expected %s and got %s', $key, $url, $val, $json[$key]
                    )
                );
            }
        }

        return sprintf('<info>Valid data retrieved from %s</info>', $url);
    }

    /**
     * Use cURL to load a resweb resource and check it's good json
     *
     * It searches the response for 'payloadAttributes', 'warning', and 'error'
     *
     * @param mixed $url  The url of the service to access
     * @param mixed $type The type of the request, hotel, flight etc
     *
     * @throws \RuntimeException
     * @access public
     * @return void
     */
    public static function testResWeb($url, $type)
    {
        // curl --header 'Content-Type: application/json' -X POST --data "{}" http://192.168.143.167:8080/resweb/rest/hotel/getHotelAvail|python -mjson.tool

        $ch = curl_init();

        $headers = array('Content-Type: application/json');

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
        curl_setopt($ch, CURLOPT_POST, 1);

        if (!$result = curl_exec($ch)) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to reach resweb for %s at %s, '
                    . 'cURL reported %s [%d]', $type, $url, curl_error($ch), curl_errno($ch)
                )
            );
        }

        $json = json_decode($result, true);
        if (!$json || empty($json) || count($json) == 0) {
            throw new \RuntimeException(
                sprintf('Data from %s failed to decode, got ', $url, $result)
            );
        }

        $keys = array_keys($json);
        $checkdata = array($type, 'payloadAttributes', 'warning', 'error');

        foreach ($checkdata as $key) {
            if (!in_array($key, $keys)) {
                throw new \RuntimeException(
                    sprintf(
                        'The data from %s does not have the key %s set', $url, $key
                    )
                );
            }
        }

        return sprintf('<info>Resweb data for %s retrieved from %s</info>', $type, $url);
    }

    /**
     * Use cURL to load a resweb resource and check it's good json
     *
     * It searches the response for 'payloadAttributes', 'warning', and 'error'
     *
     * @param mixed $url  The url of the service to access
     * @param mixed $type The type of the request, hotel, flight etc
     *
     * @throws \RuntimeException
     * @access public
     * @return void
     */
    public static function testOtaResCustomerSearch($url)
    {
        // curl --header 'Content-Type: application/json' -X POST --data "{}" http://192.168.143.167:8080/resweb/rest/hotel/getHotelAvail|python -mjson.tool

        $type = 'customer_search';
        $ch = curl_init();

        $headers = array('Content-Type: application/json',"Range=items=0-1");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);

        /*if ($post) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
            curl_setopt($ch, CURLOPT_POST, 1);
        }*/



        if (!$result = curl_exec($ch)) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to reach resweb for %s at %s, '
                      . 'cURL reported %s [%d]', $type, $url, curl_error($ch), curl_errno($ch)
                )
            );
        }

        $json = json_decode($result, true);
        if (!$json || empty($json) || count($json) == 0) {
            throw new \RuntimeException(
                sprintf('Data from %s failed to decode, got ', $url, $result)
            );
        }

        $keys = array_keys($json);
        $checkdata = array('customerSummaries');

        foreach ($checkdata as $key) {
            if (!in_array($key, $keys)) {
                throw new \RuntimeException(
                    sprintf(
                        'The data from %s does not have the key %s set', $url, $key
                    )
                );
            }
        }

        return sprintf('<info>Otares data for %s retrieved from %s</info>', $type, $url);
    }

    /**
     * Use cURL to load a resweb resource and check it's good json
     *
     * It searches the response for 'voucher' key
     *
     * @param mixed $url The url of the service to access
     *
     * @throws \RuntimeException
     * @access public
     * @return void
     */
    public static function testVouchersSearch($url)
    {
        $type = 'voucher_search';
        $ch = curl_init();

        $headers = array('Content-Type: application/json',"Range=items=0-1");

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);

        if (!$result = curl_exec($ch)) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to reach resweb for %s at %s, '
                        . 'cURL reported %s [%d]', $type, $url, curl_error($ch), curl_errno($ch)
                )
            );
        }

        $json = json_decode($result, true);
        if (!$json || empty($json) || count($json) == 0) {
            throw new \RuntimeException(
                sprintf('Data from %s failed to decode, got ', $url, $result)
            );
        }

        $keys = array_keys($json);
        $checkdata = array('voucher');

        foreach ($checkdata as $key) {
            if (!in_array($key, $keys)) {
                throw new \RuntimeException(
                    sprintf(
                        'The data from %s does not have the key %s set', $url, $key
                    )
                );
            }
        }

        return sprintf('<info>Vouchers data for %s retrieved from %s</info>', $type, $url);
    }

    /**
     * Compare value from defined symfony parameter in g4_good_params with real symfony parameter value
     *
     * @param string $url   The url of the service to access
     * @param string $value The value defined in g4_good_params array for symfony parameter
     * @param string $param Symfony parameter
     *
     * @throws \RuntimeException
     * @access public
     * @return void
     */
    public static function testResWebRelated($url, $value, $param)
    {

        if ($url != $value) {
            throw new \RuntimeException(
                sprintf(
                    'For %s is expected %s but found: %s', $param, $value, $url)
            );
        }

        return sprintf('<info>Resweb related param %s is correct: %s</info>', $param, $value);
    }

    /**
     * A version of file_get_contents that uses cURL
     *
     * I need to have the functionality but I need a timeout
     *
     * @param string $url The url to retrieve
     *
     * @throws \RuntimeException
     * @access protected
     * @return string
     */
    protected static function file_get_contents($url)
    {
        $ch = curl_init();

        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_VERBOSE, false);

        // curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
        // curl_setopt($ch, CURLOPT_POST, 1);

        if (!$result = curl_exec($ch)) {
            throw new \RuntimeException(
                sprintf(
                    'Unable to reach %s, cURL reported %s [%d]', $url, curl_error($ch), curl_errno($ch)
                )
            );
        }

        return $result;
    }

    /**
     * Load the url for a given docket and check it looks good
     *
     * It checks it's good json and that it has total_rows and rows in the
     * response
     *
     * @param mixed $url The url of the service to access
     *
     * @throws \RuntimeException
     * @access protected
     * @return void
     */
    protected static function testService($url)
    {
        $data = self::file_get_contents($url);
        if (!$data) {
            throw new \RuntimeException(sprintf('No data returned from %s', $url));
        }
        $json = json_decode($data, true);
        if (!$json || empty($json) || count($json) == 0) {
            throw new \RuntimeException(
                sprintf('Data from %s failed to decode', $url)
            );
        }
        if (!isset($json['total_rows'])) {
            throw new \RuntimeException(
                sprintf(
                    'Data from %s does not have key "total_rows"',
                    $url
                )
            );
        }
        if (!isset($json['rows'])) {
            throw new \RuntimeException(
                sprintf(
                    'Data from %s does not have key "rows"',
                    $url
                )
            );
        }
        if (!is_array($json['rows'])) {
            throw new \RuntimeException(
                sprintf(
                    'The key "rows" in the data from %s is not an array',
                    $url
                )
            );
        }

        return sprintf('Valid data retrieved from %s', $url);
    }
}

