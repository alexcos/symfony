<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\BookCartOutput
 */
class BookCartOutput
{


    /**
     * @var com\allegiant\are\dto\cart\Cart $cart
     */
    public $cart;


    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setCart(new \G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart());
    }

    /**
     * Set cart
     *
     * @param com\allegiant\are\dto\cart\Cart $cart
     */
    public function setCart(\G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart $cart)
    {
        $this->cart = $cart;
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