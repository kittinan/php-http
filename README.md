php-http
========
[![Build Status](https://travis-ci.org/kittinan/php-http.svg?branch=master)](https://travis-ci.org/kittinan/php-http)
[![Code Coverage](https://scrutinizer-ci.com/g/kittinan/php-http/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kittinan/php-http/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kittinan/php-http/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kittinan/php-http/?branch=master)
[![License](https://poser.pugx.org/kittinan/php-http/license.svg)](https://packagist.org/packages/kittinan/php-http)

simple php http wrapper with php-curl

Support :

- HTTP Method GET, POST
- Download File
- Support Cookie with cookiejar file

## Requirement
* PHP 5+
* php5-curl

## Composer

Install the latest version with composer require kittinan/php-http

This plugin on the Packagist.

[https://packagist.org/packages/kittinan/php-http](https://packagist.org/packages/kittinan/php-http)

## Usage
*Example : HTTP GET*
```php
$http = new \KS\HTTP\HTTP();
$url = 'https://github.com/kittinan/php-http';
$html = $http->get($url);
echo $html;
```


License
=======
The MIT License (MIT)
