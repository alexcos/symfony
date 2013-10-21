<?php
/**
 * @category Allegiant
 * @package  G4.SearchBundle.Tests.Services
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use G4\UtilBundle\Services\Json;

/**
 * Unit test for the logging service
 */
class JsonTest extends G4UnitWebTestCase
{

    /**
     * Checks that a reasonably large valid json-string can be properly minified
     * In fact, this one is taken from its original size of 665406to just 138704.
     *
     * @return void
     */
    public function testMinify()
    {
        $path = sprintf(
            '%s/../src/G4/UtilBundle/Resources/tests/%s.json',
            $this->client->getContainer()->getParameter('kernel.root_dir'),
            'past_today_flights'
        );
        $uncompressed = file_get_contents($path);

        $minified = Json::minify($uncompressed);
        $this->assertEquals(json_encode(json_decode($uncompressed)), $minified);
    }

    /**
     * Checks that invalid json strings can't be minified
     *
     * @return void
     *
     * @dataProvider provideInvalidJson
     * @expectedException G4\UtilBundle\Exception\JsonDecodeException
     */
    public function testMinifyInvalidJson($invalidJson)
    {
        Json::minify($invalidJson);
    }

    /**
     * data provider for the negative test
     *
     * @return array
     */
    public function provideInvalidJson()
    {
        return array(
            array('{"1":"foo","2":"bar",}'),
            array('{"1":"foo","2":\'bar\'}'),
            array('{foo:"bar"}'),
        );
    }

}
