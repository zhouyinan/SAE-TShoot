<?php
function dns_resolute($domain,$require_ttl = false){
  if(empty($domain))return false;
  $ch = curl_init();
  $parameter['dn']=$domain;
  if($require_ttl)$parameter['ttl']=1;
  curl_setopt($ch,CURLOPT_URL,'http://119.29.29.29/d?'.http_build_query($parameter));
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_HEADER,0);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}

function get_http_code($url){
  if(empty($url))return false;
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($curl,CURLOPT_NOBODY,true);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_HEADER,0);
  $result = curl_getinfo($curl,CURLINFO_HTTP_CODE);
  curl_close($ch);
  return $result;
}
?>