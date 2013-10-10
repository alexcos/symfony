<?php

namespace G4\UtilBundle\Services\Persister;

use G4\UtilBundle\Services\Persister\Persister;

/**
 * Couchbase persister
 * 
 * @uses Persister
 * @package G4.UtilBundle.Services.Persister
 * @author  Georgiana Gligor <g@lolaent.com>
 */
class Couchbase implements Persister
{
    /**
     * @var \Couchbase
     */
    protected $storage;

    /**
     * Instantiates the connector configuration.
     *
     * @param string $host   connection host
     * @param string $port   connection port
     * @param string $user   connection user
     * @param string $pass   connection password
     * @param string $bucket name of the bucket to connect to
     *
     * @return void
     */
    public function configureConnector($host, $port, $user, $pass, $bucket)
    {
        $this->storage = new \Couchbase(sprintf('%s:%s', $host, $port), $user, $pass, $bucket);
    }

    /**
     * set 
     * 
     * @param mixed $key   The key to set
     * @param mixed $value The value of the Key
     * 
     * @access public
     * @return Boolean True if the key was set false otherwise
     */
    public function set($key, $value)
    {
        try {
            $this->storage->set($key, $value);
        } catch (\RuntimeException $e) {
            $this->error = $e;

            return false;
        }

        return true;
    }

    /**
     * get 
     * 
     * @param string $key The key to retrieve
     * 
     * @access public
     * @return The vale of the key
     */
    public function get($key)
    {
        return ($this->storage->get($key));
    }

    /**
     * Creates a key for the couch document
     * 
     * @param string $hash      The hash used in this request
     * @param string $component The component
     * @param string $type      The search type
     * @param string $format    The request format
     * 
     * @access public
     * @return string The key for the document storage
     */
    public function configureKey($hash, $component, $type, $format)
    {
        return sprintf('%s_%s_%s_%s', $hash, $component, $type, $format);
    }

    /**
     * Retrieves the storage connection
     *
     * @return \Couchbase
     */
    public function getStorage()
    {
        return $this->storage;
    }

}
