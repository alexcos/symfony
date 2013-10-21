<?php
/**
 * Allegiant Checkin package
 *
 * @category  Allegiant
 * @package   G4.AREBundle.Entity.com.allegiant.are.dto.order
 *
 * @link   http://50.57.78.111:7073/resweb/order?xsd=2
 */
namespace G4\AREBundle\Entity\com\allegiant\are\dto\order;

use Doctrine\ORM\Mapping as ORM;

/**
 * G4\AREBundle\Entity\com\allegiant\are\dto\order\ModifyOrderInput
 *
 * @author Mikey Uricaru    <mike@lolaent.com>
 * @author Georgiana Gligor <georgiana@lolaent.com>
 */
class ModifyOrderInput extends \G4\AREBundle\Entity\com\allegiant\are\dto\common\RequestInput
{

    /**
     * @var array items of type \G4\AREBundle\Entity\com\allegiant\are\dto\order\FlightChange
     */
    public $flightChange;

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment $payment
     */
    public $payment;

    /**
     * @var integer $orderId
     */
    public $orderId;

    /**
     * Constructor function
     *
     * @param stdClass $data data
     */
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    /**
     * Add payment
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment $payment
     *
     * @return void
     */
    public function addPayment(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Set payment
     *
     * @param array $items
     *
     * @return void
     */
    public function setPayment(array $items)
    {
        $this->payment = $items;
    }

    /**
     * Retrieve the payment
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\order\Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set orderChange
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\order\FlightChange $change
     *
     * @return void
     */
    public function addFlightChange(\G4\AREBundle\Entity\com\allegiant\are\dto\order\FlightChange $change)
    {
        $this->flightChange[] = $change;
    }

    public function setFlightChange(array $items)
    {
        $this->flightChange = $items;
    }

    /**
     * Retrieve the flight change
     *
     * @return array
     */
    public function getFlightChange()
    {
        return $this->flightChange;
    }

    /**
     * Set the order ID
     *
     * @param integer $orderId
     *
     * @void
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Retrieve the order ID
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

}