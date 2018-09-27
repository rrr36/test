<?php
include (  "accounts.php"     ) ;
 include ( "functions.php" ) ;
( $db = mysqli_connect ( $hostname, $username, $password, $project ) );
if (mysqli_connect_errno())
{
  echo"Failed to connect to MYSQL ". mysqli_connect_error();
  exit();
}
print "Successfully connected to MySQL<br><br>";
mysqli_select_db( $project );

session_set_cookie_params(0,"/~rrr36/Assignment2/");
session_start();
echo "Session id: ";
echo session_id();
echo "<br>";

$user = mysqli_real_escape_string($db,$_GET["user"]);
$pass = mysqli_real_escape_string($db,$_GET["password"]);


auth($user,$pass,$c,$db);
$val = $c;

if(!$val){
  $message = "<br><span style='color:red;'>Unauthorized, redirecting to login page</span>";
  $whereto = "login.html";
  $delay = "2";
  redirect($message,$whereto,$delay);
  exit();
}else{
  $_SESSION["current_balance"] = $val;
  $_SESSION["logged_in"] = true;
  $_SESSION["user"] = $user;
  $message = "<br><span style='color:green;'>Authorized, redirecting to form page</span>";
  $whereto = "formpage.php";
  $delay = "2";
  redirect($message,$whereto,$delay);
  exit();
  }

?>
<html>
</html>
