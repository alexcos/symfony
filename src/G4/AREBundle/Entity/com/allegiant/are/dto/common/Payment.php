<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment
 */
class Payment
{
    const PAYMENT_TYPE_ID_VOUCHER   = 24;
    const PAYMENT_TYPE_ID_HOLD      = 21;

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\common\Address $billingAddress
     */
    public $billingAddress;

    /**
     * @var integer $paymentTypeID
     */
    public $paymentTypeID;

    /**
     * @var float $amount
     */
    public $amount;

    /**
     * @var string $voucherNbr
     */
    public $voucherNbr;

    /** @var string $email */
    public $email;

    /**
     * @var string $collectorEmployeeNbr
     */
    public $collectorEmployeeNbr;

    /**
     * @var string $collectorAirportCode
     */
    public $collectorAirportCode;

    /**
     * @var string $ccNbr
     */
    public $ccNbr;

    /**
     * @var string $ccCVV
     */
    public $ccCVV;

    /**
     * @var string $ccExpireMMYY
     */
    public $ccExpireMMYY;

    /**
     * @var string $phone
     */
    public $phone;

    /**
     * @var string $name
     */
    public $name;
    /**
     * @var string $encryptionType
     */
    public $encryptionType;

    const ENCRYPTION_TYPE_PIE = 'PIE';
    const ENCRYPTION_TYPE_NONE = 'NONE';
    const ENCRYPTION_TYPE_TOKEN = 'TOKEN';

    /**
     * Constructor function
     */
    public function __construct()
    {
        $billingAddress = new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Address();
        $billingAddress->setType(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Address::TYPE_BILLING);
        $this->setBillingAddress($billingAddress);
    }

    /**
     * Set billingAddress
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\Address $billingAddress
     */
    public function setBillingAddress(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Address $billingAddress)
    {
        $billingAddress->setType(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Address::TYPE_BILLING);
        $this->billingAddress = $billingAddress;
    }

    /**
     * Get billingAddress
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\common\Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set paymentTypeID
     *
     * @param integer $paymentTypeID
     */
    public function setPaymentTypeID($paymentTypeID)
    {
        $this->paymentTypeID = $paymentTypeID;
    }

    /**
     * Get paymentTypeID
     *
     * @return integer
     */
    public function getPaymentTypeID()
    {
        return $this->paymentTypeID;
    }

    /**
     * Set amount
     *
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
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
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set collectorEmployeeNbr
     *
     * @param string $collectorEmployeeNbr
     */
    public function setCollectorEmployeeNbr($collectorEmployeeNbr)
    {
        $this->collectorEmployeeNbr = $collectorEmployeeNbr;
    }

    /**
     * Get collectorEmployeeNbr
     *
     * @return string
     */
    public function getCollectorEmployeeNbr()
    {
        return $this->collectorEmployeeNbr;
    }

    /**
     * Set collectorAirportCode
     *
     * @param string $collectorAirportCode
     */
    public function setCollectorAirportCode($collectorAirportCode)
    {
        $this->collectorAirportCode = $collectorAirportCode;
    }

    /**
     * Get collectorAirportCode
     *
     * @return string
     */
    public function getCollectorAirportCode()
    {
        return $this->collectorAirportCode;
    }

    /**
     * Set ccNbr
     *
     * @param string $ccNbr
     */
    public function setCcNbr($ccNbr)
    {
        $this->ccNbr = $ccNbr;
    }

    /**
     * Get ccNbr
     *
     * @return string
     */
    public function getCcNbr()
    {
        return $this->ccNbr;
    }

    /**
     * Set ccCVV
     *
     * @param string $ccCVV
     */
    public function setCcCVV($ccCVV)
    {
        $this->ccCVV = $ccCVV;
    }

    /**
     * Get ccCVV
     *
     * @return string
     */
    public function getCcCVV()
    {
        return $this->ccCVV;
    }

    /**
     * Set ccExpireMMYY
     *
     * @param string $ccExpireMMYY
     */
    public function setCcExpireMMYY($ccExpireMMYY)
    {
        $this->ccExpireMMYY = $ccExpireMMYY;
    }

    /**
     * Get ccExpireMMYY
     *
     * @return string
     */
    public function getCcExpireMMYY()
    {
        return $this->ccExpireMMYY;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * Set encryptionType
     *
     * @param string $encryptionType
     */
    public function setEncryptionType($encryptionType)
    {
        $this->encryptionType = $encryptionType;
    }

    /**
     * Get encryptionType
     *
     * @return string
     */
    public function getEncryptionType()
    {
        return $this->encryptionType;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}