<?php

namespace Camspiers\JsonPretty;

class JsonPrettyTest extends \PHPUnit_Framework_TestCase
{
    public function dataPrettify()
    {
        return array(

            // Default test case
            array(
                array(
                    'test' => 'test',
                    'object' => array(
                        'hello' => 'hello'
                    )
                ),
<<<JSON
{
\t"test": "test",
\t"object": {
\t\t"hello": "hello"
\t}
}
JSON
                ,
                false
            ),

            // PrettifyWithEscapedSlashBeforeStringEnd
            array(
                array(
                    'test' => 'test',
                    'foo' => 'alice\\bob\\',
                    'bar' => 'baz',
                ),
<<<JSON
{
\t"test": "test",
\t"foo": "alice\\\bob\\\",
\t"bar": "baz"
}
JSON
                ,
                false
            ),

            // https://github.com/camspiers/json-pretty/issues/9
            array(
                array(
                    array(
                        'id' => '34',
                        'system_id' => '2000',
                        'src' => '***',
                        'dst' => '790',
                        'dcontext' => 'RingGroups-2000',
                        'clid' => '***',
                        'channel' => 'SIP/***-0000005c',
                        'dstchannel' => 'SIP/2000200-0000005d',
                        'lastapp' => 'Dial',
                        'lastdata' => 'SIP/2000200&SIP/2000201),20,ktwx',
                        'calldate' => '2015-09-08 08:56:10',
                        'answer' => '2015-09-08 08:56:10',
                        'end' => '2015-09-08 08:56:20',
                        'duration' => '10',
                        'billsec' => '0',
                        'disposition' => 'NO ANSWER',
                        'uniqueid' => 'pbx1-1441698970.92',
                        'linkedid' => 'pbx1-1441698970.92',
                        'internal' => '0',
                        'outbound' => '0',
                        'inbound' => '1',
                        'uploaded' => '0',
                        'ddi' => null,
                    ),
                ),
<<<JSON
[
\t{
\t\t"id": "34",
\t\t"system_id": "2000",
\t\t"src": "***",
\t\t"dst": "790",
\t\t"dcontext": "RingGroups-2000",
\t\t"clid": "***",
\t\t"channel": "SIP\/***-0000005c",
\t\t"dstchannel": "SIP\/2000200-0000005d",
\t\t"lastapp": "Dial",
\t\t"lastdata": "SIP\/2000200&SIP\/2000201),20,ktwx",
\t\t"calldate": "2015-09-08 08:56:10",
\t\t"answer": "2015-09-08 08:56:10",
\t\t"end": "2015-09-08 08:56:20",
\t\t"duration": "10",
\t\t"billsec": "0",
\t\t"disposition": "NO ANSWER",
\t\t"uniqueid": "pbx1-1441698970.92",
\t\t"linkedid": "pbx1-1441698970.92",
\t\t"internal": "0",
\t\t"outbound": "0",
\t\t"inbound": "1",
\t\t"uploaded": "0",
\t\t"ddi": null
\t}
]
JSON
                ,
                false
            ),

            // Default test case with JSON input
            array(
                '{"test":"test","object":{"hello":"hello"}}'
                ,
<<<JSON
{
\t"test": "test",
\t"object": {
\t\t"hello": "hello"
\t}
}
JSON
                ,
                true
            ),

            // PrettifyWithEscapedSlashBeforeStringEnd with JSON input
            array(
                '{"test":"test","foo":"alice\\\bob\\\","bar":"baz"}'
            ,
<<<JSON
{
\t"test": "test",
\t"foo": "alice\\\bob\\\",
\t"bar": "baz"
}
JSON
                ,
                true
            ),

            // https://github.com/camspiers/json-pretty/issues/9 JSON input
            array(
                '[{"id":"34","system_id":"2000","src":"***","dst":"790","dcontext":"RingGroups-2000","clid":"***","channel":"SIP\/***-0000005c","dstchannel":"SIP\/2000200-0000005d","lastapp":"Dial","lastdata":"SIP\/2000200&SIP\/2000201),20,ktwx","calldate":"2015-09-08 08:56:10","answer":"2015-09-08 08:56:10","end":"2015-09-08 08:56:20","duration":"10","billsec":"0","disposition":"NO ANSWER","uniqueid":"pbx1-1441698970.92","linkedid":"pbx1-1441698970.92","internal":"0","outbound":"0","inbound":"1","uploaded":"0","ddi":null}]'
                ,
<<<JSON
[
\t{
\t\t"id": "34",
\t\t"system_id": "2000",
\t\t"src": "***",
\t\t"dst": "790",
\t\t"dcontext": "RingGroups-2000",
\t\t"clid": "***",
\t\t"channel": "SIP\/***-0000005c",
\t\t"dstchannel": "SIP\/2000200-0000005d",
\t\t"lastapp": "Dial",
\t\t"lastdata": "SIP\/2000200&SIP\/2000201),20,ktwx",
\t\t"calldate": "2015-09-08 08:56:10",
\t\t"answer": "2015-09-08 08:56:10",
\t\t"end": "2015-09-08 08:56:20",
\t\t"duration": "10",
\t\t"billsec": "0",
\t\t"disposition": "NO ANSWER",
\t\t"uniqueid": "pbx1-1441698970.92",
\t\t"linkedid": "pbx1-1441698970.92",
\t\t"internal": "0",
\t\t"outbound": "0",
\t\t"inbound": "1",
\t\t"uploaded": "0",
\t\t"ddi": null
\t}
]
JSON
                ,
                true
            ),

        );
    }

    /**
     * @dataProvider dataPrettify
     */
    public function testPrettify($object, $expected, $is_json)
    {
        $jsonPretty = new JsonPretty;
        $this->assertEquals(
            $expected,
            $jsonPretty->prettify($object)
        );

        if (!$is_json) {
            $this->assertEquals(
                $expected,
                $jsonPretty->prettify(json_encode($object))
            );
        }
    }

    /**
     * @dataProvider dataPrettify
     */
    public function testPrettifyIsJsonOverride($object, $expected, $is_json)
    {
        $jsonPretty = new JsonPretty;
        $this->assertEquals(
            $expected,
            $jsonPretty->prettify($object, null, "\t", $is_json)
        );
    }
}
