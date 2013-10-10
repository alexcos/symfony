<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;
use G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartConfirmRequest;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\SendConfirmationInput
 *
 * @see http://192.168.143.167:8080/resweb/cart?xsd=1
 */
class SendConfirmationInput extends RequestInput
{

    /**
     * @var array $cartConfirmRequest objects of type CartConfirmRequest
     */
    public $cartConfirmRequest;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->cartConfirmRequest = array();
    }

    /**
     * Add cartConfirmRequest
     * @param CartConfirmRequest $cartConfirmRequest
     */
    public function addCartConfirmRequest(CartConfirmRequest $cartConfirmRequest)
    {
        $this->cartConfirmRequest[] = $cartConfirmRequest;
    }

    /**
     * Set cartConfirmRequest
     *
     * @param array $items items of type CartConfirmRequest
     */
    public function setCartConfirmRequest(array $items)
    {
        $this->cartConfirmRequest = $items;
    }

    /**
     * Get cartConfirmRequest
     *
     * @return array
     */
    public function getCartConfirmRequest()
    {
        return $this->cartConfirmRequest;
    }

}
