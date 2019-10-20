<?php
define('BOT_TOKEN','925495968:AAGu5OagagP8zW102zohnp6TTxThuLpEY4o');
define('API_URL', 'https://api.telegram.org/bot925495968:AAGu5OagagP8zW102zohnp6TTxThuLpEY4o'/');
define('ADMIN_ID', '711547741');


function MessageRequestJson($method, $parameters) {

  if (!$parameters) {
    $parameters = array();
  }
  
  $parameters["method"] = $method;

  $handle = curl_init(API_URL);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
  curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
  $result = curl_exec($handle);
  return $result; 
}


function baseUrl(){
    return 'https://github.com/Bhnm4030/behnam/blob/master/core.php';
}


function randomImage(){
    $images = glob("images/*.{jpg,png}",GLOB_BRACE);
    $randomImage = $images[array_rand($images)];
    return baseUrl()."https://github.com/Bhnm4030/behnam/blob/master/core.php".$randomImage;

?>
