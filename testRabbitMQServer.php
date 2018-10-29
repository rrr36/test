#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{

echo $username;
echo $password;
    ( $db = mysqli_connect ( 'localhost', 'root', 'test', 'login' ) );
	if (mysqli_connect_errno())
	{
  	echo"Failed to connect to MYSQL ". mysqli_connect_error();
  	exit();
	}


print "Successfully connected to MySQL<br><br>";
mysqli_select_db($db, 'login' );

$s = "select * from users where userID = '$username' and passwd = '$password'";
echo "The SQL statement is $s";
($t = mysqli_query ($db,$s)) or die(mysqli_error());
$num = mysqli_num_rows($t);
if ($num == 0){
    return false;
}else
{
	return true;
}
function test($m)
{
  echo $m;
  return true;

}
}


function doReg($email,$username,$password){
( $db = mysqli_connect ( 'localhost', 'root', 'test', 'login' ) );
	if (mysqli_connect_errno())
	{
	echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
	exit();
	}
	echo "Successfully connected to MySQL<br><br>";
	mysqli_select_db($db, 'login' );
	
	$s = "select * from users where userID = '$username' and passwd = '$password'";
	echo "The SQL statement is $s";
	($t = mysqli_query ($db,$s)) or die(mysqli_error());
	$num = mysqli_num_rows($t);
	if ($num == 0){
    		$s = "insert into users(email,userID,passwd) values('$email','$username','$password')";
	        //echo "The SQL statement is $s";
        	($t = mysqli_query ($db,$s)) or die(mysqli_error());
		print "Registered";
		return true;

	}else
	{	
        	print "Error";
		return false;
	}

}

function addAP($uid,$name,$date,$user){
  ( $db = mysqli_connect ( 'localhost', 'root', 'test', 'login' ) );
  if (mysqli_connect_errno())
  {
    echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
    exit();
  }
  echo "Successfully connected to MySQL<br><br>";
  mysqli_select_db($db, 'login' );
  $s = "select * from vList where uid = '$uid'";
  echo "The SQL statement is $s";
  ($t = mysqli_query ($db,$s)) or die(mysqli_error());
  $num = mysqli_num_rows($t);
  if ($num == 0){
    $s1 = "insert into visitorList(uid,user,Doctor,date,visited) values('$uid','$user','$name','$date','N')";
    echo "The SQL statement is $s1";
    ($t1 = mysqli_query ($db,$s1)) or die(mysqli_error());
    $s2 = "select * from vList where user = '$user' and visited = 'N'";
    echo "The SQL statement is $s2";
    ($t2 = mysqli_query ($db,$s2)) or die(mysqli_error());
    $num2= mysqli_num_rows($t2);
    $out="<html><head></head><body><table><th>Name</th><th>Date</th><th>Status</th>";
    while ($r = mysqli_fetch_row($t2)){
      $id = $r[0];
      $u = $r[1];
      $n = $r[2];
      $d = $r[3];
      $out .= "<tr><td>$n</td>";
      $out .= "<td>$d</td>";
      $out .= "<td><a href='visited.php?uid=$id&type=rm'>Visited</td></tr>";
}
$out .= "</table></body></html>";
    echo $out;
    return $out;
  }else
  {
    $s1 = "update visitorList SET date='$date', visited = 'N' WHERE uid='$uid'";
    echo "The SQL statement is $s1";
    ($t1 = mysqli_query ($db,$s1)) or die(mysqli_error());
    $s2 = "select * from vList where user = '$user' and visited = 'N'";
    echo "The SQL statement is $s2";
    ($t2 = mysqli_query ($db,$s2)) or die(mysqli_error());
    $num2= mysqli_num_rows($t2);
    $out="<html><head></head><body><table><th>Name</th><th>Date</th><th>Status<th>";
    while ($r = mysqli_fetch_row($t2)){
      $id = $r[0];
      $u = $r[1];
      $n = $r[2];
      $d = $r[3];
      $out .= "<tr><td>$n</td>";
      $out .= "<td>$d</td>";
      $out .= "<td><a href='visited.php?uid=$id&type=rm'>Visited</td></tr>";
  }
  $out .= "</table></body></html>";
    echo $out;
    return $out;
    }
  }


function rmAP($uid,$user){
  ( $db = mysqli_connect ( 'localhost', 'root', 'test', 'login' ) );
  if (mysqli_connect_errno())
  {
    echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
    exit();
  }
  echo "Successfully connected to MySQL<br><br>";
  mysqli_select_db($db, 'login' );
    $s1 = "update visitorList SET visited='Y' WHERE uid='$uid'";
    echo "The SQL statement is $s1";
    ($t1 = mysqli_query ($db,$s1)) or die(mysqli_error());
    $s2 = "select * from vList where user = '$user' and visited = 'Y'";
    echo "The SQL statement is $s2";
    ($t2 = mysqli_query ($db,$s2)) or die(mysqli_error());
    $num2= mysqli_num_rows($t2);
    $out="<html><head></head><body><table><th>Name</th><th>Date</th><th>Status<th>";
    while ($r = mysqli_fetch_row($t2)){
      $id = $r[0];
      $u = $r[1];
      $n = $r[2];
      $d = $r[3];
      $out .= "<tr><td>$n</td>";
      $out .= "<td>$d</td>";
      $out .= "<td>Visited</td></tr>";
  }
  $out .= "</table></body></html>";
    echo $out;
    return $out;
    }
  
function getList($user){
    ( $db = mysqli_connect ( 'localhost', 'root', 'test', 'login' ) );
    if (mysqli_connect_errno())
    {
      echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      exit();
    }
    echo "Successfully connected to MySQL<br><br>";
    mysqli_select_db($db, 'login' );
      $s2 = "select * from visitorList where user = '$user' and visited = 'N'";
      echo "The SQL statement is $s2";
      ($t2 = mysqli_query ($db,$s2)) or die(mysqli_error());
      $num2= mysqli_num_rows($t2);
      $out="<html><head></head><body><table><th>Name</th><th>Date</th><th>Status<th>";
      while ($r = mysqli_fetch_row($t2)){
        $uid = $r[0];
	$n = $r[2];
        $d = $r[3];
        $out .= "<tr><td>$n</td>";
        $out .= "<td>$d</td>";
        $out .= "<td><a href='visited.php?uid=$uid&type=rm'>Visited</td></tr>";
    }
    $out .= "</table></body></html>";
      return $out;
}

function newList($user){
    ( $db = mysqli_connect ( 'localhost', 'root', 'test', 'login' ) );
    if (mysqli_connect_errno())
    {
      echo"Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      exit();
    }
    echo "Successfully connected to MySQL<br><br>";
    mysqli_select_db($db, 'login' );
      $s2 = "select * from visitorList where user = '$user' and visited = 'Y'";
      echo "The SQL statement is $s2";
      ($t2 = mysqli_query ($db,$s2)) or die(mysqli_error());
      $num2= mysqli_num_rows($t2);
      $out="<html><head></head><body><table><th>Name</th><th>Date</th><th>Status<th>";
      while ($r = mysqli_fetch_row($t2)){
        $uid = $r[0];
	$n = $r[2];
        $d = $r[3];
        $out .= "<tr><td>$n</td>";
        $out .= "<td>$d</td>";
        $out .= "<td>Visited</td></tr>";
    }
    $out .= "</table></body></html>";
      return $out;
}


function test($m)
{
  echo $m;
  return true;
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
    case "login":
      return doLogin($request['username'],$request['password']);
    case "reg":
      return doReg($request['email'],$request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
    case "msg":
      return test($request['message']);
    case "addap":
      return addAP($request['uid'],$request['name'],$request['date'],$request['user']);
    case "getlist":
      return getList($request['user']);
    case "rmap":
      return rmAP($request['uid'],$request['user']);
    case "nlist":
      return newList($request['user']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

