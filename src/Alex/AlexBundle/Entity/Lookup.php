<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/8/13
 * Time: 2:46 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Alex\AlexBundle\Entity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\SerializedName;
use Doctrine\Common\Collections\ArrayCollection;


/** @ExclusionPolicy("none")
 * Class Lookup
 * @package Alex\AlexBundle\Entity
 */
class Lookup {

    /**
     *
     * @Type("ArrayCollection<Alex\AlexBundle\Entity\CustomerRole>")
     *
     */
    private $CustomerRole;
    /**
     * @Type("array")
     *
     */
    private $CustomerType;
    /**
     * @Type("array")
     */
    private $Channel;
    /**
     * @Type("array")
     */
    private $GITransaction;
    /**
     * @Type("array")
     */
    private $FopType;
    /**
     * @Type("array")
     */
    private $Country;
    /**
     * @Type("array")
     */
    private $PhoneType;
    /**
     * @Type("array")
     */
    private $OverrideReason;
    /**
     * @Type("array")
     */
    private $CustomerAddressType;
    /**
     * @Type("array")
     */
    private $State;
    /**
     * @Type("array")
     */
    private $SpecialRequestType;
    /**
     * @Type("array")
     */
    private $OrganizationType;
    /**
     * @Type("array")
     */
    private $OrderFee;
    /**
     * @Type("array")
     */
    private $Gender;
    /**
     * @Type("array")
     */
    private $CancelReason;
    /**
     * @Type("array")
     */
    private $CustomerPermission;
    /**
     * @Type("array")
     */
    private $VoucherType;
    /**
     * @Type("array")
     */
    private $DocumentType;
    /**
     * @Type("array")
     */
    private $CustomerProgramStatus;
    /**
     * @Type("array")
     */
    private $AuthType;


    public function __construct() {
        $this->setCustomerRole(new ArrayCollection());
    }


    /**
     * @param mixed $AuthType
     */
    public function setAuthType($AuthType)
    {
        $this->AuthType = $AuthType;
    }

    /**
     * @return mixed
     */
    public function getAuthType()
    {
        return $this->AuthType;
    }

    /**
     * @param mixed $CancelReason
     */
    public function setCancelReason($CancelReason)
    {
        $this->CancelReason = $CancelReason;
    }

    /**
     * @return mixed
     */
    public function getCancelReason()
    {
        return $this->CancelReason;
    }

    /**
     * @param mixed $Channel
     */
    public function setChannel($Channel)
    {
        $this->Channel = $Channel;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->Channel;
    }

    /**
     * @param mixed $Country
     */
    public function setCountry($Country)
    {
        $this->Country = $Country;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->Country;
    }

    /**
     * @param mixed $CustomerAddressType
     */
    public function setCustomerAddressType($CustomerAddressType)
    {
        $this->CustomerAddressType = $CustomerAddressType;
    }

    /**
     * @return mixed
     */
    public function getCustomerAddressType()
    {
        return $this->CustomerAddressType;
    }

    /**
     * @param mixed $CustomerPermission
     */
    public function setCustomerPermission($CustomerPermission)
    {
        $this->CustomerPermission = $CustomerPermission;
    }

    /**
     * @return mixed
     */
    public function getCustomerPermission()
    {
        return $this->CustomerPermission;
    }

    /**
     * @param mixed $CustomerProgramStatus
     */
    public function setCustomerProgramStatus($CustomerProgramStatus)
    {
        $this->CustomerProgramStatus = $CustomerProgramStatus;
    }

    /**
     * @return mixed
     */
    public function getCustomerProgramStatus()
    {
        return $this->CustomerProgramStatus;
    }

    /**
     * @param mixed $CustomerRole
     */
    public function setCustomerRole($CustomerRole)
    {
        $this->CustomerRole = $CustomerRole;
    }

    /**
     * @return mixed
     */
    public function getCustomerRole()
    {
        return $this->CustomerRole;
    }

    /**
     * @param mixed $CustomerType
     */
    public function setCustomerType($CustomerType)
    {
        $this->CustomerType = $CustomerType;
    }

    /**
     * @return mixed
     */
    public function getCustomerType()
    {
        return $this->CustomerType;
    }

    /**
     * @param mixed $DocumentType
     */
    public function setDocumentType($DocumentType)
    {
        $this->DocumentType = $DocumentType;
    }

    /**
     * @return mixed
     */
    public function getDocumentType()
    {
        return $this->DocumentType;
    }

    /**
     * @param mixed $FopType
     */
    public function setFopType($FopType)
    {
        $this->FopType = $FopType;
    }

    /**
     * @return mixed
     */
    public function getFopType()
    {
        return $this->FopType;
    }

    /**
     * @param mixed $GITransaction
     */
    public function setGITransaction($GITransaction)
    {
        $this->GITransaction = $GITransaction;
    }

    /**
     * @return mixed
     */
    public function getGITransaction()
    {
        return $this->GITransaction;
    }

    /**
     * @param mixed $Gender
     */
    public function setGender($Gender)
    {
        $this->Gender = $Gender;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->Gender;
    }

    /**
     * @param mixed $OrderFee
     */
    public function setOrderFee($OrderFee)
    {
        $this->OrderFee = $OrderFee;
    }

    /**
     * @return mixed
     */
    public function getOrderFee()
    {
        return $this->OrderFee;
    }

    /**
     * @param mixed $OrganizationType
     */
    public function setOrganizationType($OrganizationType)
    {
        $this->OrganizationType = $OrganizationType;
    }

    /**
     * @return mixed
     */
    public function getOrganizationType()
    {
        return $this->OrganizationType;
    }

    /**
     * @param mixed $OverrideReason
     */
    public function setOverrideReason($OverrideReason)
    {
        $this->OverrideReason = $OverrideReason;
    }

    /**
     * @return mixed
     */
    public function getOverrideReason()
    {
        return $this->OverrideReason;
    }

    /**
     * @param mixed $PhoneType
     */
    public function setPhoneType($PhoneType)
    {
        $this->PhoneType = $PhoneType;
    }

    /**
     * @return mixed
     */
    public function getPhoneType()
    {
        return $this->PhoneType;
    }

    /**
     * @param mixed $SpecialRequestType
     */
    public function setSpecialRequestType($SpecialRequestType)
    {
        $this->SpecialRequestType = $SpecialRequestType;
    }

    /**
     * @return mixed
     */
    public function getSpecialRequestType()
    {
        return $this->SpecialRequestType;
    }

    /**
     * @param mixed $State
     */
    public function setState($State)
    {
        $this->State = $State;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->State;
    }

    /**
     * @param mixed $VoucherType
     */
    public function setVoucherType($VoucherType)
    {
        $this->VoucherType = $VoucherType;
    }

    /**
     * @return mixed
     */
    public function getVoucherType()
    {
        return $this->VoucherType;
    }



}