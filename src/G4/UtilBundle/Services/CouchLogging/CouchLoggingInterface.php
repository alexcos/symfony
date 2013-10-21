<?php
namespace G4\UtilBundle\Services\CouchLogging;
/**
 * Created by JetBrains PhpStorm.
 * User: dev
 * Date: 5/3/12
 * Time: 11:54 AM
 * To change this template use File | Settings | File Templates.
 */
interface CouchLoggingInterface
{
    /**
     * constructor
     */
    public function __construct();

    /**
     * Check if the connection to the couch server is successful
     *
     * @abstract
     * @return bool
     */
    public function checkConnection();

    /**
     * @param string $data   data to write in the couch server
     * @param bool   $needId weather we need the response of the couch server
     *
     * @return response|null
     */
    public function writeLog($data,$needId = false);

    /**
     * @return bool
     */
    public function createDatabase();


}
