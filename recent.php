<?php
$catch_limit = 3;
    if (isset($_POST['limit'])) {
        $catch_limit = $_POST['limit'];
    }

    $sql_catch_pts = $mysqli->stmt_init();
    $sql_catch_pts->prepare(SQL_FIND_LAST_CATCHES . " LIMIT " . $catch_limit);
        echo "<br><br>";
    echo "<table class='CSSTableGenerator' >";
    echo "<tr><td>Last " . $catch_limit . " Recorded Catches</td>";
    echo "</tr>";
    echo "<table class='CSSTableGenerator'>";
    echo "<tr> <td> Username </td><td> Catch Id </td> <td> Date </td> <td> Species </td> <td> Method </td> <td> Location </td> 
		<td> Length </td><td> Points </td> <td> Notes </td> <td> Picture </td> </tr>";

    $sql_catch_pts->execute();
    $sql_catch_pts->bind_result($catch_id, $username, $logged, $species, $method, $location, $length, $points, $comment, $pic);
    while ($sql_catch_pts->fetch()) {
        echo "<tr><td align='center'>";
        echo "<a href='points.php?username=" . $username . "'>" . $username . "</a>";
        echo "</td><td align='center'>";
        echo $catch_id;
        echo "</td><td align='center'>";
        echo date("m/d/y", strtotime($logged));
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
    echo "</table>";
    echo "</table>";
    echo "<br><br><br>";

?>
