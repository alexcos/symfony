<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\BookFlightResOutput
 */
class BookFlightResOutput
{

    /**
     * @var com\allegiant\are\dto\flight\TripResInfo $tripResInfo
     */
    public $tripResInfo;

    /**
     * @var integer $cartID
     */
    public $cartID;

    /**
     * @var string $promoCode
     */
    public $promoCode;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setTripResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\TripResInfo());
    }

    /**
     * Set tripResInfo
     *
     * @param com\allegiant\are\dto\flight\TripResInfo $tripResInfo trip res information
     *
     * @return void
     */
    public function setTripResInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\TripResInfo $tripResInfo)
    {
        $this->tripResInfo = $tripResInfo;
    }

    /**
     * Get tripResInfo
     *
     * @return com\allegiant\are\dto\flight\TripResInfo 
     */
    public function getTripResInfo()
    {
        return $this->tripResInfo;
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