<?php

namespace Camspiers\JsonPretty;

class JsonPretty
{
    const TAB = "\t";
    const NEW_LINE = "\n";

    public function prettify($json, $flags = null)
    {
        if (is_string($json)) {
            return $this->process($json);
        } else {
            return $this->process(json_encode($json, $flags));
        }
    }

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
