<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightTraveler
 */
class FlightTraveler
{
    /**
     * @var array $priceComponentOptional
     */
    public $priceComponentOptional = array();

    /**
     * @var com\allegiant\are\dto\flight\FlightSpecialRequest $specialRequest
     */
    public $specialRequest;

    /**
     * @var string $travelerRPH
     */
    public $travelerRPH;

    /**
     * @var string $travelVoucherNbr
     */
    public $travelVoucherNbr;

    /**
     * Set priceComponentOptional
     *
     * @param array $priceComponentOptional
     */
    public function setPriceComponentOptional(array $priceComponentOptional)
    {
        $this->priceComponentOptional = $priceComponentOptional;
    }

    /**
     * Add priceComponentOptional
     *
     * @param PriceComponent $priceComponentOptional
     */
    public function addPriceComponentOptional(PriceComponent $priceComponentOptional)
    {
        $this->priceComponentOptional[] = $priceComponentOptional;
    }

    /**
     * Get priceComponentOptional
     *
     * @return com\allegiant\are\dto\common\PriceComponent
     */
    public function getPriceComponentOptional()
    {
        return $this->priceComponentOptional;
    }

    /**
     * Set specialRequest
     *
     * @param com\allegiant\are\dto\flight\FlightSpecialRequest $specialRequest
     */
    public function addSpecialRequest(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightSpecialRequest $specialRequest)
    {
        $this->specialRequest[] = $specialRequest;
    }

    /**
     * Set specialRequest
     *
     * @param array $items items of type com\allegiant\are\dto\flight\FlightSpecialRequest
     */
    public function setSpecialRequest(array $items)
    {
        $this->specialRequest = $items;
    }

    /**
     * Get specialRequest
     *
     * @return com\allegiant\are\dto\flight\FlightSpecialRequest
     */
    public function getSpecialRequest()
    {
        return $this->specialRequest;
    }

    /**
     * Set travelerRPH
     *
     * @param string $travelerRPH
     */
    public function setTravelerRPH($travelerRPH)
    {
        $this->travelerRPH = $travelerRPH;
    }

    /**
     * Get travelerRPH
     *
     * @return string
     */
    public function getTravelerRPH()
    {
        return $this->travelerRPH;
    }

    /**
     * Set travelVoucherNbr
     *
     * @param string $travelVoucherNbr
     */
    public function setTravelVoucherNbr($travelVoucherNbr)
    {
        $this->travelVoucherNbr = $travelVoucherNbr;
    }

    /**
     * Get travelVoucherNbr
     *
     * @return string
     */
    public function getTravelVoucherNbr()
    {
        return $this->travelVoucherNbr;
    }

    /**
     * Finds a PriceComponent by its code
     *
     * @param string $code The code value (BPP, BAP, etc)
     *
     * @return array
     */
    public function findPriceComponentOptionalByCode($code)
    {
        $results = array();

        /** @var $priceComponentOptional PriceComponent */
        foreach ($this->getPriceComponentOptional() as $priceComponentOptional) {
            if ($priceComponentOptional->getCode() == $code) {
                $results[] = $priceComponentOptional;
            }
        }

        return $results;
    }

    /**
     * Finds the first PriceComponent by its code
     *
     * @param string $code The code value (BPP, BAP, etc)
     *
     * @return PriceComponent
     */
    public function findOnePriceComponentOptionalByCode($code)
    {
        $results = $this->findPriceComponentOptionalByCode($code);

        if (count($results)) {
            return $results[0];
        }

        return null;
    }

    /**
     * Find a price component optional by it's code and count value from the property object
     *
     * @param string $code  The code value (BPP, BAP, etc)
     * @param int    $count The count value (2, 3, etc)
     *
     * @return PriceComponent
     */
    public function findPriceComponentOptionalByCodeAndCount($code, $count)
    {
        $filteredPriceComponents = $this->findPriceComponentOptionalByCode($code);

        /** @var $priceComponent PriceComponent */
        foreach ($filteredPriceComponents as $priceComponent) {
            if ($priceComponent->propertyMatches('count', $count)) {
                return $priceComponent;
            }
        }

        return null;
    }
}