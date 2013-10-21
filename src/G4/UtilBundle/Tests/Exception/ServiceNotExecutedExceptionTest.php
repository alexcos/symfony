<?php
/**
 * @category Allegiant
 * @package  G4.UtilBundle.Tests.Exception
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Tests\Exception;

use G4\UtilBundle\Exception\ServiceNotExecutedException;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Checks that ServiceNotExecutedException is a proper \Exception
 */
class ServiceNotExecutedExceptionTest extends TestCase
{

    /**
     * Checking that the exception exists and is behaving
     *      like a normal \Exception instance
     *
     * @return void
     */
    public function testException()
    {
        $msg = 'Service flights has not been executed.';
        $ex = new ServiceNotExecutedException($msg);
        $this->assertInstanceOf('\Exception', $ex);
        $this->assertGreaterThan(0, strlen($ex));
        $this->assertEquals($msg, $ex->getMessage());
    }

}
