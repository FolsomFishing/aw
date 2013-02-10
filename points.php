<?php session_start(); ?>

<html>

    <head>
       
 
<link rel="stylesheet" type="text/css" href="aoty.css">
 <link rel="stylesheet" type="text/css" href="css/theme.blue.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script> 

        <title>Total Points</title>
    <img src="images/AOTYlogo.jpg"> <img src="images/logos.gif"  width="175" height="175">
</head>
<body>
    <?php
    include 'nav.php';
    include 'search.php';
    include 'connect.php';
	
	
//Check for what the category is
//for each of the categories check to see which one is popuates
//Then set the sql_catch_pts and the sql_total_pts
    $catches = FALSE;
    if (isset($_GET['username'])) {
        $category = $_GET['username'];
        $sql_catch_pts = $mysqli->stmt_init();
        $sql_catch_pts->prepare(PS_SELECT_CATCH_POINTS_BY_USERNAME);
        $sql_total_pts = $mysqli->stmt_init();
        $sql_total_pts->prepare(PS_SELECT_TOTAL_POINTS_BY_USERNAME);
    } elseif (isset($_GET['species'])) {
        $category = $_GET['species'];
        $sql_catch_pts = $mysqli->stmt_init();
        $sql_catch_pts->prepare(PS_SELECT_CATCH_POINTS_BY_SPECIES);
        $sql_total_pts = $mysqli->stmt_init();
        $sql_total_pts->prepare(PS_SELECT_TOTAL_POINTS_BY_SPECIES);
    } elseif (isset($_GET['location'])) {
        $category = $_GET['location'];
        $sql_catch_pts = $mysqli->stmt_init();
        $sql_catch_pts->prepare(PS_SELECT_CATCH_POINTS_BY_LOCATION);
        $sql_total_pts = $mysqli->stmt_init();
        $sql_total_pts->prepare(PS_SELECT_TOTAL_POINTS_BY_LOCATION);
    } elseif (isset($_GET['method'])) {
        $category = $_GET['method'];
        $sql_catch_pts = $mysqli->stmt_init();
        $sql_catch_pts->prepare(PS_SELECT_CATCH_POINTS_BY_METHOD);
        $sql_total_pts = $mysqli->stmt_init();
        $sql_total_pts->prepare(PS_SELECT_TOTAL_POINTS_BY_METHOD);
    } elseif (isset($_GET['catch_limit'])) {
        $catches = TRUE;
        $catch_limit = $_GET['catch_limit'];
        $sql_catch_pts = $mysqli->stmt_init();
        $sql_catch_pts->prepare(SQL_FIND_LAST_CATCHES . " LIMIT " . $catch_limit);
    }

//get the points total for the categorty.  If so some reason there is a 
//problem then dont show the total on the page
    if (!$catches) {
        $sql_total_pts->bind_param('s', $category);
        if ($sql_total_pts->execute()) {
            $sql_total_pts->bind_result($point_total);
            while ($sql_total_pts->fetch()) {
                echo "<br><font size='14' color='blue'> Points total for  " . $category . ": ";
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
    echo "<tr align='center'><th>Username</th><th>Catch Id</th><th>Date Caught</th><th>Species</th><th>Method</th><th>Location</th><th>Length</th><th>Points</th><th>Notes</th><th>Picture</th></tr>";
    echo "</thead>";
	echo "<tbody>";
	if (!$catches) {
        $sql_catch_pts->bind_param('s', $category);
    }
    $sql_catch_pts->execute();
    $sql_catch_pts->bind_result($catch_id, $username, $catch_date, $species, $method, $location, $length, $points, $comment, $pic);
    while ($sql_catch_pts->fetch()) {
        echo "<tr><td align='center'>";
        echo "<a href='points.php?username=" . $username . "'>" . $username . "</a>";
        echo "</td><td align='center'>";
        echo $catch_id;
        echo "</td><td align='center'>";
        echo date("m/d/y", strtotime($catch_date));
        echo "</td><td align='center'>";
        echo "<a href='points.php?species=" . $species . "'>" . $species . "</a>";
        echo "</td><td align='center'>";
        echo "<a href='points.php?method=" . $method . "'>" . $method . "</a>";
        echo "</td><td align='center'>";
        echo "<a href='points.php?location=" . $location . "'>" . $location . "</a>";
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
    echo "<br><br>";

    $sql_catch_pts->close();
    unset($_POST['Submit']);
			
    ?>
</body>
<script type="text/javascript">
	$(function(){ 
		$("#recorded_catches").tablesorter({
		theme: 'blue', widgets: ['zebra'] 
		}); 
	});
</script>	