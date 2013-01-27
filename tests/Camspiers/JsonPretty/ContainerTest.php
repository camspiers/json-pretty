<?php

namespace Camspiers\JsonPretty;

class ContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonPretty()
    {
        $container = new Container;
        $this->assertEquals(new JsonPretty, $container['json_pretty']);
    }
}
