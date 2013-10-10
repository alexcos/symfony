<?php

namespace G4\UtilBundle\Services\Persister;

use G4\UtilBundle\Services\Persister\Persister;
use G4\UtilBundle\Exception\MemcacheException;

/**
 * Memcache
 *
 * @package G4.UtilBundle.Services.Persister
 */
class Memcache implements Persister
{
    public $memcache;
    public $timeoutData;
    public $error;
    public $maxTries;
    public $sleep;

    /**
     *  constructor
     */
    public function __construct()
    {
        $this->memcache = new \Memcache();
    }

    /**
     * configureConnector
     *
     * @param array         $listHosts   The memcache servers, as configured in 'g4_memcache_server_address'
     * @param array|integer $portData    The port number
     * @param integer       $timeoutData The data time-to-live
     * @param integer       $retry       Retry count for connection
     *
     * @access public
     * @return void
     */
    public function configureConnector(array $listHosts, $portData, $timeoutData, $retry=0)
    {
        $listPorts = $this->alignPorts($listHosts, $portData);
        $listFailedConnections = array();

        foreach ($listHosts as $index => $ip) {
            $host = $listHosts[$index];
            $port = $listPorts[$index];
            $serverKey = $host . ':' . $port;

            $this->memcache->addServer($host, $port);
//fwrite(STDOUT, sprintf('Adding server %s:%s' . "\n", $host, $port));
            $stats = @$this->memcache->getExtendedStats();
            $available = (bool) $stats[$serverKey];

            if (! $available || ! @$this->memcache->connect($host, $port)) {
                $listFailedConnections[] = $serverKey;
            }
        }

        // no server is available for connections
        if (count($listFailedConnections) == count($listHosts)) {
            if ($retry < $this->maxTries) {
                sleep($this->sleep);
                $this->memcache = new \Memcache(); //rebuild object so addServer would not seg fault
                $this->configureConnector($listHosts, $portData, $timeoutData, $retry + 1);
            } else {
                throw new MemcacheException(sprintf('Cannot connect to memcache server(s) %s', implode(', ', $listFailedConnections)));
            }
        }

        // only 1 timeout, no matter how many servers
        $this->timeoutData = $timeoutData;
    }

    /**
     * @param int $maxTries set max tries
     * @param int $sleep    set sleep duration between tries
     */
    public function setRetryParameters($maxTries, $sleep)
    {
        $this->maxTries = $maxTries;
        $this->sleep = $sleep;
    }

    /**
     * @param array         $listHosts
     * @param array|integer $portData
     *
     * @return array
     */
    public function alignPorts(array $listHosts, $portData)
    {
        if (is_array($portData)) {
            $listPorts = $portData;
        } else {
            $listPorts = array_pad(array($portData), count($listHosts), $portData);
        }

        return $listPorts;
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
        // Use compression for strings only.
        // @see http://php.net/manual/en/memcache.set.php#100971
        $compression = is_string($value) ? MEMCACHE_COMPRESSED : false;

        try {
            $set = $this->memcache->set(
                $key,
                $value,
                $compression,
                $this->timeoutData
            );
            if (!$set) {
                throw new \RuntimeException("Cannot write data into memcache");
            }
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
        return $this->memcache->get($key);
    }

    /**
     * delete 
     * 
     * @param string $key The key to delete
     * 
     * @access public
     * @return Boolean True if the key was deleted
     */
    public function delete($key)
    {
        $this->memcache->delete($key, 0);
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

}
