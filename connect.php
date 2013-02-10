<?php
$con = mysql_connect("aoty.db.8448600.hostedresource.com", "aoty", "Missymoo1!");
if (!$con) {
    die('Could not connect: ' . mysql_error());
} else {
    mysql_select_db("aoty", $con);
}

/* Create a new mysqli object with database connection parameters */
GLOBAL $mysqli;
$mysqli = new mysqli("aoty.db.8448600.hostedresource.com", "aoty", "Missymoo1!", 'aoty');
if (mysqli_connect_errno()) {
    echo "Connection Failed: " . mysqli_connect_errno();
    exit();
}
?> 