<?php

/**
 * Allegiant G4 search backend package.
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.CouchDocument
 */
namespace G4\UtilBundle\CouchDocument;

use Doctrine\ODM\CouchDB\Mapping\Annotations as CouchDB;

/**
 * logged data
 *
 * @author Georgiana Gligor <georgiana@lolaent.com>
 *
 * @CouchDB\Document
 */
class Persister
{

    /** @CouchDB\Id */
    public $id;

    /** @CouchDB\Field(type="string") */
    public $hash;

    /** @CouchDB\Field(type="string") */
    public $contents;

    /** @CouchDB\Field(type="datetime") */
    public $timestamp;

    /**
     * Class constructor
     *
     * @return \G4\UtilBundle\CouchDocument\Persister
     */
    public function __construct()
    {
        $this->timestamp = new \DateTime("now");
    }

    /**
     * Prepare the entity timestamp for display
     *
     * @return string
     */
    public function getTimestampDisplay()
    {
        if (is_null($this->timestamp)) {
            return '';
        }

        return $this->timestamp->format('c');
    }

    /**
     * Provide a string representation of the current class instance
     *
     * @return string 
     */
    public function __toString()
    {
        return sprintf(
            '{"hash":"%s", "created": "%s", "contents":"%s"}',
            $this->hash,
            $this->getTimestampDisplay(),
            $this->contents
        );
    }

}
