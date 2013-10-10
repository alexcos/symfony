<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\SeatAdjacentInfo
 */
class SeatAdjacentInfo
{


    /**
     * @var com\allegiant\are\dto\common\SeatAdjacentItem $front
     */
    public $front;

    /**
     * @var com\allegiant\are\dto\common\SeatAdjacentItem $back
     */
    public $back;

    /**
     * @var com\allegiant\are\dto\common\SeatAdjacentItem $left
     */
    public $left;

    /**
     * @var com\allegiant\are\dto\common\SeatAdjacentItem $right
     */
    public $right;

    /**
     * @var com\allegiant\are\dto\common\SeatAdjacentItem $across
     */
    public $across;

    private $enumSeatAdjacentItem;

    /**
     * Constructor function
     */
    public function __construct()
    {
        $this->enumSeatAdjacentItem = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightEnum("SeatAdjacentItem");
/*        $this->setFront(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem());
        $this->setBack(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem());
        $this->setLeft(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem());
        $this->setRight(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem());
        $this->setAcross(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem());
*/
    }

    /**
     * Set front
     *
     * @param com\allegiant\are\dto\common\SeatAdjacentItem $front
     */
    public function setFront($front)
    {
        if ($this->enumSeatAdjacentItem->check($front)) {
            $this->front = $front;
        } else {
        }
    }

    /**
     * Get front
     *
     * @return com\allegiant\are\dto\common\SeatAdjacentItem
     */
    public function getFront()
    {
        return $this->front;
    }

    /**
     * Set back
     *
     * @param com\allegiant\are\dto\common\SeatAdjacentItem $back
     */
    public function setBack(\G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem $back)
    {
        if ($this->enumSeatAdjacentItem->check($back)) {
            $this->back = $back;
        } else {
        }
    }

    /**
     * Get back
     *
     * @return com\allegiant\are\dto\common\SeatAdjacentItem
     */
    public function getBack()
    {
        return $this->back;
    }

    /**
     * Set left
     *
     * @param com\allegiant\are\dto\common\SeatAdjacentItem $left
     */
    public function setLeft(\G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem $left)
    {
        if ($this->enumSeatAdjacentItem->check($left)) {
            $this->left = $left;
        } else {
        }

    }

    /**
     * Get left
     *
     * @return com\allegiant\are\dto\common\SeatAdjacentItem
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set right
     *
     * @param com\allegiant\are\dto\common\SeatAdjacentItem $right
     */
    public function setRight(\G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem $right)
    {
        if ($this->enumSeatAdjacentItem->check($right)) {
            $this->right = $right;
        } else {
        }

    }

    /**
     * Get right
     *
     * @return com\allegiant\are\dto\common\SeatAdjacentItem
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set across
     *
     * @param com\allegiant\are\dto\common\SeatAdjacentItem $across
     */
    public function setAcross(\G4\AREBundle\Entity\com\allegiant\are\dto\common\SeatAdjacentItem $across)
    {
        if ($this->enumSeatAdjacentItem->check($across)) {
            $this->across = $across;
        } else {
        }

    }

    /**
     * Get across
     *
     * @return com\allegiant\are\dto\common\SeatAdjacentItem
     */
    public function getAcross()
    {
        return $this->across;
    }
}