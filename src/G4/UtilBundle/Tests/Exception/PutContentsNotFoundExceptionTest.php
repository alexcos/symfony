<?php
namespace G4\UtilBundle\Tests\Exception;

/**
 * PHP Version 5
 *
 * @category  Allegiant
 * @package   G4.UtilBundle.Tests.Exception
 */
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use G4\UtilBundle\Exception\PutContentsNotFoundException;

/**
 * DrupalDocketTest 
 * 
 * @uses TestCase
 */
class PutContentsNotFoundExceptionTest extends TestCase
{

    /**
     * Checking that the exception exists and is behaving
     *      like a normal \Exception instance
     *
     * @return void
     */
    public function testException()
    {
        $key = 'flight';
        $errorMsg = sprintf('Unable to find data at key %s', $key);
        $exp = new PutContentsNotFoundException($errorMsg, $key);
        $this->assertTrue(
            $exp instanceof \Exception
        );

        $stringval = $exp->__toString();
        $this->assertTrue(
            strlen($stringval)>0
        );
    }

}
