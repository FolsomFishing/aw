<?php session_start(); // NEVER forget this!    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 
    Transitional//EN" 
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <title>Welcome to AW AOTY 2013</title>
    <img src="images/AOTYlogo.jpg"> <img src="images/logos.gif"  width="175" height="175">
    
	 <link rel="stylesheet" type="text/css" href="css/theme.blue.css"> 
	 <link rel="stylesheet" type="text/css" href="aoty.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script> 
</head>

<body>
 
 <?php
    include 'nav.php';
    if(isset($_SESSION['loggedin'])){
        include 'connect.php';
        include 'sql_statements.php';

    }
 if (isset($_SESSION['name'])) {

        $username = $_SESSION['name'];
    }
	
//echo "$username";
$catches = FALSE;
    if (isset($username)) {
        $category = $username;
        $sql_catch_pts = $mysqli->stmt_init();
        $sql_catch_pts->prepare(PS_SELECT_CATCH_POINTS_BY_USERNAME);
        $sql_total_pts = $mysqli->stmt_init();
        $sql_total_pts->prepare(PS_SELECT_TOTAL_POINTS_BY_USERNAME);
		}
		
		 if (!$catches) {
        $sql_total_pts->bind_param('s', $category);
        if ($sql_total_pts->execute()) {
            $sql_total_pts->bind_result($point_total);
            while ($sql_total_pts->fetch()) {
                echo "<br><font size='12' color='blue'> Points total for  " . $category . ": ";
                echo $point_total . "</font>";
            }
            $sql_total_pts->close();
        }
    }
	
	  echo "<br>";
    echo "<table id='recorded_catches' class='tablesorter'>";
    echo "<thead>";
	if ($catches) {
		
		 echo "<tr><br><b>Last $catch_limit Recorded Catches</b></tr><br>";
		 echo "<tr>View Last <a href='points.php?catch_limit=10'><b>10</b></a>,  <a href='points.php?catch_limit=50'><b>50</b></a>,   <a href='points.php?catch_limit=100'><b>100<b></a>  Catches</tr>";
	   
    } else {
        echo "<tr><b> Recorded Catches for $category</b></tr>";
    }
    //echo "<table class='CSSTableGenerator'>";
    echo "<tr align='center'><th>Catch Id</th><th>Date Caught</th><th>Species</th><th>Method</th><th>Location</th><th>Length</th><th>Points</th><th>Notes</th><th>Picture</th></tr>";
    echo "</thead>";
	echo "<tbody>";
	if (!$catches) {
        $sql_catch_pts->bind_param('s', $category);
    }
    $sql_catch_pts->execute();
    $sql_catch_pts->bind_result($catch_id, $username, $catch_date, $species, $method, $location, $length, $points, $comment, $pic);
    while ($sql_catch_pts->fetch()) {
        echo "</td><td align='center'>";
        echo $catch_id;
        echo "</td><td align='center'>";
        echo date("m/d/y", strtotime($catch_date));
        echo "</td><td align='center'>";
        echo "$species";
        echo "</td><td align='center'>";
        echo "$method";
        echo "</td><td align='center'>";
        echo "$location";
        echo "</td><td align='center'>";
        echo $length;
        echo " in.";
        echo "</td><td align='center'>";
        echo $points;
        echo "</td><td align='center'>";
        echo $comment;
        echo "</td><td align='center'>";
        echo '<a href="images/' . $pic . '"><img src="images/thumbs/thumb_' . $pic . '"/> </a>';
        echo "</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
	
	?>
</body>
<script type="text/javascript">
	$(function(){ 
		$("#recorded_catches").tablesorter({
		theme: 'blue', widgets: ['zebra'] 
		}); 
	});
</script>	
</html>
