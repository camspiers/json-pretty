<?php

namespace Camspiers\JsonPretty;

class JsonPretty
{
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
        $tab = "\t";
        $len = strlen($json);
        for ($c = 0; $c < $len; $c++) {
            $char = $json[$c];
            if ($char === '{' || $char === '[') {
                if (!$inString) {
                    $indent++;
                    $result .= $char . PHP_EOL . str_repeat($tab, $indent);
                } else {
                    $result .= $char;
                }
            } elseif ($char === '}' || $char === ']') {
                if (!$inString) {
                    $indent--;
                    $result .= PHP_EOL . str_repeat($tab, $indent) . $char;
                } else {
                    $result .= $char;
                }
            } elseif ($char === ',') {
                if (!$inString) {
                    $result .= ',' . PHP_EOL . str_repeat($tab, $indent);
                } else {
                    $result .= $char;
                }
            } elseif ($char === ':') {
                if (!$inString) {
                    $result .= ': ';
                } else {
                    $result .= $char;
                }
            } elseif ($char === '"') {
                if ($c > 0 && $json[$c - 1] !== '\\') {
                    $inString = !$inString;
                }
                $result .= $char;
            } else {
                $result .= $char;
            }
        }
        return $result;
    }
}
