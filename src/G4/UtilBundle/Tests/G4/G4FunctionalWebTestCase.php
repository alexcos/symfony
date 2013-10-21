<?php
/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Tests.G4
 */
namespace G4\UtilBundle\Tests\G4;

use G4\UtilBundle\Exception\ConnectionException;
use G4\UtilBundle\ServicesCall;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 *  contains methods used across the functional tests suite
 */
abstract class G4FunctionalWebTestCase extends G4WebTestCase
{
    /**
     * Generates a valid dob for a person with the age between min_age and max_age
     *
     * @param int $minAge
     * @param int $maxAge
     *
     * @return string
     */
    protected static function generate_dob($minAge = 18, $maxAge = 65)
    {
        $age = rand($minAge, $maxAge);
        $dob = (date('Y') - $age) . '-' . rand(1, 12) . '-' . rand(1, 28);

        return $dob;
    }

    /**
     * Generates a name
     *
     * @param int  $travellerNumber The number of the traveller in the group of travellers
     * @param bool $forCheckin      If set to true it returns the name "TEST TEST"
     *
     * @return array
     */
    protected function generate_name($travellerNumber = 1, $forCheckin = false)
    {
        if (!$forCheckin) {
            $path = sprintf('%s/../src/G4/ShoppingCartBundle/Resources/tests/names.txt', $this->client->getContainer()->getParameter('kernel.root_dir'));
            $fileContents = file($path);
            $name = $fileContents[array_rand($fileContents)];
            $name = explode(" ", $name);
        } else {
            if ($travellerNumber == 1) {
                $travellerNumber = '';
            }
            $name[0] = 'TEST' . $travellerNumber;
            $name[1] = 'TEST' . $travellerNumber;
        }

        return array('firstname' => $name[0], 'lastname' => $name[1]);
    }

    /**
     * Generates a date in future of the format YYYY-MM-DD
     *
     * @param int $numberOfDays
     *
     * @return string
     */
    protected static function inFutureDays($numberOfDays)
    {
        return date('Y-m-d', time() + $numberOfDays * 86400);
    }

    /**
     * Gets the encrypted credit card info
     *
     * @param string $card
     * @param string $cvv
     * @param int    $cardType
     *
     * @throws \G4\UtilBundle\Exception\ConnectionException
     * @return mixed
     */
    public function getCardInfo($card, $cvv, $cardType = 4)
    {
        if (!$this->client->getContainer()->getParameter('g4_pie_enabled') == true) {
            $cardData = new \stdClass();
            $cardData->card = $card;
            $cardData->cvv = $cvv;
            $cardData->type = $cardType;

            return $cardData;
        }

        try {
            $pieHost = $this->client->getContainer()->getParameter('g4_test_pie_host');
        } catch (\InvalidArgumentException $ex) {
            $pieHost = "http://127.0.0.1:7777";
        }

        /** @var ServicesCall $servicesCall */
        $servicesCall = $this->client->getContainer()->get('g4_services_call');
        $pieKeys = $this->client->getContainer()->getParameter("g4_pie_key");
        $pieLib = $this->client->getContainer()->getParameter("g4_pie_lib");
        $data = array(
            "card"=>$card,
            "cvv"=>$cvv,
            "pieKeys"=>file_get_contents($pieKeys),
            "pieLib"=>file_get_contents($pieLib)
        );

        $servicesCall->addPost(
            $pieHost,
            20,
            array(),
            json_encode($data),
            'nodejs'
        );

        $response = $servicesCall->execute();
        $result = json_decode($response['nodejs']);
        $result->type = $cardType;

        if (!$result) {
            throw new ConnectionException("Nodejs server not found: " . $pieHost);
        } else if (!isset($result->card) || !isset($result->cvv)) {
            throw new ConnectionException("Invalid response received: ".print_r($result, true));
        }

        return $result;
    }
}
