<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=index.html", true, 303);
}

include_once('testRabbitMQClient.php');
$uid = $_GET["uid"];
$response = searchUid($uid);
$respo = rtrim($response);
header('Content-Type: application/json;charset=utf-8');
//echo json_decode($data);
echo ($respo);
?>


