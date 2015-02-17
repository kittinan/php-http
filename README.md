php-http
========
[![Build Status](https://travis-ci.org/kittinan/php-http.svg?branch=master)](https://travis-ci.org/kittinan/php-http)
[![Coverage Status](https://coveralls.io/repos/kittinan/php-http/badge.png?branch=master)](https://coveralls.io/r/kittinan/php-http?branch=master)
[![License](https://poser.pugx.org/kittinan/php-http/license.svg)](https://packagist.org/packages/kittinan/php-http)

simple php http wrapper with php-curl

Support :

- GET, POST

- Download File

## Requirement
* PHP 5+
* php5-curl

## Composer

Install the latest version with composer require kittinan/php-http

This plugin on the Packagist.

[https://packagist.org/packages/kittinan/php-http](https://packagist.org/packages/kittinan/php-http)

## Usage
```php

$http = new \KS\HTTP\HTTP();
$url = 'https://github.com/kittinan/php-http';
$html = $http->get($url);
echo $html;
```


License
=======
The MIT License (MIT)
