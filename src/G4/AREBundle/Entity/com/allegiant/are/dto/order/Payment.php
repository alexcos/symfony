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
 * New Payment entity to enclose the actual \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartPayment
 *      used when asking for modifyOrder from resweb.
 *  "payment":{
 *      "payment":{
 *          "billingAddress":{
 *          "type":"BILLING",
 *          "address1":"Example Bd 7",
 *          "address2":"",
 *          "city":"Cluj",
 *          "state":"OR",
 *          "zip5":"12345",
 *          "zip4":"6789",
 *          "country":"USA"
 *      },
 *      "paymentTypeID":2,
 *      "amount":5.00
 *  }
 *
 * @author Georgiana Gligor <georgiana@lolaent.com>
 *
 * @deprecated resweb changed this to an array of Payment objects
 */
class Payment
{

    /**
     * @var \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartPayment $payment
     */
    public $payment;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->setPayment(new \G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment());
    }

    /**
     * Set payment
     *
     * @param \G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment $payment
     *
     * @return void
     */
    public function setPayment(\G4\AREBundle\Entity\com\allegiant\are\dto\common\Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Retrieve the cart payment
     *
     * @return \G4\AREBundle\Entity\com\allegiant\are\dto\cart\CartPayment
     */
    public function getPayment()
    {
        return $this->payment;
    }

}
