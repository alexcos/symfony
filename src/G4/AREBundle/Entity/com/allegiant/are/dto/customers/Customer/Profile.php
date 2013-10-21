<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer;

/**
 * Class Profile
 *
 * @package G4\AREBundle\Entity\com\allegiant\are\dto\customers\Customer
 */
class Profile
{
    /** @var string */
    public $preferredDepartAirport;

    /** @var bool */
    public $receiveNewsletter;

    /** @var string */
    public $iata;

    /** @var string */
    public $redressNbr;

    /** @var array */
    public $preferredDestinations;

    /**
     * @param string $iata
     */
    public function setIata($iata)
    {
        $this->iata = $iata;
    }

    /**
     * @return string
     */
    public function getIata()
    {
        return $this->iata;
    }

    /**
     * @param string $preferredDepartAirport
     */
    public function setPreferredDepartAirport($preferredDepartAirport)
    {
        $this->preferredDepartAirport = $preferredDepartAirport;
    }

    /**
     * @return string
     */
    public function getPreferredDepartAirport()
    {
        return $this->preferredDepartAirport;
    }

    /**
     * @param array $preferredDestinations
     */
    public function setPreferredDestinations($preferredDestinations)
    {
        $this->preferredDestinations = $preferredDestinations;
    }

    /**
     * @return array
     */
    public function getPreferredDestinations()
    {
        return $this->preferredDestinations;
    }

    /**
     * @param boolean $receiveNewsletter
     */
    public function setReceiveNewsletter($receiveNewsletter)
    {
        $this->receiveNewsletter = $receiveNewsletter;
    }

    /**
     * @return boolean
     */
    public function getReceiveNewsletter()
    {
        return $this->receiveNewsletter;
    }

    /**
     * @param string $redressNbr
     */
    public function setRedressNbr($redressNbr)
    {
        $this->redressNbr = $redressNbr;
    }

    /**
     * @return string
     */
    public function getRedressNbr()
    {
        return $this->redressNbr;
    }


}