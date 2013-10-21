<?php
namespace G4\UtilBundle\Services\CouchLogging;

use Doctrine\ODM\CouchDB\View;
/**
 *  Document for creating views
 */
class G4DesignDocument implements \Doctrine\CouchDB\View\DesignDocument
{
    private $data = "";

    /**
     * @param string $data json_encoded data
     */
    public function __construct($data)
    {
         $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return json_decode($this->data, true);
    }
}
