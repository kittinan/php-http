<?php
/*
 * 
 */
namespace KS\HTTP;

class HTTP {
  
  private $cookiePath = null;
  private $userAgent = 'Googlebot/2.1 (+http://www.google.com/bot.html)';
  private $timeout = 60;
  private $headers = array();
  
  public function __construct($cookiePath = null) {
    if(!empty($cookiePath)) {
        $this->cookiePath = $cookiePath;
    }
  }
  
  public function setUserAgent($userAgent) {
    $this->userAgent = $userAgent;
  }
  
  public function setCookiePath($path) {
    $this->cookiePath = $path;
  }
  
  public function setTimeout($timeout) {
    $this->timeout = $timeout;
  }

  /*
   * Method Get
   */
  public function get($url, $referer = null){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    if (!empty($referer)) {
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    }

    if(!empty($this->cookiePath)){
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->cookiePath);
      curl_setopt ($ch, CURLOPT_COOKIEJAR, $this->cookiePath);
    }
    
    if(!empty($this->headers)) {
      curl_setopt ($ch, CURLOPT_HTTPHEADER, $this->headers);
    }
    
    $content = curl_exec ($ch);
    curl_close ($ch);
    return $content;
  }
  
  /*
   * Method Post with Upload 
   */
  public function post($url, $params = null, $is_upload = false) {
    if(!empty($params)){
      if (is_array($params) == true) {
        $query = http_build_query($params);
      } else {
        //Raw POST
        $query = $params;
      }
    }else{
      $query = '';
    }
    $ch = curl_init();
    $opts[CURLOPT_URL] =  $url;
    $opts[CURLOPT_RETURNTRANSFER] = 1;
    $opts[CURLOPT_CONNECTTIMEOUT] = $this->timeout;
    $opts[CURLOPT_USERAGENT] = $this->userAgent;
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    if(!empty($this->cookiePath)){
      $opts[CURLOPT_COOKIEFILE] = $this->cookiePath;
      $opts[CURLOPT_COOKIEJAR] = $this->cookiePath;
    }
    
    if(!empty($this->headers)) {
      curl_setopt ($ch, CURLOPT_HTTPHEADER, $this->headers);
    }
    
    if($is_upload){
      $opts[CURLOPT_POSTFIELDS] = $params;
    }else{
      $opts[CURLOPT_POSTFIELDS] = $query;
    }
    
    curl_setopt_array($ch, $opts);
    $result = curl_exec ($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close ($ch);
    if ($status == 200) {
      return $result;
    }
    else {
      return false;
    }
  }
  
  /*
   * Download File
   */
  public function download($url, $savePath) {
    
    $fp = fopen ($savePath, 'w+');
    
    $ch = curl_init(str_replace(" ","%20",$url));//Here is the file we are downloading, replace spaces with %20
    
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FILE, $fp); // write curl response to file
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch); // get curl response
    

    $info = curl_getinfo($ch);
    
    fclose($fp);
    curl_close($ch);
  }
  
  public function setHeaders($headers) {
    $this->headers = $headers;
  }
  
  public function getHeaders() {
    return $this->headers;
  }
  
} 