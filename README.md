Json Pretty
=======

[![Build Status](https://travis-ci.org/camspiers/json-pretty.png?branch=master)](https://travis-ci.org/camspiers/json-pretty)

This project provides pretty printing for json in php 5.3.

Installation
------------

Download [composer](http://getcomposer.org/download/).
Install `json-pretty` using composer:

    $ composer install

Usage
-----

```php
$jsonPretty = new Camspiers\JsonPretty\JsonPretty;

echo $jsonPretty->prettify(array('test' => 'test'));
```

Testing
-------

To run the unit tests with phpunit installed globally:

	$ phpunit

To run the unit tests with phpunit installed via `composer install --dev`

	$ vendor/bin/phpunit

