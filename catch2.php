<html>

<head>
<link rel="stylesheet" type="text/css" href="aoty.css">
<title>Catch Form</title>


<ul id="list-nav">
  <li><a href="aoty.html">Home</a></li>
  <li><a href="rules.html">Rules</a></li>
  <li><a href="register.html">Register</a></li>
  <li><a href="catch.html">Log a Catch</a></li>
    <li><a href="leaders.php">Leader Board</a></li>
 </ul>
  
</head>
</html>

<?php
include 'connect.php';
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("my_db", $con);
$username = $_POST[username];
$password = $_POST[pass];
$length = $_POST[length];
$species = $_POST[species];
$points;
$rows;


if ($species == bass){
	$points = $length * 10;
}

elseif ($species == salmon){
	$points = $length * 5;
}

elseif ($species == trout){
	$points = $length * 7.5;
}

elseif ($species == sturgeon){
	$points = $length * 3.5;
}

elseif ($species == striper){
	$points = $length * 5;
}

$sql =  "INSERT INTO aoty.catches (length, species, points, user_id, pic_thumb)
          SELECT $length, '$_POST[species]', $points, id, '$_POST[picture]' FROM aoty.people WHERE Username = '$_POST[username]' AND Password = '$_POST[pass]' ";
          
$sql2 = "UPDATE aoty.people SET point_total=point_total+$points WHERE Username = '$_POST[username]' AND Password = '$_POST[pass]'";
          
$sql3 = "SELECT COUNT(*) AS $rows FROM aoty.people WHERE Username = '$_POST[username]' AND Password = '$_POST[pass]'"    


                  
          
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "<br><br><br>Nice Catch $username.  That $length inch $species scored you $points points. ";



if (!mysql_query($sql2,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "Your points total has been updated. ";
mysql_close($con);

?> 