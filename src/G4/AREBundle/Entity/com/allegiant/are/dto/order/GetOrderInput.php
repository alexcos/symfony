<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\order;

use Doctrine\ORM\Mapping as ORM;
use G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput;
use G4\AREBundle\Entity\com\allegiant\are\dto\order\GetOrderInput\AnonymousRequest;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\order\GetOrderInput
 */
class GetOrderInput extends RequestInput
{
    public $anonymousRequest;

    /**
     * Constructor function
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
        $this->anonymousRequest = new AnonymousRequest();
    }
}