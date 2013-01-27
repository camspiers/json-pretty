<?php

namespace Camspiers\JsonPretty;

class JsonPretty
{
    const TAB = "\t";
    const NEW_LINE = "\n";

    /**
     * Checks if input is string, if so, straight runs
     * process, else it encodes the input as json then
     * runs prettify.
     * @param  mixed  $json  The json string or object to prettify
     * @param  int    $flags The flags to use in json encoding
     * @return string The prettified json
     */
    public function prettify($json, $flags = null)
    {
        if (is_string($json)) {
            return $this->process($json);
        } else {
            return $this->process(json_encode($json, $flags));
        }
    }

    /**
     * Makes a json string pretty
     * Function adapted from umbrae [at] gmail [dot] com
     * at http://php.net/manual/en/function.json-encode.php
     * @param  string $json A json string to prettify
     * @return string The prettified json string
     */
    protected function process($json)
    {
        $result = '';
        $indent = 0;
        $inString = false;

        $len = strlen($json);

        for ($c = 0; $c < $len; $c++) {
            $char = $json[$c];
            switch ($char) {
                case '{':
                case '[':
                    if (!$inString) {
                        $result .= $char . self::NEW_LINE . str_repeat(self::TAB, $indent + 1);
                        $indent++;
                    } else {
                        $result .= $char;
                    }
                    break;
                case '}':
                case ']':
                    if (!$inString) {
                        $indent--;
                        $result .= self::NEW_LINE . str_repeat(self::TAB, $indent) . $char;
                    } else {
                        $result .= $char;
                    }
                    break;
                case ',':
                    if (!$inString) {
                        $result .= ',' . self::NEW_LINE . str_repeat(self::TAB, $indent);
                    } else {
                        $result .= $char;
                    }
                    break;
                case ':':
                    if (!$inString) {
                        $result .= ': ';
                    } else {
                        $result .= $char;
                    }
                    break;
                case '"':
                    if ($c > 0 && $json[$c - 1] != '\\') {
                        $inString = !$inString;
                    }
                default:
                    $result .= $char;
                    break;
            }
        }

        return $result;
    }
}
