<?php
namespace G4\UtilBundle\Services\CouchLogging;
/**
 * Created by JetBrains PhpStorm.
 * User: dev
 * Date: 5/3/12
 * Time: 11:56 AM
 * To change this template use File | Settings | File Templates.
 */
class LogSymfonyODM extends CouchLogging implements CouchLoggingInterface
{
    private $odmClient;

    /**
     * init function
     */
    public function init()
    {
        $this->odmClient = $this->container->get('doctrine_couchdb.client.timelinelog_connection');
        parent::init();
    }

    /**
     * @param string $data   data to write in the couch server
     * @param bool   $needId weather we need the response of the couch server
     *
     * @return response|null
     */
    public function writeLog($data,$needId = false)
    {
        $res = $this->odmClient->postDocument(json_decode($data, true));

        if ($needId) {
            return $res[0];
        }
    }

    /**
     * @return bool
     */
    public function createDatabase()
    {
        $dbs = $this->odmClient->getAllDatabases();
        $urlArray = parse_url($this->serverUrl);
        if ($urlArray===false) {
            throw new \Exception(sprintf("Malformed Couch url %s", $this->serverUrl));
        }

        $newDb = $this->container->getParameter('couch_db_timeline');

        if (!in_array($newDb, $dbs)) {
            $res = $this->odmClient->createDatabase($newDb);

            //we now create the view
            $this->odmClient->createDesignDocument("manifest_id", new G4DesignDocument($this->viewTimelineJson));
        }



    }
}
