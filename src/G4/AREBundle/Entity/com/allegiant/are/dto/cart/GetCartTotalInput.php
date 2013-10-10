<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\GetCartTotalInput
 */
class GetCartTotalInput extends RequestInput
{


    /**
     * @var array $cart items of type \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart
     */
    public $cart;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->cart = array();
    }

    /**
     * Set cart
     *
     * @param com\allegiant\are\dto\cart\Cart $cart
     */
    public function addCart(\G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart $cart)
    {
        $this->cart[] = $cart;
    }

    /**
     * Set cart
     *
     * @param array $items items of type \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart
     */
    public function setCart(array $items)
    {
        $this->cart = $items;
    }

    /**
     * Get cart
     *
     * @return com\allegiant\are\dto\cart\Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
}