<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\GetCartTotalOutput
 */
class GetCartTotalOutput
{


    /**
     * @var com\allegiant\are\dto\cart\CartTotal $cartTotal
     */
    public $cartTotal;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->setCartTotal(new \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartTotal());
    }

    /**
     * Set cartTotal
     *
     * @param com\allegiant\are\dto\cart\CartTotal $cartTotal
     */
    public function setCartTotal(\G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartTotal $cartTotal)
    {
        $this->cartTotal = $cartTotal;
    }

    /**
     * Get cartTotal
     *
     * @return com\allegiant\are\dto\cart\CartTotal
     */
    public function getCartTotal()
    {
        return $this->cartTotal;
    }
}