<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\profile;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\profile\GetMyTripOutput
 */
class GetMyTripOutput
{


    /**
     * @var com\allegiant\are\dto\profile\JourneySet $journeySet
     */
    public $journeySet;

    /**
     * @var com\allegiant\are\dto\profile\CreditVoucher $creditVoucher
     */
    public $creditVoucher;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setJourneySet(new \G4\AREBundle\Entity\com\allegiant\are\dto\profile\JourneySet());
        $this->setCreditVoucher(new \G4\AREBundle\Entity\com\allegiant\are\dto\profile\CreditVoucher());
    }

    /**
     * Set journeySet
     *
     * @param com\allegiant\are\dto\profile\JourneySet $journeySet
     */
    public function setJourneySet(\G4\AREBundle\Entity\com\allegiant\are\dto\profile\JourneySet $journeySet)
    {
        $this->journeySet = $journeySet;
    }

    /**
     * Get journeySet
     *
     * @return com\allegiant\are\dto\profile\JourneySet
     */
    public function getJourneySet()
    {
        return $this->journeySet;
    }

    /**
     * Set creditVoucher
     *
     * @param com\allegiant\are\dto\profile\CreditVoucher $creditVoucher
     */
    public function setCreditVoucher(\G4\AREBundle\Entity\com\allegiant\are\dto\profile\CreditVoucher $creditVoucher)
    {
        $this->creditVoucher = $creditVoucher;
    }

    /**
     * Get creditVoucher
     *
     * @return com\allegiant\are\dto\profile\CreditVoucher
     */
    public function getCreditVoucher()
    {
        return $this->creditVoucher;
    }
}