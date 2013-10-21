<?php

namespace G4\UtilBundle\Services\Persister;

// TODO extract these to a PersisterBundle

/**
 * Persister 
 * 
 * @package G4.UtilBundle.Services.Persister
 */
interface Persister
{

    /**
     * set 
     * 
     * @param string $key   The key to set
     * @param string $value The value to place in memcache
     * 
     * @access public
     * @return boolean
     */
    public function set($key, $value);

    /**
     * get 
     * 
     * @param string $key The key to get
     * 
     * @access public
     * @return string The key to get
     */
    public function get($key);

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
    public function configureKey($hash, $component, $type, $format);

}
