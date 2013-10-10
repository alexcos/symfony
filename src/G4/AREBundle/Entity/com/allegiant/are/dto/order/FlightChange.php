<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\order;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\order\OrderChange
 */
class FlightChange
{

    const ADD_PREPAID_BAG = 'ADD_PREPAID_BAG';
    const ADD_AIRPORT_BAG = 'ADD_AIRPORT_BAG'; // in practice, it's difficult to buy an airport bag online :-)
    const ADD_PREPAID_CARRYON = 'ADD_PREPAID_CARRYON';
    const ADD_SEAT_SELECTION = 'ADD_SEAT_SELECTION';
    const ADD_PRIORITY_BOARDING = 'ADD_PRIORITY_BOARDING';

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $quotedPrice
     */
    public $quotedPrice;

    /**
     * @var string $rph
     */
    public $rph;

    /**
     * @var string $type
     */
    public $type;

    /**
     * @var integer $journeyId
     */
    public $journeyId;

    /**
     * @var integer $flightTravelerId
     */
    public $flightTravelerId;

    /**
     * @var string $flightNbr
     */
    public $flightNbr;

	/**
     * Set quotedPrice
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $quotedPrice
     */
    public function setQuotedPrice(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $quotedPrice)
    {
        $this->quotedPrice = $quotedPrice;
    }

}
