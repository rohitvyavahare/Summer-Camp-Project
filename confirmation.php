<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Happy Days Summer Camp</title>
    <link rel="stylesheet" type="text/css" href="form.css" />
    <script type="text/javascript" src="http://jadran.sdsu.edu/jquery/jquery.js"></script>
    <!--<script type="text/javascript" src="form.js"></script>-->
	<script type="text/javascript" src="ajax_form.js"></script>
	<link rel="shortcut icon" type="image/png" href="Images/icon.png"/>
</head>

<body>
<div id="header">
    <h1>Congratulations, Your registration completed</h1>
</div>
<div>
    <div id="nav">
        <a href="index.html">Home</a><br>
        <a href="form.html">Enrollment form</a><br>
        <a href="index.html">Contact us</a><br>
		 <a href="report.php">Report</a><br>
    </div>
	<div id="section">
<?php

    $address = $_POST['address']." ".$_POST['address1'];

    $parent_fname      = $_POST['fname'];
    $parent_mname      = $_POST['mname'];
    $parent_lname      = $_POST['lname'];
    $parent_address    = $_POST['address'];
    $parent_address1   = $_POST['address1'];
    $parent_hphone     = $_POST['home_area_phone'].$_POST['home_prefix_phone'].$_POST['home_phone'];
    $parent_cphone     = $_POST['cell_area_phone'].$_POST['cell_prefix_phone'].$_POST['cell_phone'];
    $parent_city       = $_POST['city'];
    $parent_state      = $_POST['state'];
    $parent_zip        = $_POST['zip'];
    $parent_email      = $_POST['email'];
	$parent_relation   = $_POST['relation'];


	$child_relation   = $_POST['relation'];
    $child_fname      = $_POST['cfname'];
    $child_lname      = $_POST['clname'];
    $child_mname      = $_POST['cmname'];
    $child_bday       = $_POST['bday'];
    $child_gender     = $_POST['gender'];
    $child_ifile      = $_POST['cfname']."_".$_FILES['fileUpload']['name'];
    $child_nickname   = $_POST['goesby'];
    $child_conditions = $_POST['conditions'];
    $child_diet       = $_POST['diet'];
    $child_emname     = $_POST['emeContactname'];
    $child_emphone    = $_POST['area_phone'].$_POST['prefix_phone'].$_POST['phone'];

    $programs         = $_POST['program'];
	$program          = "";
	for($i=0; $i< count($programs); $i++) {
		$program = $program.$programs[$i]." ";
	}

echo <<<ENDBLOCK
     <div id="confirm">
    <h1>$child_fname, thank you for registering.</h1>
    <table border="1" cellpadding="5" cellspacing="5">
	    <tr>
            <th colspan="2">Enrollment Information</th>
		</tr>
	    <tr>
            <td>Program(s)</td>
            <td>$program</td>
        </tr>
	    <tr>
            <th colspan="2">Parent Information</th>
		</tr>
		<tr>
            <td>Name</td>
            <td>$parent_fname $parent_mname $parent_lname</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>$parent_address $parent_address1</td>
        </tr>
        <tr>
            <td>City</td>
            <td>$parent_city</td>
        </tr>
        <tr>
            <td>State</td>
            <td>$parent_state</td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td>$parent_zip</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>$parent_email</td>
        </tr>
		<tr>
            <td>Home Phone</td>
            <td>$parent_hphone</td>
        </tr>
		<tr>
            <td>Cell Phone</td>
            <td>$parent_cphone</td>
        </tr>
	    <tr>
            <td>Parent Relation</td>
            <td>$parent_relation</td>
        </tr>
        <tr>
            <th colspan="2">Child Information</th>
		</tr>
		<tr>
            <td>Child Name</td>
            <td>$child_fname $child_mname $child_lname</td>
        </tr>
		<tr>
            <td>Child Nickname</td>
            <td>$child_nickname</td>
        </tr>
		<tr>
            <td>Child Relation</td>
            <td>$child_relation</td>
        </tr>
		<tr>
            <td>Child Gender</td>
            <td>$child_gender</td>
        </tr>
		<tr>
            <td>Child Birthday</td>
            <td>$child_bday</td>
        </tr>
		<tr>
            <td>Medical Conditions </td>
            <td>$child_conditions</td>
        </tr>
		<tr>
            <td>Special Diatary Requirements</td>
            <td>$child_diet</td>
        </tr>
		<tr>
            <td>Emergency Contact Name</td>
            <td>$child_emname</td>
        </tr>
		<tr>
            <td>Emergency Contact Number</td>
            <td>$child_emphone</td>
        </tr>

    </table>
    </div>
ENDBLOCK;
?>
</div>
</div>
</body></html>