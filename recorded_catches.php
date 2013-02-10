

<html>
<head>



<link rel="stylesheet" type="text/css" href="css/theme.blue.css"> 

<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script> 



</head>

<?php

 $sql_catch_count = $mysqli->stmt_init();
 $sql_catch_count->prepare(PS_CHART_1);
 $sql_catch_count->execute();
 $sql_catch_count->bind_result($species, $COUNT);
 
echo "<table id='species_recorded' class='tablesorter'>";
echo "<thead>";
//echo "<tr><td>Species Recorded</td>";
//echo "</tr>";  
//echo "<table class='CSSTableGenerator_small'>";
echo "<tr><b>  Catches by Species </b> </tr>";
echo "<tr align='center'><th>Species</th><th>Number Caught</th></tr>";
echo "</thead>";
echo "<tbody>";
 while ($sql_catch_count->fetch()) {
        echo "<tr><td align='center'>";
        echo "<a href='points.php?species=" . $species . "'>" . $species . "</a>";
        echo "</td><td align='center'>";
        echo $COUNT;
		echo "</td></tr>";
		}
echo "</tbody>";
echo "</table>";
echo "<br>";
echo "<br>";
echo "<br>";

?>
<html>
<script type="text/javascript">
	$(function(){ 
		$("#species_recorded").tablesorter({
		theme: 'blue', widgets: ['zebra'] 
		}); 
	});
</script>	
</html>
