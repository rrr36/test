<?php
session_start();
include ('testRabbitMQClient.php');
$user = $_GET["user"];
$pass = $_GET["password"];
$date = date("Y-m-d:m:a");
#$user = "test";
#$pass = "test";
#echo $user;
#echo $pass;
$resp = auth($user,$pass);
if( $resp == 1){
$_SESSION['user'] = $user;
echo "Login Successful";
$message = "$date $user Login Successful";
#shell_exec("touch /tmp/error.log");
shell_exec("echo $message  >> /tmp/event.log");
exec("sudo sshpass -p 'student' scp /tmp/event.log it490@192.168.1.13:/home/it490/");
header("Refresh:1; url=welcome.php", true, 303);
}
else
{
echo "Login Unsucessful";
$message = "$date $user Login Unsuccessful";
shell_exec("echo $message  >> /tmp/event.log");
header("Refresh:1; url=index.html", true, 303);
}
?>
