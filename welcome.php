<?php
session_start();
if (!isset($_SESSION["user"])){
 header( "Refresh:1; url=index.html", true, 303);
 }
?>

<html>
<head>
</head>
<body>
<a href="docLoc.php">Location</a>
<a href="specialitySearch.php">Speciality</a>
<a href="insuranceSearch.php">Insurance</a>
</body>

</html>
