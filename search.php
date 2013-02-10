<form action="points.php" method="get">
    Choose username to view their catches<select name="username">
        <?php
        include 'connect.php';
        include 'sql_statements.php';
        $sql_find_usernames = $mysqli->stmt_init();
        $sql_find_usernames->prepare(SQL_FIND_UNIQUE_USERNAMES);
        if ($sql_find_usernames->execute()) {
            $sql_find_usernames->bind_result($username);
            while ($sql_find_usernames->fetch()) {
                echo "<option value='" . $username . "'>" . $username . "</option>";
            }
        }
        $sql_find_usernames->close();
        ?>
    </select>
    <input type="submit" value="Submit">
</form>        
<br>
<form action="points.php" method="get">
    Select species to see all recorded catches for:
    <select name="species">
		<option value ="selected">Please Select</option>
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
<?php

if (isset($_GET['species'])){

	if($_GET['species'] == "selected"){

	echo '<script>alert("Please select a Species.");</script>';
			echo '<script>history.back(1);</script>';
			exit;
		}
}


?>