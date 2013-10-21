<?php
namespace G4\AREBundle\Entity\com\allegiant\are\dto\lookup;

use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;

/**
 * Class LookupInput
 */
class LookupInput extends RequestInput
{

    /**
     * @var array
     */
    public $lookupName = array();

    /**
     * @param array $lookupName
     */
    public function setLookupName($lookupName)
    {
        $this->lookupName = $lookupName;
    }

    /**
     * @return array
     */
    public function getLookupName()
    {
        return $this->lookupName;
    }
}