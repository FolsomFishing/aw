<?php
ob_start();
include 'connect.php';
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("aoty", $con);
$id = $_GET['id'];
$query = mysql_query("SELECT * FROM images WHERE id=2");
$row = mysql_fetch_array($query);
$content = $row['image'];
header('Content-type: image/jpg');
         echo $content;
ob_flush();
?>