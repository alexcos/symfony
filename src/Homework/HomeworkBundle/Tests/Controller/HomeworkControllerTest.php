<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alex
 * Date: 10/17/13
 * Time: 6:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Homework\HomeworkBundle\Tests\Controller;

use Homework\HomeworkBundle\Controller\HomeworkController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class HomeworkControllerTest extends WebTestCase
{


    public function testHomework()
    {
        $this->client = static::createClient();
        $this->controller = new HomeworkController();
        $this->controller->setContainer($this->client->getContainer());

        $this->controller->indexAction();
        $this->assertTrue(true);
    }
}
