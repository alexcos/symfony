<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\GetCartInput
 */
class GetCartInput
{


    /**
     * @var integer $cartID
     */
    public $cartID;


    /**
     * Constructor function
     */
    public function __construct()
    {
    }

    /**
     * Set cartID
     *
     * @param integer $cartID
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
}