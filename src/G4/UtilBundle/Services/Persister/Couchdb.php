<?php

namespace G4\UtilBundle\Services\Persister;

use G4\UtilBundle\Services\Persister\Persister;

/**
 * Couchdb 
 * 
 * @uses Persister
 * @package G4.UtilBundle.Services.Persister;
 */
class Couchdb implements Persister
{
    /**
     * @var object doctrine_couchdb.odm.default_document_manager
     */
    private $dm;

    /**
     * configureConnector 
     * 
     * @param object $dm The couch db document manager
     * 
     * @access public
     * @return void
     */
    public function configureConnector($dm)
    {
        $this->dm = $dm;
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
            $document = new \G4\UtilBundle\CouchDocument\Persister();
            $document->hash = $key;
            $document->contents = $value;
            if (is_null($document->id)) {
                // new document, needs to be persisted first
                $this->dm->persist($document);
            }
            $this->dm->flush();
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
        $query = $this->dm->createQuery('stats', 'persister')
            ->setKey(sprintf('%s', $key))
            ->onlyDocs(true);
        $result = $query->execute();

        if ($result->count() > 1) {
            throw new \Exception('Too many results');
        }
        if (! $result->offsetExists(0)) {
            return null;
        }

        return ($result->offsetGet(0)->contents);
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
