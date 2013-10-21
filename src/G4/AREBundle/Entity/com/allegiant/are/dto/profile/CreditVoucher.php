<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\profile;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\profile\CreditVoucher
 */
class CreditVoucher
{


    /**
     * @var string $voucher
     */
    public $voucher;

    /**
     * @var string $issueDate
     */
    public $issueDate;

    /**
     * @var string $expireDate
     */
    public $expireDate;

    /**
     * @var float $issueAmount
     */
    public $issueAmount;

    /**
     * @var float $balance
     */
    public $balance;

    /**
     * @var string $itineraryNumber
     */
    public $itineraryNumber;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Set voucher
     *
     * @param string $voucher
     */
    public function setVoucher($voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Get voucher
     *
     * @return string
     */
    public function getVoucher()
    {
        return $this->voucher;
    }

    /**
     * Set issueDate
     *
     * @param string $issueDate
     */
    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;
    }

    /**
     * Get issueDate
     *
     * @return string
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * Set expireDate
     *
     * @param string $expireDate
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
    }

    /**
     * Get expireDate
     *
     * @return string
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set issueAmount
     *
     * @param float $issueAmount
     */
    public function setIssueAmount($issueAmount)
    {
        $this->issueAmount = $issueAmount;
    }

    /**
     * Get issueAmount
     *
     * @return float
     */
    public function getIssueAmount()
    {
        return $this->issueAmount;
    }

    /**
     * Set balance
     *
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set itineraryNumber
     *
     * @param string $itineraryNumber
     */
    public function setItineraryNumber($itineraryNumber)
    {
        $this->itineraryNumber = $itineraryNumber;
    }

    /**
     * Get itineraryNumber
     *
     * @return string
     */
    public function getItineraryNumber()
    {
        return $this->itineraryNumber;
    }
}