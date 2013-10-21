<?php
namespace G4\UtilBundle\Entity\Lookup\Market;

/**
 * Class Validity
 *
 * @package G4\UtilBundle\Entity\Lookup\Market
 */
class Validity
{
    public $from;
    public $to;

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }


}