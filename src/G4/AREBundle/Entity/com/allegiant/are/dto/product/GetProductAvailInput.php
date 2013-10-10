<?php

namespace G4\AREBundle\Entity\com\allegiant\are\dto\product;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\product\GetProductAvailInput
 */
class GetProductAvailInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{
    /**
     * @var com\allegiant\are\dto\product\SearchCriteria $searchCriteria
     */
    public $searchCriteria;


    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setSearchCriteria(new \G4\AREBundle\Entity\com\allegiant\are\dto\product\SearchCriteria());
    }

    /**
     * Set searchCriteria
     *
     * @param com\allegiant\are\dto\product\SearchCriteria $searchCriteria
     */
    public function setSearchCriteria(\G4\AREBundle\Entity\com\allegiant\are\dto\product\SearchCriteria $searchCriteria)
    {
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * Get searchCriteria
     *
     * @return com\allegiant\are\dto\product\SearchCriteria
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }
}