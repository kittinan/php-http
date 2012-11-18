<?php

class HTTP{
  
  private $cookiePath = null;
  public $userAgent = 'Googlebot/2.1 (+http://www.google.com/bot.html)';
  
  public function __construct($cookiePath = null) {
    if(!empty($cookiePath)) {
        $this->cookiePath = $cookiePath;
    }
  }


  public function get($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    if(!empty($this->cookiePath)){
      curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->cookiePath);
      curl_setopt ($ch, CURLOPT_COOKIEJAR, $this->cookiePath);
    }
    
    $content = curl_exec ($ch);
    curl_close ($ch);
    return $content;
  }
    
  public function post($url, $params = null, $is_upload = false) {
    if(!empty($params)){
      $query = http_build_query($params);
    }else{
      $query = '';
    }
    $ch = curl_init();
    $opts[CURLOPT_URL] =  $url;
    $opts[CURLOPT_RETURNTRANSFER] = 1;
    $opts[CURLOPT_CONNECTTIMEOUT] = 30;
    $opts[CURLOPT_USERAGENT] = $this->userAgent;
    
    if(!empty($this->cookiePath)){
      $opts[CURLOPT_COOKIEFILE] = $this->cookiePath;
      $opts[CURLOPT_COOKIEJAR] = $this->cookiePath;
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
  

} 