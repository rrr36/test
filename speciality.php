<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=index.html", true, 303);
 }

include ('testRabbitMQClient.php');
$speciality = $_GET['speciality'];
$location = $_GET['location'];
#$speciality = 'dentist';
#$location = 'NJ';
$response = searchSpeciality($location,$speciality);
$respo = rtrim($response);
header('Content-Type: application/json;charset=utf-8');
//echo json_decode($data);
echo ($respo);
?>
