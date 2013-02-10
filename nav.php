<ul id="list-nav">
    <li><a href="aoty.php">Home</a></li>
    <li><a href="rules.php">Rules</a></li>
    <li><a href="catch.php">Log a Catch</a></li>
    <li><a href="leaders.php">Leader Board</a></li>
    <li><a href="points.php?catch_limit=30">Recent Catches</a></li>
    <?php
    if (!isset($_SESSION['loggedin'])) {
        include 'login.php'; // Make sure they are logged in!
        
        echo 'or Click <a href="registration.php"> HERE</a> to Register for AOTY.';
        echo '<br>';
    }
    if (isset($_SESSION['loggedin'])) {
        echo '<br>';
		echo '<br>';
        echo "Hello, <font color = 'blue'><b>{$_SESSION['name']}</b></font>! Visit your<a href='profile.php'> Profile Page</a>.";
        echo '<br>';
		//echo 'Visit your<a href="profile.php"> Profile Page</a>.';
		//echo '<br>';
    }
    ?>
</ul>
