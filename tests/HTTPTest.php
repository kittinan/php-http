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
  
  public function testDownload() {
      $local_file_hash = sha1_file(__DIR__.'/../README.md');
      
      $url = 'https://raw.githubusercontent.com/kittinan/php-http/master/README.md';
      $savePath = __DIR__ . '/test.txt';
      $this->Http->download($url, $savePath);
      
      $download_file_hash = sha1_file($savePath);
      unlink($savePath);
      $this->assertEquals($local_file_hash, $download_file_hash);
  }
  
}