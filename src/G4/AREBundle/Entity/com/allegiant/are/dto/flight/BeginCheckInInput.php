<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\BeginCheckInInput
 */
class BeginCheckInInput extends RequestInput
{

    /**
     * @var integer $journeyId
     */
    public $journeyId;

    /**
     * @var string $confNbr
     */
    public $confNbr;

	/**
     * Constructor function
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    /**
     * @param string $confNbr
     */
    public function setConfNbr($confNbr)
    {
        $this->confNbr = $confNbr;
    }

    /**
     * @return string
     */
    public function getConfNbr()
    {
        return $this->confNbr;
    }

    /**
     * @param int $journeyId
     */
    public function setJourneyId($journeyId)
    {
        $this->journeyId = $journeyId;
    }

    /**
     * @return int
     */
    public function getJourneyId()
    {
        return $this->journeyId;
    }
}