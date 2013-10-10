<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartPayment
 */
class CartPayment
{
    /**
     * @var Payment $payment
     */
    public $payment;

    /**
     * @var boolean $storeCard
     */
    public $storeCard;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setPayment(new Payment());
    }

    /**
     * Set payment
     *
     * @param Payment $payment
     */
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get payment
     *
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set storeCard
     *
     * @param boolean $storeCard
     */
    public function setStoreCard($storeCard)
    {
        $this->storeCard = $storeCard;
    }

    /**
     * Get storeCard
     *
     * @return boolean
     */
    public function getStoreCard()
    {
        return $this->storeCard;
    }
}