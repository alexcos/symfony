<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\Comment;
use G4\AREBundle\Entity\com\allegiant\are\dto\product\BookProductResInput;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler;
use G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartResInfo;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\Cart
 */
class Cart
{


    /**
     * @var G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler $traveler
     */
    public $traveler = array();

    /**
     * @var CartResInfo $cartResInfo
     */
    public $cartResInfo;

    /**
     * @var G4\AREBundle\Entity\com\allegiant\are\dto\flight\BookFlightResInput $flightRes
     */
    public $flightRes;

    /**
     * @var G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput $hotelRes
     */
    public $hotelRes;

    /**
     * @var G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\BookVehicleResInput $vehicleRes
     */
    public $vehicleRes;

    /**
     * @var array $productRes items of type G4\AREBundle\Entity\com\allegiant\are\dto\product\BookProductResInput
     */
    public $productRes;

    /**
     * @var array $cartItem items of type G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent
     */
    public $cartItem;

    /**
     * @var PriceComponent $cartItemSelected
     */
    public $cartItemSelected;

    /**
     * @var string $promoCode
     */
    public $promoCode;

    /**
     * @var Comment $comment
     */
    public $comment;

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\common\Customer $customer
     */
    public $customer;

    /**
     * @var string $RPH
     */
    public $rph;

    /**
     * @var integer $cartStatusID
     */
    public $cartStatusID;

    /**
     * @var integer $cartID
     */
    public $cartID;

    /**
     * @var string $cartNbr
     */
    public $cartNbr;

    /**
     * @var string $bookedByEmpNbr
     */
    public $bookedByEmpNbr;

    /**
     * @var integer $marketID
     */
    public $marketID;

    /**
     * @var string $bookDateTime
     */
    public $bookDateTime;

    /**
     * @var string The travel agent name
     */
    public $bookedByName;

    /**
     * @var string The travel agent IATA number
     */
    public $bookedByNbr;

    /**
     * Constructor function
     */
    public function __construct()
    {
        //$this->setTraveler(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler());
        //$this->setCartResInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartResInfo());
        $this->setFlightRes(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\BookFlightResInput());
        //$this->setHotelRes(new \G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput());
        $this->setVehicleRes(new \G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\BookVehicleResInput());
        $this->productRes = array();
        $this->cartItem = array();
        //$this->setCartItemSelected(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
        //$this->setComment(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Comment());
        $this->setCustomer(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Customer());
    }

    /**
     * Set traveler
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\Traveler $traveler
     */
    public function addTraveler(Traveler $traveler)
    {
        $this->traveler[] = $traveler;
    }

    /**
     * Set traveler
     *
     * @param array $items
     */
    public function setTraveler(array $items)
    {
        $this->traveler = $items;
    }

    /**
     * Get traveler
     *
     * @return Traveler
     */
    public function getTraveler()
    {
        return $this->traveler;
    }

    /**
     * Set cartResInfo
     *
     * @param CartResInfo $cartResInfo
     */
    public function setCartResInfo(CartResInfo $cartResInfo)
    {
        $this->cartResInfo = $cartResInfo;
    }

    /**
     * Get cartResInfo
     *
     * @return CartResInfo
     */
    public function getCartResInfo()
    {
        return $this->cartResInfo;
    }

    /**
     * Set flightRes
     *
     * @param G4\AREBundle\Entity\com\allegiant\are\dto\flight\BookFlightResInput $flightRes
     */
    public function setFlightRes($flightRes) //\G4\AREBundle\Entity\com\allegiant\are\dto\flight\BookFlightResInput
    {
        $this->flightRes = $flightRes;
    }

    /**
     * Get flightRes
     *
     * @return G4\AREBundle\Entity\com\allegiant\are\dto\flight\BookFlightResInput
     */
    public function getFlightRes()
    {
        return $this->flightRes;
    }

    /**
     * Set hotelRes
     *
     * @param G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput $hotelRes
     */
    public function setHotelRes(array $hotelRes) //\G4\AREBundle\Entity\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput
    {
        $this->hotelRes = $hotelRes;
    }

    /**
     * Add hotelRes
     *
     * @param G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput $hotelRes
     */
    public function addHotelRes(\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput $hotelRes) //\G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput
    {
        $this->hotelRes[] = $hotelRes;
    }

    /**
     * Get hotelRes
     *
     * @return G4\AREBundle\Entity\com\allegiant\are\dto\hotel\BookHotelResInput
     */
    public function getHotelRes()
    {
        return $this->hotelRes;
    }

    /**
     * Set vehicleRes
     *
     * @param com\allegiant\are\dto\vehicle\BookVehicleResInput $vehicleRes
     */
    public function setVehicleRes(\G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\BookVehicleResInput $vehicleRes)
    {
        $this->vehicleRes[] = $vehicleRes;
    }

    /**
     * Get vehicleRes
     *
     * @return G4\AREBundle\Entity\com\allegiant\are\dto\vehicle\BookVehicleResInput
     */
    public function getVehicleRes()
    {
        return $this->vehicleRes;
    }

    /**
     * add productRes
     *
     * @param com\allegiant\are\dto\product\BookProductResInput $item
     */
    public function addProductRes(BookProductResInput $item)
    {
        $this->productRes[] = $item;
    }

    /**
     * Set productRes
     *
     * @param array $items items of type G4\AREBundle\Entity\com\allegiant\are\dto\product\BookProductResInput
     */
    public function setProductRes(array $items)
    {
        $this->productRes = $productRes;
    }

    /**
     * Get productRes
     *
     * @return G4\AREBundle\Entity\com\allegiant\are\dto\product\BookProductResInput
     */
    public function getProductRes()
    {
        return $this->productRes;
    }

    /**
     * add cartItem
     *
     * @param PriceComponent $cartItem
     */
    public function addCartItem(PriceComponent $cartItem)
    {
        $this->cartItem[] = $cartItem;
    }

    /**
     * Set cartItem
     *
     * @param array $items items of type PriceComponent
     */
    public function setCartItem(array $items)
    {
        $this->cartItem = $items;
    }

    /**
     * Get cartItem
     *
     * @return array
     */
    public function getCartItem()
    {
        return $this->cartItem;
    }

    /**
     * Add cartItemSelected
     *
     * @param PriceComponent $cartItemSelected
     */
    public function addCartItemSelected(PriceComponent $cartItemSelected)
    {
        $this->cartItemSelected[] = $cartItemSelected;
    }

    /**
     * Set cartItemSelected
     *
     * @param array $items
     */
    public function setCartItemSelected(array $items)
    {
        $this->cartItemSelected = $items;
    }

    /**
     * Get cartItemSelected
     *
     * @return array
     */
    public function getCartItemSelected()
    {
        return $this->cartItemSelected;
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
     * Set comment
     *
     * @param $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Add a comment to the comments array
     *
     * @param Comment $comment
     */
    public function addComment(Comment $comment)
    {
        $this->comment[] = $comment;
    }

    /**
     * Get comment
     *
     * @return array
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set customer
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\Customer $customer
     */
    public function setCustomer(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get customer
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\common\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set rph
     *
     * @param string $rPH
     */
    public function setRPH($rPH)
    {
        $this->rph = $rPH;
    }

    /**
     * Get RPH
     *
     * @return string
     */
    public function getRPH()
    {
        return $this->rph;
    }

    /**
     * Set cartStatusID
     *
     * @param integer $cartStatusID
     */
    public function setCartStatusID($cartStatusID)
    {
        $this->cartStatusID = $cartStatusID;
    }

    /**
     * Get cartStatusID
     *
     * @return integer
     */
    public function getCartStatusID()
    {
        return $this->cartStatusID;
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

    /**
     * Set cartNbr
     *
     * @param string $cartNbr
     */
    public function setCartNbr($cartNbr)
    {
        $this->cartNbr = $cartNbr;
    }

    /**
     * Get cartNbr
     *
     * @return string
     */
    public function getCartNbr()
    {
        return $this->cartNbr;
    }

    /**
     * Set bookedByEmpNbr
     *
     * @param string $bookedByEmpNbr
     */
    public function setBookedByEmpNbr($bookedByEmpNbr)
    {
        $this->bookedByEmpNbr = $bookedByEmpNbr;
    }

    /**
     * Get bookedByEmpNbr
     *
     * @return string
     */
    public function getBookedByEmpNbr()
    {
        return $this->bookedByEmpNbr;
    }

    /**
     * Set marketID
     *
     * @param integer $marketID
     */
    public function setMarketID($marketID)
    {
        $this->marketID = $marketID;
    }

    /**
     * Get marketID
     *
     * @return integer
     */
    public function getMarketID()
    {
        return $this->marketID;
    }

    /**
     * Set bookDateTime
     *
     * @param string $bookDateTime
     */
    public function setBookDateTime($bookDateTime)
    {
        $this->bookDateTime = $bookDateTime;
    }

    /**
     * Get bookDateTime
     *
     * @return string
     */
    public function getBookDateTime()
    {
        return $this->bookDateTime;
    }

    /**
     * Setter for booked by name
     *
     * @param string $bookedByName
     */
    public function setBookedByName($bookedByName)
    {
        $this->bookedByName = $bookedByName;
    }

    /**
     * Getter for booked by name
     *
     * @return string
     */
    public function getBookedByName()
    {
        return $this->bookedByName;
    }

    /**
     * Setter for booked by Nbr
     *
     * @param string $bookedByNbr
     */
    public function setBookedByNbr($bookedByNbr)
    {
        $this->bookedByNbr = $bookedByNbr;
    }

    /**
     * Getter for booked by Nbr
     *
     * @return string
     */
    public function getBookedByNbr()
    {
        return $this->bookedByNbr;
    }
}