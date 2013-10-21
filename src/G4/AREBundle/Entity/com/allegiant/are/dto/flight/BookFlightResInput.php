<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\BookFlightResInput
 */
class BookFlightResInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{

    /**
     * @var com\allegiant\are\dto\flight\JourneySet $trip
     */
    public $trip;

    /**
     * @var com\allegiant\are\dto\common\Traveler $traveler
     */
    public $traveler;

    /**
     * @var integer $cartID
     */
    public $cartID;

    /**
     * @var string $promoCode
     */
    public $promoCode;

    public $callerInfo;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        //$this->promoCode=array();
        $this->setTrip(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\JourneySet());
        $this->traveler = array();
    }

    /**
     * Set trip
     *
     * @param com\allegiant\are\dto\flight\JourneySet $trip journey set
     *
     * @return void
     */
    public function setTrip(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\JourneySet $trip)
    {
        $this->trip = $trip;
    }

    /**
     * Get trip
     *
     * @return com\allegiant\are\dto\flight\JourneySet
     */
    public function getTrip()
    {
        return $this->trip;
    }

    /**
     * Set traveler
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler $traveler traveler
     *
     * @return void
     */
    public function addTraveler(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler $traveler)
    {
        $this->traveler[] = $traveler;
    }

    /**
     * Set traveler
     *
     * @param array $items traveler items of type com\allegiant\are\dto\common\Traveler $traveler
     *
     * @return void
     */
    public function setTraveler(array $items)
    {
        $this->traveler = $items;
    }

    /**
     * Get traveler
     *
     * @return com\allegiant\are\dto\common\Traveler
     */
    public function getTraveler()
    {
        return $this->traveler;
    }

    /**
     * Set cartID
     *
     * @param integer $cartID cart identifier
     *
     * @return void
     */
    public function setCartID($cartID)
    {
        $this->cartID = $cartID;
    }

    /**
     * Get cartID
     *
     * @return integer
     */
    public function getCartID()
    {
        return $this->cartID;
    }

    /**
     * Set promoCode
     *
     * @param string $promoCode promotional code
     *
     * @return void
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;
    }

    /**
     * Get promoCode
     *
     * @return string
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }
}