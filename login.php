<?php
//session_start();
include 'connect.php';
include 'sql_statements.php';

// This starts the session which is like a cookie, but it isn't saved on your hdd and is much more secure.
if (isset($_SESSION['loggedin'])) {
    echo '<script>alert("You are already logged in!");</script>';
    echo '<script>history.back(1);</script>';
    exit;
} 

// That bit of code checks if you are logged in or not, and if you are, you can't log in again!
if (isset($_POST['submit'])) {
    $sql_find_person = $mysqli->stmt_init();
    $sql_find_person->prepare(PS_FIND_PERSON_BY_USER_PASS);
    $sql_find_person->bind_param("ss", $_POST['username'], $_POST['pass']);
    if ($sql_find_person->execute()) {
        $sql_find_person->bind_result($id, $user, $a1, $a2, $email);
        if (!$sql_find_person->fetch()) {
            echo '<script>alert("The Username and/or Password not found.");</script>';
            echo '<script>history.back(2);</script>';
            exit;
        }
    }
    $sql_find_person->close();

    $pass = $_POST['pass'];
    $_SESSION['loggedin'] = "YES"; // Set it so the user is logged in!
    $_SESSION['name'] = $user; // Make it so the username can be called by $_SESSION['name']
    $_SESSION['id'] = $id;
    echo '<script>history.back(2);</script>';
    exit;
} // That bit of code logs you in! The "$_POST['submit']" bit is the submission of the form down below VV
?>
<html>

<body>
<br>
<br>
<div id="container">
  <div  class="topnav"> Have an account? <a href="login" class="signin"><span>Sign in</span></a> </div>
  
  <fieldset id="signin_menu">
    <form method="post" id="signin" type='login.php'>
      Username:
        <input type="text" name="username">
        Password:
        <input type="password" name="pass">

        <input type="submit" name="submit" value="Login">
    </form>
  </fieldset>
</div>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.tipsy.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {          
				e.preventDefault();
                $("fieldset#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
            });
			
			$("fieldset#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("fieldset#signin_menu").hide();
				}
			});			
			
        });
</script>


   

</html>
