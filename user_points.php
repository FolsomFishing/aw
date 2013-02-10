<html>

<head>
<link rel="stylesheet" type="text/css" href="aoty_center.css">
<title>Points by User</title>
<img src="images/wesavatar_small.jpg">

<?php
include 'nav.php';
?>
  
</head>
</html>

<?php
include 'connect.php';

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }



mysql_select_db("aoty", $con);

$limitby = array('10', '20', '50', '100');

$limit = '10';
if (isset($_GET['limitby'])) {
    $limit = $_GET['limitby'];
}


if(isset($_POST['username'])){

     $username= $_POST['username'];

 }



		
$sql2 = mysql_query("SELECT point_total FROM people WHERE username = '$_POST[username]'");

//$username = $_POST[username];

$sql3= mysql_query("SELECT SUM(b.points) as point_total
		FROM people as a, catches as b
		WHERE a.id = b.user_id AND a.username='$_POST[username]' ");


$sql_test2 = "SELECT username FROM people WHERE username = '$_POST[username]'";
$sql_test = "SELECT id, user_id, species, length, points, pic FROM people, catches WHERE user_id = id AND username = '$_POST[username]'";
/*
$orderBy = array('Species', 'Points');

$order = 'Points';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
}
*/
$sql = mysql_query("SELECT id, user_id, species, length, logged, points, comment, pic FROM people, catches 
		WHERE user_id = id AND username = '$_POST[username]'ORDER BY logged DESC");



$result = mysql_query($sql_test2, $con);

if (!mysql_num_rows($result)) {
  echo '<script>alert("The user name you entered is not valid.");</script>';
   echo '<script>history.back(1);</script>';
  exit;
}          

While($row = mysql_fetch_array($sql3))
 {
 echo "<br><br><br><font size='14' color='blue'> $username has ";
 echo $row['point_total'] ;
 echo " total points. </font>";
  }


echo "<br><br><br>";
echo "<table class='CSSTableGenerator' border = '1' >";
echo "<tr>";
echo "<td>$username's Recorded Catches</td>";
echo "</tr>";
echo "<table class='CSSTableGenerator'>";
echo "<tr> <td>Date Caught</td> <td>Species</td> <td>Legnth</td> <td>Points</td> <td>Notes</td> <td>Picture</td> </tr>";

while($row = mysql_fetch_array( $sql )) {
	
	echo "<tr><td align='center'>"; 
	echo date("m/d/y", strtotime ($row['logged']));
	echo "</td><td align='center'>";
	echo $row['species'];
	echo "</td><td align='center'>"; 
	echo $row['length'];
	echo " in.";
	echo "</td><td align='center'>"; 
	echo $row['points'];
	echo "</td><td align='center'>"; 
	echo $row['comment'];
	echo "</td><td align='center'>";
	echo '<a href="images/'.$row['pic'].'.jpg"><img src="images/thumbs/thumb_'.$row['pic'].'.jpg"/> </a>';
	echo "</td></tr>"; 
} 

echo "</table>";
echo "</table>";
echo "<br><br>";







mysql_close($con);



?>