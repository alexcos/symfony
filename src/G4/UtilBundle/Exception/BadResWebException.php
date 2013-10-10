<?php
/**
 * PHP version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Exception
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for poor JSON returned from resweb
 */
class BadResWebException extends G4Exception
{
    private $_requestURL;
    private $_lastJSON;
    private $_error;

    /**
     * Create a new exception for bad resweb data
     * 
     * @param ServicesCall $service The service that threw the error
     * @param string       $results The results that did not pass
     * @param string       $key     The key used to identify the request
     * 
     * @access public
     * @return void
     */
    public function __construct($service, $results, $key)
    {
        parent::__construct(
            sprintf(
                'Bad Res Web response (%s) for url %s',
                $service->error,
                $service->getRequestURL()
            ),
            $key
        );
        $this->setJson($results);
        $this->_requestURL = $service->getRequestURL();
        $this->_lastJSON   = $service->getLastJSON();
        $this->_error      = $service->error;
        $this->results     = $results;
    }

    /**
     * Returns exception message with additional context information.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            'Bad Res Web Data returned from %s [$s]',
            $this->_requestURL,
            $this->results
        );
    }

    /**
     * toArray 
     * 
     * @access public
     * @return string
     */
    public function toArray()
    {
        $arr1 = parent::toArray();
        $arr2 = array(
            'url'      => $this->_requestURL,
            'json'     => $this->_lastJSON,
            'error'    => $this->_error,
            'response' => $this->results,
        );
        $arr3 = array_merge($arr1, $arr2);
        return $arr3;
    }
}
