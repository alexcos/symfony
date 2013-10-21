<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\CompleteCheckInInput
 */
class CompleteCheckInInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{

    /**
     * @var integer $journeyId
     */
    public $journeyId;

    /**
     * @var integer $flightTravelerId
     */
    public $flightTravelerId;

	/**
     * Constructor function
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }
}