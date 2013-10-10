<?php

/**
 * Stats event package
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Events.Stat
 *
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Events\Stat;

/**
 * Resweb stat event
 */
class ReswebStatEvent extends \G4\UtilBundle\Events\StatEvent
{

    /**
     * Class constructor
     *
     * @param string $manifestId    manifest identifier
     * @param string $url           the resweb connection url
     * @param string $pairKey       The pair key
     * @param string $executionTime how long it took to execute the event
     */
    public function __construct($manifestId, $url, $pairKey, $executionTime)
    {
        $mask = $this->extractMask($url);

        parent::__construct($manifestId, $mask, $pairKey, $executionTime);
    }

    /**
     * Extracts the operation name from the resweb url
     * example: from http://192.168.143.167:8080/resweb/rest/hotel/getHotelAvail we extract just getHotelAvail
     *
     * @param string $url The resweb connection URL
     *
     * @return string
     */
    private function extractMask($url)
    {
        $pieces = explode('/', $url);
        if (! count($pieces)) {
            return 'NoMask4ReswebStat';
        }

        return array_pop($pieces);
    }

}
