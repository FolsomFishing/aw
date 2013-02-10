<html>

    <head>
         <link rel="stylesheet" type="text/css" href="css/theme.blue.css"> 
<link rel="stylesheet" type="text/css" href="aoty.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script> 

        <title>AOTY Registration</title>

    </head>
<body>


<?php
include 'connect.php';
include 'email.php';
include 'sql_statements.php';


// EMPTY FIELD CHECK
if ((empty($_POST['firstname'])) || (empty($_POST['lastname'])) || (empty($_POST['username'])) || (empty($_POST['email'])) || (empty($_POST['password'])) || (empty($_POST['confirm_pass']))) {
    echo '<script>alert("Please complete all of the fields to register for AOTY 2013.");</script>';
    echo '<script>history.back(1);</script>';
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("The email address you entered is not valid.");</script>';
    echo '<script>history.back(1);</script>';
    exit;
}

if ($_POST['password'] != $_POST['confirm_pass']) {
    echo '<script>alert("The passwords do not match.");</script>';
    echo '<script>history.back(1);</script>';
    exit;
}

$username = $_POST['username'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$pswd = $_POST['password'];

$sql_username = $mysqli->stmt_init();
$sql_username->prepare(PS_FIND_PERSON_BY_USER);
$sql_username->bind_param("s", $username);
$sql_username->execute();
if ($sql_username->fetch()) {
    echo '<script>alert("Username is unavailable")</script>';
    echo '<script>history.back(1);</script>';
    exit;
} else {
    //create the insert and execute it.  If successful then send an email to the user otherwise fail
    $sql_create_person = $mysqli->stmt_init();
    $sql_create_person->prepare(PS_CREATE_PERSON);
    $sql_create_person->bind_param("sssss", $username, $fname, $lname, $email, $pswd);
    if ($sql_create_person->execute()) {
        if ($sql_create_person->affected_rows == 1) {
            sendEmail($email, "AnglingWes AOTY Registration", "You are now registered for Anglingwes AOTY 2013. You may start posting catches and earning points.", "aoty@anglingwes.com");
            echo '<script>alert("'.$username.', thanks for registering for AOTY 2013. You will receive a confirmation email shortly.");</script>';
            echo '<script>location = "aoty.php";</script>';
            exit;
        } else {
            //TODO: need rollback of the rows just inserted
            die('Error rows: ' . $sql_create_person->error);
        }
    } else {
        //TODO: need rollback of the rows just inserted
        die('Error execute: ' . $sql_create_person->error);
    }
    $sql_create_person->close();
}

$sql_username->close();
?> 
</body>

</html>
