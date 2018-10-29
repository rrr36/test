<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=index.html", true, 303);
 }

include ('testRabbitMQClient.php');
$uid = $_GET['insurance'];
$location = $_GET['location'];
$response = searchInsurance($uid,$location);
$respo = rtrim($response);
header('Content-Type: application/json;charset=utf-8');
//echo json_decode($data);
echo ($respo);
?>
