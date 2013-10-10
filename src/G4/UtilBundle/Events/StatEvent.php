<?php
/**
 * Stats event package
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Events
 *
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Events;

/**
 * Stats events, indicating time elapsed for performing a certain operation
 */
class StatEvent extends LoggingEvent
{

    /**
     * @var string The pairKey value so that we can match the event with the resweb request and response events
     */
    private $pairKey = null;

    /**
     * Class constructor
     *
     * @param string $manifestId    manifest identifier
     * @param string $mask          syslog mask
     * @param string $pairKey       The pair key
     * @param string $executionTime how long execution took
     */
    public function __construct($manifestId, $mask, $pairKey, $executionTime)
    {
        $context = array(
            'executionTime' => $executionTime,
        );
        $data = array();

        parent::__construct($manifestId, sprintf('StatEvent for %s', $manifestId), $mask, $context, $data);

        $this->data = $data;
        $this->setPairKey($pairKey);
    }

    /**
     * Setter method for pairKey
     *
     * @param string $pairKey
     */
    public function setPairKey($pairKey)
    {
        $this->pairKey = $pairKey;
    }

    /**
     * Getter method for pairKey
     *
     * @return string
     */
    public function getPairKey()
    {
        return $this->pairKey;
    }


}
