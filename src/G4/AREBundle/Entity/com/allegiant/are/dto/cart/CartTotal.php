<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartTotal
 */
class CartTotal
{


    /**
     * @var string $RPH
     */
    public $RPH;

    /**
     * @var float $cartTotal
     */
    public $cartTotal;

    /**
     * Constructor function
     */
    public function __construct()
    {
    }

    /**
     * Set RPH
     *
     * @param string $rPH
     */
    public function setRPH($rPH)
    {
        $this->RPH = $rPH;
    }

    /**
     * Get RPH
     *
     * @return string
     */
    public function getRPH()
    {
        return $this->RPH;
    }

    /**
     * Set cartTotal
     *
     * @param float $cartTotal
     */
    public function setCartTotal($cartTotal)
    {
        $this->cartTotal = $cartTotal;
    }

    /**
     * Get cartTotal
     *
     * @return float
     */
    public function getCartTotal()
    {
        return $this->cartTotal;
    }
}