<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\TravelerProfile;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\GetCartItemsInput
 *
 * @see http://50.57.78.111:7074/resweb/cart?xsd=7
 */
class GetCartItemsInput extends RequestInput
{

    /**
     * @var TravelerProfile
     */
    public $travelerProfile;

    /**
     * @var array $flightNbr
     */
    public $flightNbr;

    /**
     * @var array $promoCode
     */
    public $promoCode;

    /**
     * @var array $marketID
     */
    public $marketID;

    /**
     * @var array $paymentTypeID
     */
    public $paymentTypeID;

    /**
     * @var string $travelStartDate
     */
    public $travelStartDate;

    /**
     * @var string $travelEndDate
     */
    public $travelEndDate;

    /**
     * @var float $cartTotalAmount
     */
    public $cartTotalAmount;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setTravelerProfile(new TravelerProfile());
    }

    /**
     * Set travelerProfile
     *
     * @param TravelerProfile $travelerProfile
     */
    public function setTravelerProfile(TravelerProfile $travelerProfile)
    {
        $this->travelerProfile = $travelerProfile;
    }

    /**
     * Get travelerProfile
     *
     * @return TravelerProfile
     */
    public function getTravelerProfile()
    {
        return $this->travelerProfile;
    }

    /**
     * Set flightNbr
     *
     * @param array $flightNbr
     */
    public function setFlightNbr(array $flightNbr)
    {
        $this->flightNbr = $flightNbr;
    }

    /**
     * Add flight number to request
     *
     * @param string $flightNbr the flight number
     */
    public function addFlightNbr($flightNbr)
    {
        $this->flightNbr[] = $flightNbr;
    }

    /**
     * Get flightNbr
     *
     * @return array
     */
    public function getFlightNbr()
    {
        return $this->flightNbr;
    }

    /**
     * Set promoCode
     *
     * @param array $promoCode
     */
    public function setPromoCode(array $promoCode)
    {
        $this->promoCode = $promoCode;
    }

    /**
     * Add promoCode
     *
     * @param string $promoCode
     */
    public function addPromoCode($promoCode)
    {
        $this->promoCode[] = $promoCode;
    }

    /**
     * Get promoCode
     *
     * @return array
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set marketID
     *
     * @param array $marketID
     */
    public function setMarketID(array $marketID)
    {
        $this->marketID = $marketID;
    }

    /**
     * Add marketID
     *
     * @param integer $marketID
     */
    public function addMarketID($marketID)
    {
        $this->marketID[] = $marketID;
    }

    /**
     * Get marketID
     *
     * @return integer
     */
    public function getMarketID()
    {
        return $this->marketID;
    }

    /**
     * Set paymentTypeID
     *
     * @param array $paymentTypeID
     */
    public function setPaymentTypeID(array $paymentTypeID)
    {
        $this->paymentTypeID = $paymentTypeID;
    }

    /**
     * Add paymentTypeID
     *
     * @param integer $paymentTypeID
     */
    public function addPaymentTypeID($paymentTypeID)
    {
        $this->paymentTypeID[] = $paymentTypeID;
    }

    /**
     * Get paymentTypeID
     *
     * @return integer
     */
    public function getPaymentTypeID()
    {
        return $this->paymentTypeID;
    }

    /**
     * Set travelStartDate
     *
     * @param string $travelStartDate
     */
    public function setTravelStartDate($travelStartDate)
    {
        $this->travelStartDate = $travelStartDate;
    }

    /**
     * Get travelStartDate
     *
     * @return string
     */
    public function getTravelStartDate()
    {
        return $this->travelStartDate;
    }

    /**
     * Set travelEndDate
     *
     * @param string $travelEndDate
     */
    public function setTravelEndDate($travelEndDate)
    {
        $this->travelEndDate = $travelEndDate;
    }

    /**
     * Get travelEndDate
     *
     * @return string
     */
    public function getTravelEndDate()
    {
        return $this->travelEndDate;
    }

    /**
     * Set cartTotalAmount
     *
     * @param float $cartTotalAmount
     */
    public function setCartTotalAmount($cartTotalAmount)
    {
        $this->cartTotalAmount = $cartTotalAmount;
    }

    /**
     * Get cartTotalAmount
     *
     * @return float
     */
    public function getCartTotalAmount()
    {
        return $this->cartTotalAmount;
    }

}
