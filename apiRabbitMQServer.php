#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function searchLocation($location){
  ini_set("allow_url_fopen", 1);
  $url = "https://api.betterdoctor.com/2016-03-01/doctors?location=$location&skip=0&limit=10&user_key=7d4f6594078a3a93ecc4a2c426577b38";
  $data = file_get_contents($url);
  echo $data;
  return $data;
}
function searchUid($uid){
  ini_set("allow_url_fopen", 1);
  $url = "https://api.betterdoctor.com/2016-03-01/doctors/$uid?user_key=7d4f6594078a3a93ecc4a2c426577b38";
  $data = file_get_contents($url);
  echo $data;
  return $data;
}
function searchSpeciality($location, $speciality){
  ini_set("allow_url_fopen", 1);
  $url = "https://api.betterdoctor.com/2016-03-01/doctors?specialty_uid=$speciality&location=$location&skip=0&limit=10&user_key=7d4f6594078a3a93ecc4a2c426577b38";
  $data = file_get_contents($url);
  echo $data;
  return $data;
}
function searchInsurance($location, $insurance){
  ini_set("allow_url_fopen", 1);
  $url = "https://api.betterdoctor.com/2016-03-01/doctors?insurance_uid=$insurance&location=$location&skip=0&limit=10&user_key=7d4f6594078a3a93ecc4a2c426577b38";
  $data = file_get_contents($url);
  echo $data;
  return $data;
}
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "location":
      return searchLocation($request['location']);
    case "speciality":
      return searchSpeciality($request['location'],$request['speciality']);
    case "insurance":
      return searchInsurance($request['location'],$request['insurance']);
    case "uid":
      return searchUid($request['uid']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","apiServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

