<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Entity
 */
namespace G4\UtilBundle\Entity;

/**
 * ReswebUrl class
 *
 * @author Victor Vacaretu <victor@cloudtroopers.ro>
 */
class ReswebUrl
{
    /**
     * @var string the main resweb url
     */
    public $main;

    /**
     * @var string the flight url
     */
    public $flight;

    /**
     * @var string the hotel url
     */
    public $hotel;

    /**
     * @var string the product url
     */
    public $product;

    /**
     * @var string the transport url
     */
    public $transport;

    /**
     * @var string the seatmap url
     */
    public $seatmap;

    /**
     * @var string the cart url
     */
    public $cart;

    /**
     * Getter function for main
     *
     * @return string the main url
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Setter function for main
     *
     * @param string $main
     */
    public function setMain($main)
    {
        $this->main = $main;
    }

    /**
     * Getter function for flight
     *
     * @return string the flight url
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * Setter function for flight
     *
     * @param string $flight
     */
    public function setFlight($flight)
    {
        $this->flight = $flight;
    }

    /**
     * Getter function for hotel
     *
     * @return string the hotel url
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Setter function for hotel
     *
     * @param string $hotel
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * Getter function for vehicle
     *
     * @return string the vehicle url
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Setter function for vehicle
     *
     * @param string $vehicle
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Getter function for transport
     *
     * @return string the transport url
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Setter function for transport
     *
     * @param string $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * Getter function for Product
     *
     * @return string the product url
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Setter function for Product
     *
     * @param string $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * Getter function for seatmap
     *
     * @return string the seatmap url
     */
    public function getSeatmap()
    {
        return $this->seatmap;
    }

    /**
     * Setter function for vehicle
     *
     * @param string $seatmap
     */
    public function setSeatmap($seatmap)
    {
        $this->seatmap = $seatmap;
    }

    /**
     * Getter function for cart
     *
     * @return string the cart url
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Setter function for cart
     *
     * @param string $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }


}

