<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\RequestSeatInput
 */
class RequestSeatInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{

    /**
     * @var com\allegiant\are\dto\flight\SeatRequest $seatRequest
     */
    public $seatRequest;

	/**
     * Constructor function
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
        $this->setSeatRequest(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatRequest());
    }

	/**
     * Set seatRequest
     *
     * @param com\allegiant\are\dto\flight\SeatRequest $seatRequest
     */
    public function setSeatRequest(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatRequest $seatRequest)
    {
        $this->seatRequest = $seatRequest;
    }
}