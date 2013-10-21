<?php

namespace G4\UtilBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use G4\UtilBundle\Controller\ServiceController;
use G4\UtilBundle\Tests\G4\G4UnitWebTestCase;

/**
 * Functional testing for the parent service controller
 */
class ServiceControllerTest extends G4UnitWebTestCase
{
    private $stub;

    /**
     * phpunit setUp called before each test
     */
    public function setUp()
    {
        /* 
        $this->stub = $this->getMockForAbstractClass('\G4\UtilBundle\Controller\ServiceController');        
        $container = static::createClient()->getContainer();
        $this->stub->setContainer($container);
        */
    }

    /**
     * Checking the empty messages
     *
     * @param string $empty the empty message
     *
     * @return void
     * @dataProvider provideEmptyMessages
     */
    public function testShortenMessageEmpty($empty)
    {
        $shortened = $this->shortenMessage($empty);
        $this->assertEquals('empty', $shortened);
    }

    /**
     * Data provider for empty messages
     *
     * @return array of array($empty)
     */
    public function provideEmptyMessages()
    {
        return array(
            array(null),
            array(''),
        );
    }

    /**
     * Checking messages shorted than $maxLength
     *
     * @param string  $message   The short message
     * @param integer $maxLength The maximum allowe string length
     *
     * @return void
     * @dataProvider provideShortMessages
     */
    public function testShortenMessageShort($message, $maxLength)
    {
        $shortened = $this->shortenMessage($message, $maxLength);
        $this->assertEquals($message, $shortened);
    }

    /**
     * Data provider for empty messages
     *
     * @return array of array($message, $maxLength)
     */
    public function provideShortMessages()
    {
        return array(
            array('asdf', 50),
            array('123test123', 50),
            array(str_repeat('*', 49), 50),
        );
    }

    /**
     * Checking messages longer than $maxLength
     *
     * @param string  $message   The long message
     * @param integer $maxLength the maximum allowed string length
     * @param string  $moreText  What to append to the shortened version of $message
     *
     * @return void
     * @dataProvider provideLongMessages
     */
    public function testShortenMessagesLong($message, $maxLength, $moreText)
    {
        $shortened = $this->shortenMessage($message, $maxLength, $moreText);
        $this->assertEquals(substr($message, 0, $maxLength - 1) . $moreText, $shortened);
    }

    /**
     * Data provider for empty messages
     *
     * @return array of array($message, $maxLength, $moreText)
     */
    public function provideLongMessages()
    {
        return array(
            array(str_repeat('*', 50), 50, '...'),
            array(str_repeat('?', 10), 10, '[...]'),
        );
    }

    /**
     * Shorten $fullMessage to a maximum of $maxLength characters, add $moreText if longer
     *
     * @param string  $fullMessage The initial text message
     * @param integer $maxLength   The maximum length allowed to keep
     * @param string  $moreText    What to append in case $fullMessage gets shortened
     *
     * @return string
     */
    public static function shortenMessage($fullMessage, $maxLength = 50, $moreText = '...')
    {
        $msg = '';
        if (empty($fullMessage)) {
            $msg = 'empty';
        } elseif (strlen($fullMessage) < $maxLength) {
            $msg = $fullMessage;
        } else {
            $msg = substr($fullMessage, 0, $maxLength - 1) . $moreText;
        }

        return ($msg);
    }

}
