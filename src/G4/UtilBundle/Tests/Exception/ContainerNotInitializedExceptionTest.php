<?php
/**
 * @category Allegiant
 * @package  G4.UtilBundle.Tests.Exception
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Tests\Exception;

use G4\UtilBundle\Exception\ContainerNotInitializedException;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Checks that ContainerNotInitializedException is a proper \Exception
 */
class ContainerNotInitializedExceptionTest extends TestCase
{

    /**
     * Checking that the exception exists and is behaving
     *      like a normal \Exception instance
     *
     * @return void
     */
    public function testException()
    {
        $msg = 'Please initialize your container first!';
        $ex = new ContainerNotInitializedException($msg);
        $this->assertInstanceOf('\Exception', $ex);
        $this->assertGreaterThan(0, strlen($ex));
        $this->assertEquals($msg, $ex->getMessage());
    }

}
