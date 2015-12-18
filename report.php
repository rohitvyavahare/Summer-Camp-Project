
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Happy Days Summer Camp</title>
    <link rel="stylesheet" type="text/css" href="form.css" />
    <script type="text/javascript" src="http://jadran.sdsu.edu/jquery/jquery.js"></script>
    <script type="text/javascript" src="form.js"></script>
	<script type="text/javascript" src="ajax_form.js"></script>
	<link rel="shortcut icon" type="image/png" href="Images/icon.png"/>
</head>

<body>
<div id="header">
    <h1>Enrollment Report </h1>
</div>
<div>
    <div id="nav">
        <a href="index.html">Home</a><br>
        <a href="form.html">Enrollment form</a><br>
        <a href="index.html"> Contact us</a><br>
        <a href="report.php"> Report</a><br>
    </div>
	<div id="section">
<?php


include("helpers.php");
$UPLOAD_DIR   = 'Images/';
$db           = get_db_handle();

echo <<<ABC
   <div id="confirm">
        <table border="1" cellpadding="5" cellspacing="5">
ABC;
for ($i = 1; $i < 7; $i++) {
    $sql     = "SELECT c.first_name, c.last_name, c.nickname, c.image_filename,c.birthdate, p.first_name AS 'pfname', p.last_name AS 'plname', p.primary_phone, c.emergency_name, c.emergency_phone FROM child AS c JOIN parent AS p ON c.parent_id = p.id JOIN enrollment AS e ON c.id = e.child_id WHERE e.program_id = $i";
    $result      = mysqli_query($db,$sql);
    $program     = get_id_from_program($i);
 echo <<<XYZ
            <tr>
                <th colspan="3">$program </th>
            </tr>
XYZ;
    while ($row = mysqli_fetch_array($result)) {

        $imagefilePath    = str_replace(" ","_",$UPLOAD_DIR.$row['image_filename']);
        $child_name       = $row['first_name']." ".$row['last_name'];
        $nick_name        = $row['nickname'];
        $parent_name      = $row['pfname']." ".$row['plname'];
        $primary_phone    = $row['primary_phone'];
        $emergency_phone  = $row['emergency_phone'];
        $emergency_name   = $row['emergency_name'];
	$bday             = $row['birthdate'];
        $age              = calculate_age($bday)->format('%y years');
        echo <<<ENDBLOCK
    		<tr>
    		    <td rowspan ="8"> <img id="uploadImg" src=$imagefilePath>
    		</tr>
    		<tr>
                <td>Child Name </td>
                <td>$child_name </td>
            </tr>
    		<tr>
                <td>Child NickName </td>
                <td>$nick_name </td>
            </tr>
			<tr>
                <td>Child Age </td>
                <td>$age </td>
            </tr>
    		<tr>
                <td>Child's Parent Name </td>
                <td>$parent_name </td>
            </tr>
    		<tr>
                <td>Child's Parent Contact Number </td>
                <td>$primary_phone  </td>
            </tr>
    		<tr>
                <td>Child's Emergency Contact Number </td>
                <td>$emergency_name  </td>
            </tr>
    		<tr>
                <td>Child's Emergency Contact Number </td>
                <td>$emergency_phone  </td>
            </tr>
            <tr colspan="3">
            </tr>
         
ENDBLOCK;
    }
}
echo "</table>";
?>

</div>
</div>
</body></html>
