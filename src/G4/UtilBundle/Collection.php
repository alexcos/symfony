<?php
namespace G4\UtilBundle;

/**
 * Collection class, based on ArrayObject
 */
class Collection extends \ArrayObject
{

    /**
     * Returns the values of the array
     *
     * @return array
     */
    public function values()
    {
        return array_values($this->getArrayCopy());
    }
}
