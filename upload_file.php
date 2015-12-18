<?php

	$UPLOAD_DIR         = '/home/jadrn056/public_html/proj3/Images/';
    $COMPUTER_DIR       = '/home/jadrn056/public_html/proj3/Images/';
	$formated_file_name = str_replace(" ","_",$_FILES['fileUpload']['name']);
    $fname              = $_POST['cfname']."_".$formated_file_name;


    if(file_exists("$UPLOAD_DIR".$fname))  {
        echo "<b>Error, the file $fname already exists on the server</b><br />\n";
		return ;
        }
    elseif($_FILES['fileUpload']['error'] > 0) {
    	$err = $_FILES['fileUpload']['error'];
        echo "Error Code: $err ";
	    if($err == 1)
		    echo "The file was too big to upload, the limit is 2MB<br />";
		return;
    }
    else {
        move_uploaded_file($_FILES['fileUpload']['tmp_name'], "$UPLOAD_DIR".$fname);
        echo "File Uploaded Successfully ";
    }
?>
