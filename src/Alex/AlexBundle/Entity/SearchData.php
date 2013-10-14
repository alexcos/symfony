<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/10/13
 * Time: 5:01 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Alex\AlexBundle\Entity;

use JMS\Serializer\Annotation\Type;

/**
 * Class SearchData
 * @package Alex\AlexBundle\Entity
 */
class SearchData {

    /**
     * @Type("string")
     * @var string $date
     */
    public $date;
    /**
     * @Type("string")
     * @var string $departAirport
     */
    public $departAirport;
    /**
     * @Type("string")
     * @var string $arriveAirport
     */
    public $arriveAirport;

}