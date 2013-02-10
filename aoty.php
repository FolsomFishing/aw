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
	
//echo "<b>We are experiencing a technical glitch in AOTY.  I will let you all know when I get it fixed.  </b>";
	
	
    if (isset($_POST['username'])) {

        $username = $_POST['username'];
    }
    if (isset($_POST['species'])) {

        $species = $_POST['species'];
    }
    if (isset($_POST['order'])) {

        $order = $_POST['order'];
    }
    $catch_limit = 3;
    if (isset($_POST['limit'])) {
        $catch_limit = $_POST['limit'];
    }

    $sql_catch_pts = $mysqli->stmt_init();
    $sql_catch_pts->prepare(SQL_FIND_LAST_CATCHES . " LIMIT " . $catch_limit);
    $sql_total_pts = $mysqli->stmt_init();
    $sql_total_pts->prepare(SQL_FIND_TOP_ANGLERS . " LIMIT " . $catch_limit);

    echo "<br>";
    echo "<table id='top_anglers' class='tablesorter' >";
	echo "<thead>";
    //echo "<tr><td>Top " . $catch_limit . " Anglers</td>";
    //echo "</tr>";
    //echo "<table class='CSSTableGenerator_small'>";
    echo "<tr><b>  Points Leaders  </b></tr>";
    echo "<tr align='center'> <th> Username </th> <th> Total Points </th> <th> Catches Logged </th> </tr>";
	echo "</thead>";
	echo "<tbody>";
	
	$result = mysql_query(SQL_FIND_TOP_ANGLERS . " LIMIT " . $catch_limit);
    while ($row = mysql_fetch_array($result)) {
        echo "<tr><td align='center'>";
        echo "<a href='points.php?username=" . $row['username'] . "'>" . $row['username'] . "</a>";
        echo "</td><td align='center'>";
        echo $row['point_total'];
		echo "</td><td align='center'>";
		echo $row['catch_total'];
        echo "</td></tr>";
    }
    $sql_total_pts->close();
	
	echo "</tbody>";
	echo "</table>";
    echo "<br>";
	
    echo "<table id='last_catches' class='tablesorter' >";
	echo "<thead>";
  //  echo "<tr><td>Last " . $catch_limit . " Recorded Catches</td>";
    //echo "</tr>";
    //echo "<table class='CSSTableGenerator'>";
   echo "<tr><b>Last 3 Recorded Catches</b></tr>";
    echo "<tr align='center'> <th> Username </th> <th> Catch Id </th><th> Date Caught </th> <th> Species </th> <th> Method </th> <th> Location </th> 
		<th> Length </th><th> Points </th> <th> Notes </th> <th> Picture </th> </tr>";
	echo "</thead>";
	echo "<tbody>";

    $sql_catch_pts->execute();
    $sql_catch_pts->bind_result($catch_id, $username, $catch_date, $species, $method, $location, $length, $points, $comment, $pic);
    while ($sql_catch_pts->fetch()) {
        echo "<tr><td align='center'>";
        echo "<a href='points.php?username=" . $username . "'>" . $username . "</a>";
        echo "</td><td align='center'>";
        echo $catch_id;
        echo "</td><td align='center'>";
        echo date("m/d/y", strtotime($catch_date));
		//echo $catch_date;
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
        echo '<a href="images/' . $pic . '" target="_blank"><img src="images/thumbs/thumb_' . $pic . '"/> </a>';
        echo "</td></tr>";
    }
    $sql_catch_pts->close();
    echo "</tbody>";
	echo "</table>";
	
	//echo "</table>";
    //echo "</table>";
    echo "<br><br><br>";
    unset($_POST['Submit']);
    
	
	
	?>

</body>
<script type="text/javascript">
	$(function(){ 
		$("#top_anglers").tablesorter({
		theme: 'blue', widgets: ['zebra', 'columns'], 
		 widgetOptions: { columns_tfoot : true }
		}); 
	});
</script>	
<script type="text/javascript">
	$(function(){ 
		$("#last_catches").tablesorter({
		theme: 'blue', widgets: ['zebra'] 
		}); 
	});
	
</script>	
</html>








