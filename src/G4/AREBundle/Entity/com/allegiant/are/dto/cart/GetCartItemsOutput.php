<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\GetCartItemsOutput
 */
class GetCartItemsOutput
{


    /**
     * @var com\allegiant\are\dto\common\PriceComponent $cartItem
     */
    public $cartItem;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $cartItemOptional
     */
    public $cartItemOptional;


    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setCartItem(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
        $this->setCartItemOptional(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
    }

    /**
     * Set cartItem
     *
     * @param com\allegiant\are\dto\common\PriceComponent $cartItem
     */
    public function setCartItem(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    /**
     * Get cartItem
     *
     * @return com\allegiant\are\dto\common\PriceComponent
     */
    public function getCartItem()
    {
        return $this->cartItem;
    }

    /**
     * Set cartItemOptional
     *
     * @param com\allegiant\are\dto\common\PriceComponent $cartItemOptional
     */
    public function setCartItemOptional(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $cartItemOptional)
    {
        $this->cartItemOptional = $cartItemOptional;
    }

    /**
     * Get cartItemOptional
     *
     * @return com\allegiant\are\dto\common\PriceComponent
     */
    public function getCartItemOptional()
    {
        return $this->cartItemOptional;
    }
}