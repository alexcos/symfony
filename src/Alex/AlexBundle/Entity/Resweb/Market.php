<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/14/13
 * Time: 9:43 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Alex\AlexBundle\Entity\Resweb;

use JMS\Serializer\Annotation\Type;


class Market {

    /**
     * @Type("integer")
     * @var integer $reswebid
     */
    private $reswebid;

    /**
     * @param integer $reswebid
     */
    public function setReswebid($reswebid)
    {
        $this->reswebid = $reswebid;
    }

    /**
     * @return integer
     */
    public function getReswebid()
    {
        return $this->reswebid;
    }



}