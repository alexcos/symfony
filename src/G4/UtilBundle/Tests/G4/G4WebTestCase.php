<?php

/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Tests.G4
 */
namespace G4\UtilBundle\Tests\G4;

use G4\CodeCoverageBundle\Services\CodeCoverage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpKernel\Kernel;

abstract class G4WebTestCase extends WebTestCase
{
    /** @var Client */
    protected $client;

    /** @var CodeCoverage */
    protected static $coverage = null;

    /**
     * Start the code coverage (the service will check if code coverage is enabled in parameters.yml)
     */
    public static function setUpBeforeClass()
    {
        self::$coverage = static::createClient()->getContainer()->get('g4.codecoverage');
        self::$coverage->start();
    }

    /**
     * Stop the code coverage (the service will check if code coverage is enabled in parameters.yml)
     */
    public static function tearDownAfterClass()
    {
        self::$coverage->stop();
    }

    /**
     * Used to configure test
     *
     * @static
     *
     */
    protected function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Load fixture file to use in the testing process.
     * NOTE make sure to use folder structure, like: functional_flight-only/flightChoiceCompleted
     *
     * @param string $file   fixture file to be loaded
     * @param string $bundle bundle name
     * @param array  $params Contains an array of key -> values to be replaced in the fixtures
     * @param string $folder folder name
     *
     * @return string the file contents
     */
    protected function readFixture($file, $bundle = '', $params = array(), $folder = 'Resources/tests')
    {
        //if the file doesn't have an extension we automatically append .json
        $extension = substr(strrchr($file, '.'), 1);
        if (!strlen($extension)) {
            $file .= '.json';
        }

        $path = sprintf(
            '%s/../src/G4/%s/%s/%s',
            $this->client->getContainer()->getParameter('kernel.root_dir'),
            $bundle,
            $folder,
            $file
        );
        $fixturesContent = file_get_contents($path);

        foreach ($params as $key => $value) {
            $isEntity = false;
            if ((strpos($value, "{") !== false) || (strpos($value, "[") !== false)) {
                $isEntity = true;
            }

            if ($isEntity) {
                $fixturesContent = str_replace("\"{%" . $key . "%}\"", $value, $fixturesContent);
                $fixturesContent = str_replace("{%" . $key . "%}", $value, $fixturesContent);
            }

            $fixturesContent = str_replace("{%" . $key . "%}", $value, $fixturesContent);
        }

        return $fixturesContent;
    }

}
