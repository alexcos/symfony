<?php
namespace G4\UtilBundle\Entity\Lookup;

use G4\UtilBundle\Entity\Lookup\Market\Airport;

class Market
{
    public $valid_to;
    public $valid_from;
    public $name;
    public $description;
    public $uri;
    public $id;
    public $type;
    public $reswebid;

    /**
     * @var Airport
     */
    public $from;

    /** @var Airport */
    public $to;

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $reswebid
     */
    public function setReswebid($reswebid)
    {
        $this->reswebid = $reswebid;
    }

    /**
     * @return mixed
     */
    public function getReswebid()
    {
        return $this->reswebid;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $valid_from
     */
    public function setValidFrom($valid_from)
    {
        $this->valid_from = $valid_from;
    }

    /**
     * @return mixed
     */
    public function getValidFrom()
    {
        return $this->valid_from;
    }

    /**
     * @param mixed $valid_to
     */
    public function setValidTo($valid_to)
    {
        $this->valid_to = $valid_to;
    }

    /**
     * @return mixed
     */
    public function getValidTo()
    {
        return $this->valid_to;
    }

    /**
     * @param \G4\UtilBundle\Entity\Lookup\Market\Airport $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return \G4\UtilBundle\Entity\Lookup\Market\Airport
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param \G4\UtilBundle\Entity\Lookup\Market\Airport $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return \G4\UtilBundle\Entity\Lookup\Market\Airport
     */
    public function getTo()
    {
        return $this->to;
    }


}