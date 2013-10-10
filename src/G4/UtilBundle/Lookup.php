<?php
/**
 * Created by JetBrains PhpStorm.
 * User: serbanbajdechi
 * Date: 8/5/13
 * Time: 1:48 PM
 * To change this template use File | Settings | File Templates.
 */

namespace G4\UtilBundle;


use G4\UtilBundle\Exception\OtaLookupException;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Base lookup class
 *
 * @package G4\UtilBundle
 */
class Lookup extends ContainerAware
{
    protected $typeName = 'response';
    protected $url;
    /**
     * Fetch data from lookup url
     *
     * @param string $url
     *
     * @return mixed
     */
    public function execute(ServicesCall $c)
    {
        $results = $c->execute();

        $curlInfo = $c->getInfoNo($this->typeName);
        if ($curlInfo['http_code'] != 200) {
            $description = '';
            switch ($curlInfo['http_code']) {
                case 0:
                    $description = sprintf('Lookup could not reach `%s`', $curlInfo['url']);
                    break;
                case 404:
                    $description = sprintf('Lookup could not get any data from `%s`, received 404 http code', $curlInfo['url']);
                    break;
                case 500:
                    $description = sprintf('Lookup could not get any data from `%s` probably lookup service internal error, received 500 http code', $curlInfo['url']);
                    break;
                default:
                    $description = sprintf('Unrecognized http code received at %s', $curlInfo['url']);
                    break;
            }

            throw new OtaLookupException(
                500,
                ErrorMapper::WRONG_REQUEST,
                'META',
                'Lookup',
                $description
            );
        }

        return json_decode($results[$this->typeName]);
    }
}