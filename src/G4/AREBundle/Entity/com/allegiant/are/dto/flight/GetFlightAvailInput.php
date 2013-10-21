<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\SerializedName;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\GetFlightAvailInput
 */
class GetFlightAvailInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{

    /**
     * @var array $flightVoucher
     */
    public $flightVoucher;

    /**
     * @var string $promoCode
     */
    public $promoCode;

    /**
     * @var G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTravelerProfile $travelerProfile
     */


    public $travelerProfile;

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter $classOfService
     */
    public $classOfService;

    /**
     * array of com\allegiant\are\dto\flight\Flight entities
     * @var ArrayColection $flight
     */
    public $flight;

    /**
     * array of com\allegiant\are\dto\flight\DepartArriveRequest instances
     * @var array $departArriveRequest
     */
    public $departArriveRequest;

    /**
     * @var string $airportOfOrigin
     */
    public $airportOfOrigin;

    /**
     * @var integer $maxStops
     */
    public $maxStops;

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->flightVoucher = array();
        parent::__construct();
        $this->setTravelerProfile(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTravelerProfile());
        $this->setClassOfService(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter());
        $this->setDepartArriveRequest(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\DepartArriveRequest());
        $this->flight = array();
    }

    /**
     * Set flightVoucher
     *
     * @param string $flightVoucher
     */
    public function setFlightVoucher($flightVoucher)
    {
        $this->flightVoucher[] = $flightVoucher;
    }

    /**
     * Get flightVoucher
     *
     * @return string 
     */
    public function getFlightVoucher()
    {
        return $this->flightVoucher;
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
     * Set travelerProfile
     *
     * @param com\allegiant\are\dto\flight\FlightTravelerProfile $travelerProfile
     */
    public function setTravelerProfile(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTravelerProfile $travelerProfile)
    {
        $this->travelerProfile = $travelerProfile;
    }

    /**
     * Get travelerProfile
     *
     * @return com\allegiant\are\dto\flight\FlightTravelerProfile 
     */
    public function getTravelerProfile()
    {
        return $this->travelerProfile;
    }

    /**
     * Set classOfService
     *
     * @param com\allegiant\are\dto\flight\Filter $classOfService
     */
    public function setClassOfService(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter $classOfService)
    {
        $this->classOfService = $classOfService;
    }

    /**
     * Get classOfService
     *
     * @return com\allegiant\are\dto\flight\Filter 
     */
    public function getClassOfService()
    {
        return $this->classOfService;
    }

    /**
     * Add flight
     * @param com\allegiant\are\dto\flight\Flight $flight
     * @return void
     */
    public function addFlight(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\Flight $flight = null)
    {
        if (is_null($flight)) {
            return;
        }
        $this->flight[] = $flight;
    }

    /**
     * Set flight
     * array of com\allegiant\are\dto\flight\Flight instences
     * @param array $flight
     * @return void
     */
    public function setFlight($flight = null)
    {
        $this->flight = $flight;
    }

    /**
     * Get flight
     *
     * @return array
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * Add departArriveRequest
     *
     * @param com\allegiant\are\dto\flight\DepartArriveRequest $departArriveRequest
     */
    public function addDepartArriveRequest(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\DepartArriveRequest $departArriveRequest = null)
    {
        $this->departArriveRequest[] = $departArriveRequest;
    }

    /**
     * Set departArriveRequest
     * array of com\allegiant\are\dto\flight\DepartArriveRequest instances
     * @param array $departArriveRequest
     */
    public function setDepartArriveRequest($departArriveRequest = null)
    {
        $this->departArriveRequest = $departArriveRequest;
    }

    /**
     * Get departArriveRequest
     *
     * @return com\allegiant\are\dto\flight\DepartArriveRequest 
     */
    public function getDepartArriveRequest()
    {
        return $this->departArriveRequest;
    }


    /**
     * Set departArriveRequests
     *
     * @param string $departArriveRequests
     */
    public function setDepartArriveRequests($departArriveRequests)
    {
        $this->departArriveRequest = $departArriveRequests;
    }

    /**
     * Set airportOfOrigin
     *
     * @param string $airportOfOrigin
     */
    public function setAirportOfOrigin($airportOfOrigin)
    {
        $this->airportOfOrigin = $airportOfOrigin;
    }

    /**
     * Get airportOfOrigin
     *
     * @return string 
     */
    public function getAirportOfOrigin()
    {
        return $this->airportOfOrigin;
    }

    /**
     * Set maxStops
     *
     * @param integer $maxStops
     */
    public function setMaxStops($maxStops)
    {
        $this->maxStops = $maxStops;
    }

    /**
     * Get maxStops
     *
     * @return integer 
     */
    public function getMaxStops()
    {
        return $this->maxStops;
    }
}
