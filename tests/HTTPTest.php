<?php
require_once __DIR__.'/../src/KS/HTTP/HTTP.php';

/**
 * @property HTTP $Http
 */
class HTTPTest extends PHPUnit_Framework_TestCase {
  
  private $Http;
  
  function __construct() {
    
    $this->Http = new \KS\HTTP\HTTP();
  }
  
  public function testGet() {
      $url = 'https://github.com/kittinan';
      $html = $this->Http->get($url);
      $this->assertRegExp('/kittinan/', $html);
  }
  
}