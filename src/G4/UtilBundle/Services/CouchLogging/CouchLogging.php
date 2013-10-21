<?php
namespace G4\UtilBundle\Services\CouchLogging;

use \Symfony\Component\DependencyInjection\ContainerAware;
/**
 * Created by JetBrains PhpStorm.
 * User: dev
 * Date: 5/3/12
 * Time: 12:49 PM
 * To change this template use File | Settings | File Templates.
 */
abstract class CouchLogging extends ContainerAware
{
    protected $serverUrl = "";

    protected $viewTimelineJson = '{
           "language": "javascript",
           "views": {
               "manifest_id": {
                   "map": "function(doc) {\n  emit(doc.manifest_id,doc)\n}"
               }
           }
        }';

    /**
     * constructor
     */
    public function __construct()
    {


    }

    /**
     * init function
     */
    public function init()
    {
        $this->serverUrl = "http://".$this->container->getParameter('couch_host_timeline') .":".$this->container->getParameter('couch_port_timeline')."/".$this->container->getParameter('couch_db_timeline') ."/";
        $this->checkConnection();
        $this->createDatabase(); //this is commented for now because clustered servers does not support db creating
    }

    /**
     * @return string
     */
    public function getServerUrl()
    {
        return $this->serverUrl;
    }

    /**
     * Check if the connection to the couch server is successful
     *
     * @abstract
     * @return bool
     */
    public function checkConnection()
    {
        $dm = $this->container->get('doctrine_couchdb.odm.default_document_manager');

        try {
            // force couch to fail if not connected
            $dm->getCouchDBClient()->getVersion();
        } catch (CouchDBException $e) {
            throw new ConnectionException('Cannot connect to CouchDB server', 0, $e);
        }
    }



}
