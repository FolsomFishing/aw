<html>

<head>
<link rel="stylesheet" type="text/css" href="aoty_center.css">
<title>Points by Species</title>
<img src="images/wesavatar_small.jpg">

<?php
include 'nav.php';
?>
  
</head>
<body>
<br>
<br>
<br>


<form action="" method="post">
Select species to see all recorded catches for:
<select name="species">
			<optgroup label="Freshwater Species">
        	<option value="bass">Bass</option>
        	<option value="striper">Striper</option>
        	<option value="salmon">Salmon</option>
        	<option value="sturgeon">Sturgeon</option>
        	<option value="trout">Trout</option>
			<option value="shad">Shad</option>
			<option value="steelhead">Steelhead</option>
			<option value="catfish">Catfish</option>
			<option value="panfish">Panfish</option>
			<option value="crappie">Crappie</option>
			<option value="other">Other</option>
			<optgroup label="Saltwater Species">
			<option value="striper">Striper</option>
        	<option value="salmon">Salmon</option>
        	<option value="sturgeon">Sturgeon</option>
			<option value="whiteseabass">White Sea Bass</option>
			<option value="halibut">Halibut</option>
			<option value="rockbass">Rock Bass</option>
        	</select>
	    
        	<input type="submit" name="submit" value="Select">
        	</form>
        	</body>
</html>

<?php
include 'connect.php';

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("aoty", $con);


$result2 = mysql_query("SELECT id, user_id, username, logged, species, method, location, length, points, comment, pic FROM people, catches 
	WHERE user_id = id AND species = '$_POST[species]' ORDER BY logged DESC LIMIT 20");

//$username = $_POST[username];
if(isset($_POST['username'])){

     $username= $_POST['username'];

 }
 
//$species = $_POST[species];
if(isset($_POST['species'])){

     $species= $_POST['species'];

 }

echo "<br><br><br>";
//echo "View Last <a href='?limitby=10'>10</a>, <a href='?limitby=20'>20</a>, <a href='?limitby=50'>50</a>, <a href='?limitby=100'>100</a> Catches";
//echo "<br><br>";
echo "<table class='CSSTableGenerator' border ='1' >";
echo "<tr><td>Last 20 Recorded Catches for $species</td></tr>";
echo "<table class='CSSTableGenerator' border ='1' >";
echo "<tr><td>Username</td><td>Date Caught</td><td>Species</td><td>Method</td><td>Location</td><td>Length</td><td>Points</td><td>Notes</td><td>Picture</td></tr>";

while($row = mysql_fetch_array( $result2 )) {

	echo "<tr><td align='center'>"; 
	echo $row['username'];
	echo "</td><td align='center'>"; 
	echo date("m/d/y", strtotime ($row['logged']));
	echo "</td><td align='center'>"; 
	echo $row['species'];
	echo "</td><td align='center'>"; 
	echo $row['method'];
	echo "</td><td align='center'>"; 
	echo $row['location'];
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