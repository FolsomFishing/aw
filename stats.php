<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 
Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<title>AOTY 2013 Leader Board</title>
<img src="images/wesavatar_small.jpg">
<link rel="stylesheet" type="text/css" href="aoty_center.css">
<?php
include 'nav.php';
?>
</head>

<body>
  
<br>
<br>
<br>

<form action="user_points.php" method="post">
Input Username to view all catches:<input type="text" name="username">        	
<input type="submit" value="Submit">
</form>        
<br>

<form action="species_points.php" method="post">
Select species to see the last 10 recorded catches for:
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
