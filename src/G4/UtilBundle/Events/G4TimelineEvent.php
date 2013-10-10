<?php
namespace G4\UtilBundle\Events;

use Symfony\Component\EventDispatcher\Event;
/**
 * Created by JetBrains PhpStorm.
 * User: dev
 * Date: 5/23/12
 * Time: 10:42 AM
 * To change this template use File | Settings | File Templates.
 */
class G4TimelineEvent extends LoggingEvent
{
    protected $hash;
    protected $data;

    /**
     * @param string $manifestId  manifestID
     * @param string $data  data
     * @param string $class class
     */
    public function __construct($manifestId, $data, $class)
    {
        parent::__construct(
            $manifestId,
            sprintf('G4TimelineEvent for %s', $manifestId),
            $mask = 'timeline',
            $context = array('hash' => $manifestId),
            $data
        );
        $this->hash = $manifestId;
        $this->data = $data;
        $this->setClass($class);
    }

    /**
     * @return string
     */
    public function gethash()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
