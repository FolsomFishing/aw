<?php session_start(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 
    Transitional//EN" 
    "http://www.w3.org/TR/html4/loose.dtd">
<html>

    <head>
        <title>AnglingWes.com AOTY Leader Board</title>
        <link rel="stylesheet" type="text/css" href="css/theme.blue.css"> 
<link rel="stylesheet" type="text/css" href="aoty.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script> 

    <img src="images/AOTYlogo.jpg"><img src="images/logos.gif"  width="175" height="175">
 

</head>

<body>
    <?php
    include 'nav.php';
    include 'search.php';
    include 'connect.php';
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }
    if (isset($_POST['species'])) {
        $species = $_POST['species'];
    }
    if (isset($_POST['order'])) {

        $order = $_POST['order'];
    }
    $catch_limit = 5;
    if (isset($_POST['limit'])) {
        $catch_limit = $_POST['limit'];
    }



    echo "<br><br>";
	
    echo "<table id='top_anglers' class='tablesorter' >";
	echo "<thead>";
    //echo "<tr><td>Top " . $catch_limit . " Anglers</td>";
    //echo "</tr>";
    //echo "<table class='CSSTableGenerator_small'>";
	echo "<tr><b>  Points Leaders  </b></tr>";
    echo "<tr align='center'> <th> Username </th> <th> Total Points </th> <th> Catches Logged </th> </tr>";
	echo "</thead>";
	echo "<tbody>";
    $result = mysql_query(SQL_FIND_TOP_ANGLERS);
    while ($row = mysql_fetch_array($result)) {
        echo "<tr><td align='center'>";
        echo "<a href='points.php?username=" . $row['username'] . "'>" . $row['username'] . "</a>";
        echo "</td><td align='center'>";
        echo $row['point_total'];
        echo "</td><td align='center'>";
		echo $row['catch_total'];
		echo "</td></tr>";
    }
	
    
    echo "</tbody>";
	echo "</table>";



	
	
	
    echo "<br><br>";
	 echo "<tr><br><b>Last $catch_limit Recorded Catches</b></tr><br>";
		 echo "<tr>View Last <a href='points.php?catch_limit=10'><b>10</b></a>,  <a href='points.php?catch_limit=50'><b>50</b></a>,   <a href='points.php?catch_limit=100'><b>100</b></a>  Catches</tr><br>";
    echo "<table id='last_catches' class='tablesorter' >";
	echo "<thead>";
   // echo "<tr><td>Last " . $catch_limit . " Recorded Catches</td>";
   // echo "</tr>";
   // echo "<table class='CSSTableGenerator'>";
   // echo "<tr><b>Last 10 Recorded Catches</b></tr>";
    echo "<tr align='center'> <th> Username </th> <th> Catch Id </th><th> Date Caught </th> <th> Species </th> <th> Method </th> <th> Location </th> 
		<th> Length </th><th> Points </th> <th> Notes </th> <th> Picture </th> </tr>";
	echo "</thead>";
	echo "<tbody>";
    $result = mysql_query(SQL_FIND_LAST_CATCHES . " LIMIT " . $catch_limit);
    while ($row = mysql_fetch_array($result)) {
        echo "<tr><td align='center'>";
        echo "<a href='points.php?username=" . $row['username'] . "'>" . $row['username'] . "</a>";
        echo "</td><td align='center'>";
        echo $row['catch_id'];
        echo "</td><td align='center'>";
        echo date("m/d/y", strtotime($row['catch_date']));
        echo "</td><td align='center'>";
        echo "<a href='points.php?species=" . $row['species'] . "'>" . $row['species'] . "</a>";
        echo "</td><td align='center'>";
        echo "<a href='points.php?method=" . $row['method'] . "'>" . $row['method'] . "</a>";
        echo "</td><td align='center'>";
        echo "<a href='points.php?location=" . $row['location'] . "'>" . $row['location'] . "</a>";
        echo "</td><td align='center'>";
        echo $row['length'] . ' in.';
        echo "</td><td align='center'>";
        echo $row['points'];
        echo "</td><td align='center'>";
        echo $row['comment'];
        echo "</td><td align='center'>";
        echo '<a href="images/' . $row['pic'] . '"><img src="images/thumbs/thumb_' . $row['pic'] . '"/> </a>';
        echo "</td></tr>";
    }
    echo "</body>";
    echo "</table>";
    echo "<br><br><br>";
    unset($_POST['Submit']);
    include 'recorded_catches.php';
	
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








