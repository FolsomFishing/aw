<html>

<head>
<link rel="stylesheet" type="text/css" href="aoty.css">
<title>Catch Form</title>


<ul id="list-nav">
  <li><a href="aoty.html">Home</a></li>
  <li><a href="rules.html">Rules</a></li>
  <li><a href="register.html">Register</a></li>
  <li><a href="catch.html">Log a Catch</a></li>
    <li><a href="leaders.html">Leader Board</a></li>
 </ul>
  
</head>
</html>

<?php
include 'connect.php';

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("aoty", $con);

$result = mysql_query("SELECT point_total FROM people WHERE Username = '$_POST[username]'");

$username = $_POST[username];


While($row = mysql_fetch_array($result))
  {
  echo "<br><br><br>  $username, you have ";
  echo $row['point_total'] . " " . $row['LastName'];
  echo " total points";
  }



mysql_close($con);



?>