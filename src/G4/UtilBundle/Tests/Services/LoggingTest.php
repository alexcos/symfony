<?php
/**
 * @category Allegiant
 * @package  G4.SearchBundle.Tests.Controller
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;
use Symfony\Component\HttpKernel\HttpKernelInterface;

require_once __DIR__.'/../../../../../app/AppKernel.php';

/**
 * Unit test for the logging service
 */
class LoggingTest extends G4UnitWebTestCase
{
    //TODO: add more tests for the logging class

    /**
     * Empty test
     */
    public function testEmpty()
    {
        $this->assertTrue(true);
    }
}
