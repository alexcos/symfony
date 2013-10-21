<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\cart;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\cart\VoucherInput
 *
 */
class VoucherInput extends RequestInput
{

    /**
     * @var string $voucherNbr
     */
    public $voucherNbr;

    /**
     * @var string $email
     */
    public $email;

    /**
     * @var string $travelCompleteDate
     */
    public $travelCompleteDate;

    /**
     * Constructor function
     * @param stdClass $data data
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    /**
     * Set voucherNbr
     *
     * @param string $voucherNbr
     */
    public function setVoucherNbr($voucherNbr)
    {
        $this->voucherNbr = $voucherNbr;
    }

    /**
     * Get voucherNbr
     *
     * @return string
     */
    public function getVoucherNbr()
    {
        return $this->voucherNbr;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get promoCode
     *
     * @return array
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $travelCompleteDate
     */
    public function setTravelCompleteDate($travelCompleteDate)
    {
        $this->travelCompleteDate = $travelCompleteDate;
    }

    /**
     * @return string
     */
    public function getTravelCompleteDate()
    {
        return $this->travelCompleteDate;
    }


}
