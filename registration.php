

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 
    Transitional//EN" 
    "http://www.w3.org/TR/html4/loose.dtd">
<html>

    <head>
        <title>AnglingWes.com AOTY 2013 Registration Form</title>
        
		 <link rel="stylesheet" type="text/css" href="css/theme.blue.css"> 
<link rel="stylesheet" type="text/css" href="aoty.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script> 
    <img src="images/AOTYlogo.jpg"> <img src="images/logos.gif"  width="175" height="175">
</head>
<body>
    <?php
    include 'nav.php';
    ?>

    <form action="register.php" method="post" autocomplete="off">
         <table id='register' class='tablesorter'>
        <thead>
        <tr><b>  Register for AOTY 2013  </b></tr>
		</thead>
		<tbody>
                        <td align='right'>First Name<FONT COLOR="red">*</font>:</td>
                        <td><input type="text" name="firstname"/>
                        </td>
            </tr>
            <tr>
                <td align='right'>Last Name<FONT COLOR="red">*</font>:</td>
                <td><input type="text" name="lastname"/>
                </td>
            </tr>
            <tr>
                <td align='right'>Username<FONT COLOR="red">*</font>:</td>
                <td><input type="text" name="username"/>
                </td>
            </tr>
            <tr>
                <td align='right'>Email Address<FONT COLOR="red">*</font>:</td>
                <td><input type="text" name="email"/>
                </td>
            </tr>
            <tr>
                <td align='right'>Password<FONT COLOR="red">*</font>:</td>
                <td><input type="password" name="password"/>
                </td>
            </tr>
            <tr>
                <td align='right'>Confirm Password<FONT COLOR="red">*</font>:</td>
                <td><input type="password" name="confirm_pass"/>
                </td>
            </tr>
			
            <tr>
                <td align='right' ><FONT COLOR="red">* Required Field</font></td>
                <td align="left"><input type="submit" 
                                         name="submit" value="Submit"/></td>
            </tr>
       </tbody>
    </table>
</form>

<br>
<br>
<br>
</body>
<script type="text/javascript">
	$(function(){ 
		$("#register").tablesorter({
		theme: 'blue', widgets: ['zebra', 'columns'], 
		 widgetOptions: { columns_tfoot : true }
		}); 
	});
</script>	

</html> 