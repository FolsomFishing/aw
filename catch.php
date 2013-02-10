<?php session_start(); ?>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="aoty.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <title>Catch Form</title>
		 <link rel="stylesheet" type="text/css" href="css/theme.blue.css"> 
		 <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> 
		  <script src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
		<script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script> 
	


    <img src="images/AOTYlogo.jpg"><img src="images/logos.gif"  width="175" height="175">
</head>
</html>
<body>

<script type="text/javascript">

function setOptions(chosen){

var selbox = document.newad.species;
selbox.options.length = 0;

if (chosen == " ") {
	selbox.options[selbox.options.length] = new Option('Select Location',' ');
	}
if (chosen == "freshwater") {
	selbox.options[selbox.options.length] = new Option('Bass');
	selbox.options[selbox.options.length] = new Option('Salmon');
	selbox.options[selbox.options.length] = new Option('Striper');
	selbox.options[selbox.options.length] = new Option('Sturgeon');
	selbox.options[selbox.options.length] = new Option('Steelhead');
	selbox.options[selbox.options.length] = new Option('Catfish');
	selbox.options[selbox.options.length] = new Option('Trout');
	selbox.options[selbox.options.length] = new Option('Panfish');
	selbox.options[selbox.options.length] = new Option('Crappie');
	selbox.options[selbox.options.length] = new Option('Other');
	}
if (chosen == "saltwater") {
	selbox.options[selbox.options.length] = new Option('Salmon');
	selbox.options[selbox.options.length] = new Option('Striper');
	selbox.options[selbox.options.length] = new Option('White Sea Bass');
	selbox.options[selbox.options.length] = new Option('Tuna');
	selbox.options[selbox.options.length] = new Option('Flounder');
	selbox.options[selbox.options.length] = new Option('Ray');
	selbox.options[selbox.options.length] = new Option('Halibut');
	selbox.options[selbox.options.length] = new Option('Rockfish');
	selbox.options[selbox.options.length] = new Option('Lingcod');
	selbox.options[selbox.options.length] = new Option('Other');
	
	}
}

</script>

 <script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: '2013-mm-dd' });
});
</script>

<script type="text/javascript">
	$(function(){ 
		$("#record_catch").tablesorter({
		theme: 'blue', widgets: ['zebra', 'columns'], 
		 widgetOptions: { columns_tfoot : true }
		}); 
	});
</script>	

    <?php
    if (isset($_SESSION['loggedin'])) {
        include 'nav.php';
        include 'connect.php';
        include 'process_image.php';
        include 'email.php';
        include 'sql_statements.php';
    } else {
        echo '<script>alert("You must be logged into submit a catch")</script>';
        echo '<script>history.back(1);</script>';
        exit;
    }
    ?>
    <br>
    <form name="newad" action="catch.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <table  id='record_catch' class='tablesorter' >
		<thead>
        <tr><b>  Log a Catch  </b></tr>
		</thead>
		<tbody>
                           <tr>
                            <td align='right'>Method<FONT COLOR="red">*</font>:</td>
							<td><select name="method">
									<option value="bank">From Bank</option>    
									<option value="boat">From Boat</option>
									<option value="kayak">From Kayak</option>   
									<option value="other">Other</option>
                            </td>
                        </tr>
						<tr>
							<td align='right'>Date Caught<FONT COLOR="red">*</font>:</td>
							<td><input type="date" id="datepicker" name="catch_date" /></td>
                        <tr>
                            <td align='right'>Location<FONT COLOR="red">*</font>:</td>
                            <td><select name="location" size="1" onchange="setOptions(document.newad.location.options[document.newad.location.selectedIndex].value);">
							<option value=" " selected="selected"></option>
							<option value="freshwater">Freshwater</option>
							<option value="saltwater">Saltwater</option>
                            </td>
                        </tr>
                        <tr>
                            <td align='right'>Species<FONT COLOR="red">*</font>:</td>
                            <td><select name="species">
								<option value=" " selected="selected">No location selected</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align='right'>Length<FONT COLOR="red">*</font>:</td>
                            <td><input type="text" name="length">in inches.
                            </td>
                        </tr>
                        <tr>
                            <td align='right'>Picture<FONT COLOR="red">*</font>:</td>
                            <td><input type="file" name="image" >Only .jpg images are allowed. Max 2MB.
                            </td>

                        </tr>
                        <tr>
                            <td align='right'>Notes:</td>
                            <td><input type="text" name="comment">
                            </td>
                        </tr>	
                        <tr>
                            <td align='right'><FONT COLOR="red">* Required Field</font></td>
                            <td align="left"><input type="submit" 
                                                     name="Submit" value="Submit"></td>
                        </tr>
                   
                </td>
            </tr>
		</tbody>
        </table>
    </form>
    <?php
    if (isset($_POST['Submit'])) {
        $image_name = '';
        $image = $_FILES['image']['name'];
        if (isset($_POST['Submit'])) {
            $image_name = process_image($image);
        }

//This is trying to get all the error messages for all the 
//fields so the messages can be displayed at one time
//CURRENTLY doesnt work
//TODO:  Need to save all values entered, except for data entry errors
//      and repopulate the screen
        $error = FALSE;
        if (empty($image)) {
            echo '<script>alert("Please select a Picture.");</script>';
            $error = TRUE;
        }

        if (!isset($_POST['location'])) {
            echo '<script>alert("Please select a Location.");</script>';
            $error = TRUE;
        }

        if (!isset($_POST['method'])) {
            echo '<script>alert("Please select a Method.");</script>';
            $error = TRUE;
        }
		
        if ($error) {
            echo '<script>alert("error");</script>';
            echo '<script>history.back(1);</script>';
            exit;
        }

        if (isset($_POST['length'])) {

            $length = $_POST['length'];
        }
		
		if (isset($_POST['catch_date'])) {

            $catch_date = $_POST['catch_date'];
        }

        if (isset($_POST['species'])) {

            $species = $_POST['species'];
        }
		if ($species == "selected"){
		
			echo '<script>alert("Please select a Species.");</script>';
			echo '<script>history.back(1);</script>';
			exit;
		}
			
			
        if (isset($_POST['location'])) {

            $location = $_POST['location'];
        }

        if (isset($_POST['method'])) {

            $method = $_POST['method'];
        }

        if ($length <= 0) {
            echo '<script>alert("The Length entered is not valid.");</script>';
            echo '<script>history.back(1);</script>';
            exit;
        }

        if ($length > 120) {
            echo '<script>alert("The Length entered can not be more than 120.");</script>';
            echo '<script>history.back(1);</script>';
            exit;
        }

        $points = intval(round($length, 0));

        //grant 5 bonus pts for every 36 inches
        $points = intval(round($points + (intval($length / 36, 0) * 5), 0));

        //calculates the bonus points of 1pt/12inches
        //returns only the integer portion. Then adds the points and round
        $points = intval(round(($points + intval($length / 12, 0)), 0));

//look for the user and get their 'id'
        $sql_find_person = $mysqli->stmt_init();
        $sql_find_person->prepare(PS_FIND_PERSON_BY_USERID);
        $sql_find_person->bind_param("i", $_SESSION['id']);
        if ($sql_find_person->execute()) {
            $sql_find_person->bind_result($id, $a, $a1, $a2, $email);
            if (!$sql_find_person->fetch()) {
                echo '<script>alert("The Username and/or Password not found.");</script>';
                echo '<script>history.back(1);</script>';
                exit;
            }
        }
        $sql_find_person->close();

//save the catch item
        $sql_create_catch = $mysqli->stmt_init();
        $sql_create_catch->prepare(PS_CREATE_CATCH);
        $sql_create_catch->bind_param("dsdssssis", $length, $_POST['species'], $points, $_POST['catch_date'], $_POST['location'],  $_POST['method'], $_POST['comment'], $_SESSION['id'], $image_name);
        if ($sql_create_catch->execute()) {
            if ($sql_create_catch->affected_rows == 1) {
                echo '<script>alert("Nice ' . $length . ' inch ' . $species . '.  Your points total has been updated.");</script>';
                echo '<script>;</script>';
                sendEmail($email, "Nice Catch", "Your catch has been logged and points total has been updated on AnglingWes AOTY 2013.");
                exit;
            } else {
                echo '<script>alert("There was an issue communicating with the server.  Please try again.")';
                echo '<script>location = "aoty.php";</script>';
                exit;
            }
        } else {
                echo '<script>alert("Error entering catch.")';
                //echo '<script>location = "aoty.php";</script>';
                exit;
        }
        $sql_create_catch->close();
        unset($_POST['Submit']);
    }
    ?>

</body>


</html>
