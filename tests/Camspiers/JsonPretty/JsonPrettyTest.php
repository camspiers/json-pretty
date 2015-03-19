<?php

namespace Camspiers\JsonPretty;

class JsonPrettyTest extends \PHPUnit_Framework_TestCase
{
    public function testPrettify()
    {
        $object = array(
            'test' => 'test',
            'object' => array(
                'hello' => 'hello'
            )
        );
        $expected = <<<JSON
{
\t"test": "test",
\t"object": {
\t\t"hello": "hello"
\t}
}
JSON;
        $jsonPretty = new JsonPretty;
        $this->assertEquals(
            $expected,
            $jsonPretty->prettify($object)
        );
        $this->assertEquals(
            $expected,
            $jsonPretty->prettify(json_encode($object))
        );
    }

    public function testPrettifyWithEscapedSlashBeforeStringEnd()
    {
        $object = array(
            'test' => 'test',
            'foo' => 'alice\\bob\\',
            'bar' => 'baz',
        );
        $expected = <<<JSON
{
\t"test": "test",
\t"foo": "alice\\\bob\\\",
\t"bar": "baz"
}
JSON;
        $jsonPretty = new JsonPretty;
        $this->assertEquals(
            $expected,
            $jsonPretty->prettify($object)
        );
        $this->assertEquals(
            $expected,
            $jsonPretty->prettify(json_encode($object))
        );
    }
}
