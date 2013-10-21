<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Seat
 */
class Seat
{


    /**
     * @var com\allegiant\are\dto\flight\SeatAdjacentInfo $adjacentInfo
     */
    public $adjacentInfo;

    /**
     * @var string $restriction
     */
    public $restriction;

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent;

    /**
     * @var array $priceComponentOptional
     */
    public $priceComponentOptional = array();

    /**
     * @var string $row
     */
    public $row;

    /**
     * @var string $col
     */
    public $col;

    /**
     * @var string $cabinCode
     */
    public $cabinCode;

    /**
     * @var com\allegiant\are\dto\common\SeatSize $size
     */
    public $size;

    /**
     * @var com\allegiant\are\dto\common\SeatPosition $position
     */
    public $position;

    /**
     * @var boolean $isExitRow
     */
    public $isExitRow;

    /**
     * @var boolean $isAvailable
     */
    public $isAvailable;

    private $enumSeatSize;

    private $enumSetPosition;

    /**
     * Constructor function
     */
    public function __construct()
    {
       $this->setAdjacentInfo(new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatAdjacentInfo());
       $this->setPriceComponent(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
       //$this->setPriceComponentOptional(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent());
       //$this->setSize(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatSize());
       $this->enumSeatSize = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightEnum("SeatSize");
       $this->enumSetPosition = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightEnum("SeatPosition");
       //$this->setPosition(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatPosition());
    }

    /**
     * Set adjacentInfo
     *
     * @param com\allegiant\are\dto\flight\SeatAdjacentInfo $adjacentInfo
     */
    public function setAdjacentInfo(\G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatAdjacentInfo $adjacentInfo)
    {
        $this->adjacentInfo = $adjacentInfo;
    }

    /**
     * Get adjacentInfo
     *
     * @return com\allegiant\are\dto\flight\SeatAdjacentInfo
     */
    public function getAdjacentInfo()
    {
        return $this->adjacentInfo;
    }

    /**
     * Set restriction
     *
     * @param string $restriction
     */
    public function setRestriction($restriction)
    {
        $this->restriction = $restriction;
    }

    /**
     * Get restriction
     *
     * @return string
     */
    public function getRestriction()
    {
        return $this->restriction;
    }

    /**
     * Set priceComponent
     *
     * @param com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public function setPriceComponent(\G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $priceComponent)
    {
        $this->priceComponent = $priceComponent;
    }

    /**
     * Get priceComponent
     *
     * @return com\allegiant\are\dto\common\PriceComponent
     */
    public function getPriceComponent()
    {
        return $this->priceComponent;
    }

    /**
     * Set PriceComponentOptional
     *
     * @param array $priceComponentOptional
     */
    public function setPriceComponentOptional(array $priceComponentOptional)
    {
        $this->priceComponentOptional = $priceComponentOptional;
    }

    /**
     * Add PriceComponentOptional
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
     * Set row
     *
     * @param string $row
     */
    public function setRow($row)
    {
        $this->row = $row;
    }

    /**
     * Get row
     *
     * @return string
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Set col
     *
     * @param string $col
     */
    public function setCol($col)
    {
        $this->col = $col;
    }

    /**
     * Get col
     *
     * @return string
     */
    public function getCol()
    {
        return $this->col;
    }

    /**
     * Set cabinCode
     *
     * @param string $cabinCode
     */
    public function setCabinCode($cabinCode)
    {
        $this->cabinCode = $cabinCode;
    }

    /**
     * Get cabinCode
     *
     * @return string
     */
    public function getCabinCode()
    {
        return $this->cabinCode;
    }

    /**
     * Set size
     *
     * @param string $size
     */
    public function setSize($size)
    {
        if ($this->enumSeatAdjacentItem->check($size)) {
            $this->size = $size;
        } else {
        }
    }

    /**
     * Get size
     *
     * @return com\allegiant\are\dto\common\SeatSize
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set position
     *
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return com\allegiant\are\dto\common\SeatPosition
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set isExitRow
     *
     * @param boolean $isExitRow
     */
    public function setIsExitRow($isExitRow)
    {
        $this->isExitRow = $isExitRow;
    }

    /**
     * Get isExitRow
     *
     * @return boolean
     */
    public function getIsExitRow()
    {
        return $this->isExitRow;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
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

}