<?php

function auth($u, $v, &$val, $dbh) {

    $s = "select * from Atable where user = '$u' and pass = '$v'";
    echo "The SQL statement is $s";
    ($t = mysqli_query ($dbh,$s)) or die(mysqli_error());
    $num = mysqli_num_rows($t);

    if ($num == 0){
      $val = false;
      return $val;
    }else
    {
      
      while ( $r = mysqli_fetch_array($t)){
	      $val = $r ["current_balance"];
        return $val;
      };
    }
}

function gatekeeper($session){
  if(!$session){
    echo "<br><span style='color:red;'>Unauthorized, redirecting to login page</span>";
    header("refresh:2;url = login.html");
    exit();
  }
}
function redirect($m, $w, $d){
  echo($m);
	header("refresh:$d;url = $w");
}

function deposit($u, $a, $tp,$dbh){
    session_start();
    $s = "insert into Ttable values( '$u', '$tp', '$a', NOW() )";
    ($t = mysqli_query ($dbh,$s)) or die(mysqli_error());
    echo "<br><br>SQL for updated Ttable is:<br> $s";

    $m = "update Atable SET current_balance=current_balance + '$a' where user = '$u' ";
    echo "<br><br>SQL for deposit is:<br> $m";
    ($n = mysqli_query ($dbh,$m)) or die(mysqli_error());
    
    $s1 = "select*from Atable where user = '$u'";
    ($t1 = mysqli_query ($dbh,$s1)) or die(mysqli_error());
    while ($r = mysqli_fetch_array($t1)){
    $c = $r["current_balance"];
    $_SESSION["current_balance"] = $c;
    }

}

function withdraw($u, $a,$v,$tp,$dbh){
    session_start();
		if($v < $a){
			echo("<br>Amount Exceeded");
      echo "<br><span style='color:red;'>Redirecting to form page</span>";
      header("refresh:2;url = formpage.php");
      exit();
      
		}else{
		  $s1 = "insert into Ttable values( '$u', '$tp', '$a', NOW() )";
      ($t1 = mysqli_query ($dbh,$s1)) or die(mysqli_error());
      echo "<br><br>SQL for updated Ttable is:<br> $s1";

      $m1 = "update Atable SET current_balance=current_balance - '$a' where user = '$u' ";
      echo "<br><br>SQL for deposit is:<br> $m1";
      ($n1 = mysqli_query ($dbh,$m1)) or die(mysqli_error());
       $s = "select*from Atable where user = '$u'";
      ($t = mysqli_query ($dbh,$s)) or die(mysqli_error());
      while ($r = mysqli_fetch_array($t)){
		  $c = $r["current_balance"];
      $_SESSION["current_balance"] = $c;
		}
  }
}


function show($u, &$out, $dbh){

    $s = "select * from Atable where user = '$u'";

    $b = "select * from Ttable where user = '$u' ORDER BY date DESC";

    $out = "<br><br>Atable:"; 
    $out .="<table border = '1'><tr><th>user</th><th>pass</th><th>fullname</th><th>email</th><th>address</th><th>cell</th><th>initial balance</th><th>current balance</th></tr>";
    ($t = mysqli_query ($dbh,$s)) or die(mysqli_error());
    while ($r = mysqli_fetch_array($t)) {
       $user = $r ["user"];
       $pass = $r ["pass"];
       $fullname = $r ["fullname"];
       $email = $r ["email"];
       $address = $r ["address"];
       $cell = $r ["cell"];
       $initial_balance = $r ["initial_balance"];
	     $balance = $r ["current_balance"];
        
	     $out .= "<tr><td>$user</td>";
       $out .= "<td>$pass</td>";
       $out .= "<td>$fullname</td>";
       $out .= "<td>$email</td>";
       $out .= "<td>$address</td>";
       $out .= "<td>$cell</td>";
       $out .= "<td>$initial_balance</td>";
	     $out .= "<td>$balance</td></tr>";
     
};

    $out .= "</table>";
    $out .= "<br><br>Ttable:";
    $out .= "<table border = '1'><tr><th>user</th><th>type</th><th>amount</th><th>date</th></tr>";
    ($n = mysqli_query ($dbh,$b)) or die(mysqli_error());
    while ($row1 = mysqli_fetch_array($n)) {
       $user = $row1 ["user"];
       $type = $row1 ["type"];
       $amount = $row1 ["amount"];
       $date = $row1 ["date"];
        
	     $out .= "<tr><td>$user</td>";
       $out .= "<td>$type</td>";
       $out .= "<td>$amount</td>";
       $out .= "<td>$date</td></tr>";
       
    }
    
    $out .= "</table>";
}

function get_mail_address($u,&$email,$dbh){
		$s = "select*from Atable where user ='$u'";
		($t = mysqli_query($dbh,$s)) or die (mysqli_error());
		while($r = mysqli_fetch_array($t)){
		$email = $r['email'];
		}
}
?>
