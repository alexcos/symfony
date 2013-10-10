<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartConfirmRequest
 *
 * @see http://192.168.143.167:8080/resweb/cart?xsd=1
 */
class CartConfirmRequest
{

    /**
     * @var type Cart $cart optional
     */
    public $cart;

    /**
     * @var array $toEmailAddress mandatory
     */
    public $toEmailAddress;

    /**
     * @var array $ccEmailAddress optional
     */
    public $ccEmailAddress;

    /**
     * @var integer $rph mandatory
     */
    public $rph;

    /**
     * @var string $cartNbr mandatory
     */
    public $cartNbr;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->cart = null;
        $this->toEmailAddress = array();
        $this->ccEmailAddress = null;
        $this->rph = 0; // yes, it works with 0 in case you forget to populate it
        $this->cartNbr = "";
    }

    /**
     * Set cartConfirmRequest
     * @param CartConfirmRequest $cartConfirmRequest
     */
    public function setCartConfirmRequest(CartConfirmRequest $cartConfirmRequest)
    {
        $this->cartConfirmRequest = $cartConfirmRequest;
    }

    /**
     * Get cartConfirmRequest
     *
     * @return CartConfirmRequest
     */
    public function getCartConfirmRequest()
    {
        return $this->cartConfirmRequest;
    }

    /**
     * add toEmailAddress
     *
     * @param string $email
     *
     * @return void
     */
    public function addToEmailAddress($email)
    {
        $this->toEmailAddress[] = $email;
    }

    /**
     * set toEmailAddress
     *
     * @param array $items
     *
     * @return void
     */
    public function setToEmailAddress(array $items)
    {
        $this->toEmailAddress = $items;
    }

    /**
     * get toEmailAddress
     *
     * @return array
     */
    public function getToEmailAddress()
    {
        return ($this->toEmailAddress);
    }

    /**
     * set rph
     *
     * @param integer $rph
     *
     * @return void
     */
    public function setRPH($rph)
    {
        $this->rph = $rph;
    }

    /**
     * get rph
     *
     * @return integer
     */
    public function getRPH()
    {
        return ($this->rph);
    }

    /**
     * set cartNbr
     *
     * @param string $cartNbr
     *
     * @return void
     */
    public function setCartNbr($cartNbr)
    {
        $this->cartNbr = $cartNbr;
    }

    /**
     * get cartNbr
     *
     * @return string
     */
    public function getCartNbr()
    {
        return ($this->cartNbr);
    }

}
