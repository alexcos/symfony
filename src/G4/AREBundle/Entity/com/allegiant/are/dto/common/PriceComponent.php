<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\common;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent
 */
class PriceComponent
{
    const CODE_TOTAL = 'TOTAL';     // total price
    const CODE_BPP   = 'BPP';       // bags per person          -> bought online
    const CODE_BBB   = 'BBB';       // carry-on / bin bags      -> bought online
    const CODE_BAP   = 'BAP';       // airport bags             -> bought at the airport
    const CODE_ABB   = 'ABB';       // airport carry on bags    -> bought at the airport
    const CODE_SSR   = 'SSR';       // special service request
    const CODE_SF    = 'SF';        // seat selection fee
    const CODE_PB    = 'PB';        // priority boarding
    const CODE_CCV   = 'CCV';       // convenience fee
    const CODE_TP    = 'TP';        // trip flex, aka Trip Protection
    const CODE_CH    = 'CH';        // how much it costs to change the flight if user didn't buy TripFlex
    const CODE_DCD   = 'DCD';       // The Debit card discount code
    const CODE_BC    = 'BC';        // the Booking Fee
    const CODE_BKA   = 'BKA';       // Air Base Fare

    /**
     * @var com\allegiant\are\dto\common\PriceComponent $priceComponent
     */
    public $priceComponent = array();

    /**
     * @var array $tag
     */
    public $tag = array();

    /**
     * @var array $property items of type \G4\AREBundle\Entity\com\allegiant\are\dto\common\Property
     */
    public $property = array();

    /**
     * @var string $code
     */
    public $code;

    /**
     * @var string $source
     */
    public $source;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var float $value
     */
    public $value = 0;

    /**
     * class constructor
     */
    public function __construct()
    {
        $this->property = array();
    }

    /**
     * Add priceComponent
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\PriceComponent $priceComponent price component
     *
     * @return void
     */
    public function addPriceComponent($priceComponent)
    {
        $this->priceComponent[] = $priceComponent;
    }

    public function setPriceComponent(array $items)
    {
        $this->priceComponent = $items;
    }

    /**
     * Get priceComponent
     *
     * @return array
     */
    public function getPriceComponent()
    {
        return $this->priceComponent;
    }

    /**
     * Set tag
     *
     * @param array $tag tag
     *
     * @return void
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Add tag
     *
     * @param $tag
     */
    public function addTag($tag)
    {
        $this->tag[] = $tag;
    }

    /**
     * Get tag
     *
     * @return array
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Add property
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\Property $property property
     *
     * @return void
     */
    public function addProperty(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Property $property)
    {
        $this->property[] = $property;
    }

    /**
     * Set property
     *
     * @param array $items elements of type \G4\AREBundle\Entity\com\allegiant\are\dto\common\Property
     *
     * @return void
     */
    public function setProperty(array $items)
    {
        $this->property = $items;
    }

    /**
     * Get property
     *
     * @return com\allegiant\are\dto\common\Property 
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set code
     *
     * @param string $code code
     *
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set source
     *
     * @param string $source source
     *
     * @return void
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set description
     *
     * @param string $description description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set value
     *
     * @param float $value value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }



    /**
     * returns true if a property with the name $name and the value $value exists in the price component
     *
     * @param string $name  The name
     * @param string $value The value
     *
     * @return bool
     */
    public function propertyMatches($name, $value)
    {
        /** @var $property Property */
        foreach ($this->getProperty() as $property) {
            if ($property->getName() == $name && $property->getValue() == $value) {
                return true;
            }
        }

        return false;
    }
}
