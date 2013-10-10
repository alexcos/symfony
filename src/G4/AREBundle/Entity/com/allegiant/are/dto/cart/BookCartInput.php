<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\BookCartInput
 */
class BookCartInput
{


    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart $cart
     */
    public $cart;

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartPayment $payment
     */
    public $payment;

    /**
     * @var string $promoCode
     */
    public $promoCode;

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\common\PayLoadAttributes
     */
    public $payloadAttributes;
    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile
     */
    public $callerInfo;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->setCart(new \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart());
        $this->setPayment(new \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartPayment());
    }

    /**
     * Set cart
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart $cart
     */
    public function setCart(\G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get cart
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Set payment
     *
     * @param CartPayment $payment
     */
    public function setPayment(CartPayment $payment)
    {
        $this->payment[] = $payment;
    }

    /**
     * Get payment
     *
     * @return array
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * overwrite payment
     *
     * @param array $payments \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartPayment instances
     */
    public function overwritePayment(array $payments)
    {
        $this->payment = $payments;
    }


    /**
     * Set promoCode
     *
     * @param string $promoCode
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


        /**
     * Set payloadAttributes
     *
     * @param string $payloadAttributes
     */
    public function setPayloadAttributes($payloadAttributes)
    {
        $this->payloadAttributes = $payloadAttributes;
    }

    /**
     * Get payloadAttributes
     *
     * @return PayLoadAttributes
     */
    public function getPayloadAttributes()
    {
        return $this->payloadAttributes;
    }

    /**
     * Sets the caller info
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile $callerInfo
     *
     * @return void
     */
    public function setCallerInfo($callerInfo)
    {
        $this->callerInfo = $callerInfo;
    }

    /**
     * Retrieve caller info
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\common\UserProfile
     */
    public function getCallerInfo()
    {
        return $this->callerInfo;
    }
}