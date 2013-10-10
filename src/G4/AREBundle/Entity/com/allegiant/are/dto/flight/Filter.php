<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\flight;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;

/**
 * @ExclusionPolicy("none")
 * G4\AREBundle\Entity\com\allegiant\are\dto\flight\Filter
 */
class Filter
{


    /**
     * @var array $value
     */
    public $value;

    /**
     * @var com\allegiant\are\dto\common\FilterType $type
     */
    public $type;


    /** @Exclude */
    private $enumFilterType;

    /**
     * class constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->value = array();
        $this->enumFilterType = new \G4\AREBundle\Entity\com\allegiant\are\dto\flight\FlightEnum("FilterType");
        //$this->setType(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\FilterType());
    }

    /**
     * Set value
     *
     * @param string $value value
     *
     * @return void
     */
    public function setValue($value)
    {
        if (is_array($value)) {
            $value = array_merge($this->value, $value);
        } elseif(isset($value) and $value!="") {
            $value = array($value);
        } else {
            $value = array();
        }
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set type
     *
     * @param com\allegiant\are\dto\common\FilterType $type type
     *
     * @return void
     */
    public function setType($type)
    {
        if ($this->enumFilterType->check($type)) {
            $this->type = $type;
        } else {
        }
    }

    /**
     * Get type
     *
     * @return com\allegiant\are\dto\common\FilterType
     */
    public function getType()
    {
        return $this->type;
    }
}