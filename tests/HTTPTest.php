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
  
  public function testPost() {
      $url = 'http://posttestserver.com/post.php?dump&html&dir=php-http';
      
      $params = array(
          'post_time' => time(),
          'name' => 'kittinan',
      );
      
      $html = $this->Http->post($url, $params);
      
      $this->assertRegExp('/'.$params['post_time'].'/', $html);
      $this->assertRegExp('/'.$params['name'].'/', $html);
  }
  
}