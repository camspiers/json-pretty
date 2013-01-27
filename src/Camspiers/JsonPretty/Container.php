<?php

namespace Camspiers\JsonPretty;

class Container extends \Pimple
{
    public function __construct()
    {
        $this['json_pretty.class'] = 'Camspiers\JsonPretty\JsonPretty';
        $this['json_pretty'] = $this->share(function ($c) {
            return new $c['json_pretty.class']();
        });
    }
}
