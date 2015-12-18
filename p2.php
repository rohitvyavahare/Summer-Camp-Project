<?php

/**
 * @param $params
 */
function validate_data($params) {
    $msg = "";

    // parent section
    if(strlen($params['fname']) == 0 )
        $msg .= "Please enter the parent first name<br />";
    if(strlen($params['lname']) == 0 || !isset($params['lname']))
        $msg .= "Please enter the parent last name<br />";
    if(strlen($params['lname']) == 0 || !isset($params['lname']))
        $msg .= "Please enter the parent middle name<br />";
    if(strlen($params['address']) == 0 || !isset($params['address']))
        $msg .= "Please enter the address<br />";
    if(strlen($params['city']) == 0 || !isset($params['city']))
        $msg .= "Please enter the city<br />";
    if(strlen($params['state']) == 0 || !isset($params['state']))
        $msg .= "Please enter the state<br />";
    if(strlen($params['zip']) == 0 || !isset($params['zip']))
        $msg .= "Please enter the zip code<br />";
    elseif(!is_numeric($params['zip']) || !isset($params['fname']))
        $msg .= "Zip code may contain only numeric digits<br />";
    if(strlen($params['email']) == 0 || !isset($params['email']))
        $msg .= "Please enter email<br />";
    elseif(!filter_var($params['email'], FILTER_VALIDATE_EMAIL))
        $msg .= "Your email appears to be invalid<br/>";
    if( strlen($params['relation']) == 0 || !isset($params['relation']))
        $msg .= "Please select valid relationship to child<br />";
    if(strlen($params['home_area_phone'].$params['home_prefix_phone'].$params['home_phone']) == 0  )
        $msg .= "Please enter parent home phone<br />";
    elseif(!is_numeric($params['home_area_phone'].$params['home_prefix_phone'].$params['home_phone']))
        $msg .= "Parent home phone may contain only numeric digits<br />";
    if(strlen($params['cell_area_phone'].$params['cell_prefix_phone'].$params['cell_phone']) == 0 )
        $msg .= "Please enter parent cell phone<br />";
    elseif(!is_numeric($params['cell_area_phone'].$params['cell_prefix_phone'].$params['cell_phone']))
        $msg .= "Parent cell phone may contain only numeric digits<br />";

    // child section

    if(strlen($params['cfname']) == 0)
        $msg .= "Please enter the parent first name<br />";
    if(strlen($params['clname']) == 0)
        $msg .= "Please enter the parent last name<br />";
    if(strlen($params['cmname']) == 0)
        $msg .= "Please enter the parent middle name<br />";
    if(strlen($params['bday']) == 0 )
        $msg .= "Please enter the birthday<br />";
    elseif (!validate_birthday($params['bday']))
        $msg .= "Age should be in range of 7 to 12<br />";
    if( !isset($params['gender']))
        $msg .= "Please select valid gender<br />";
    if( !isset($_FILES['fileUpload']))
        $msg .= "Please upload Image file<br />";

    // Program section
    if(!isset($params['program']))
        $msg .= "Please select valid Program<br />";

    if($msg) {
        write_form_error_page($msg);
        exit;
    }
}

function validate_birthday($birth_date) {
    $age = calculate_age($birth_date);
    if ($age->y < 7 || $age->y > 12)
        return false;
    return true;
}


function write_form_error_page($msg) {
    write_header();
    echo "<h2>Sorry, an error occurred<br />",
    $msg,"</h2>";
    write_footer();
}

function process_parameters() {
    global $bad_chars;
    $_POST['fname']             = trim(str_replace($bad_chars, "",$_POST['fname']));
    $_POST['mname']             = trim(str_replace($bad_chars, "",$_POST['mname']));
    $_POST['lname']             = trim(str_replace($bad_chars, "",$_POST['lname']));
    $_POST['address']           = trim(str_replace($bad_chars, "",$_POST['address']));
    $_POST['address1']          = trim(str_replace($bad_chars, "",$_POST['address1']));
    $_POST['home_area_phone']   = trim(str_replace($bad_chars, "",$_POST['home_area_phone']));
    $_POST['home_prefix_phone'] = trim(str_replace($bad_chars, "",$_POST['home_prefix_phone']));
    $_POST['home_phone']        = trim(str_replace($bad_chars, "",$_POST['home_phone']));
    $_POST['cell_area_phone']   = trim(str_replace($bad_chars, "",$_POST['cell_area_phone']));
    $_POST['cell_prefix_phone'] = trim(str_replace($bad_chars, "",$_POST['cell_prefix_phone']));
    $_POST['cell_phone']        = trim(str_replace($bad_chars, "",$_POST['cell_phone']));
    $_POST['city']              = trim(str_replace($bad_chars, "",$_POST['city']));
    $_POST['state']             = trim(str_replace($bad_chars, "",$_POST['state']));
    $_POST['zip']               = trim(str_replace($bad_chars, "",$_POST['zip']));
    $_POST['email']             = trim(str_replace($bad_chars, "",$_POST['email']));
    return $params;
}

function store_data_in_db() {

    ### NOT A DUP
    process_parameters();
    validate_data($_POST);
    $db                = get_db_handle();

    $params = $_POST;
    // insert parent info

    $parent_fname      = $params['fname'];
    $parent_mname      = $params['mname'];
    $parent_lname      = $params['lname'];
    $parent_address    = $params['address'];
    $parent_address1   = $params['address1'];
    $parent_hphone     = $params['home_area_phone'].$params['home_prefix_phone'].$params['home_phone'];
    $parent_cphone     = $params['cell_area_phone'].$params['cell_prefix_phone'].$params['cell_phone'];
    $parent_city       = $params['city'];
    $parent_state      = $params['state'];
    $parent_zip        = $params['zip'];
    $parent_email      = $params['email'];

    $sql = "INSERT INTO parent (first_name, middle_name, last_name, address1, address2, city, state, zip, primary_phone, secondary_phone, email)".
        "VALUES('$parent_fname','$parent_mname','$parent_lname','$parent_address','$parent_address1','$parent_city', '$parent_state','$parent_zip', '$parent_hphone', '$parent_cphone', '$parent_email' );";
    mysqli_query($db,$sql);
    $how_many = mysqli_affected_rows($db);
    if($how_many == 1) ;
    else {
		$msg = "A critical error occurred  in parent insertion. <br />";
                write_form_error_page($msg);
                exit;
	}

    //echo $sql;
    // insert child info

    $parent_id    = 0;
    $parent_phone = $params['home_area_phone'].$params['home_prefix_phone'].$params['home_phone'];
    $sql          = "SELECT id from `parent` where primary_phone='$parent_phone';";
    $result       = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) >0) {
        $row       = mysqli_fetch_array($result);
        $parent_id = $row[0];
    }

    $child_relation   = $params['relation'];
    $child_fname      = $params['cfname'];
    $child_lname      = $params['clname'];
    $child_mname      = $params['cmname'];
    $child_bday       = $params['bday'];
    $child_gender     = $params['gender'][0];
    $child_ifile      = $params['cfname']."_".$_FILES['fileUpload']['name'];
    $child_nickname   = $params['goesby'];
    $child_conditions = $params['conditions'];
    $child_diet       = $params['diet'];
    $child_emname     = $params['emeContactname'];
    $child_emphone    = $params['area_phone'].$params['prefix_phone'].$params['phone'];

    $sql = "INSERT INTO child(parent_id, relation, first_name, middle_name, last_name, nickname, image_filename, gender, birthdate, conditions, diet, emergency_name, emergency_phone) ".
           "VALUES ('$parent_id','$child_relation','$child_fname','$child_mname','$child_lname','$child_nickname','$child_ifile','$child_gender',STR_TO_DATE('$child_bday','%d/%m/%Y'),'$child_conditions','$child_diet','$child_emname','$child_emphone');";

    mysqli_query($db,$sql);
    $how_many = mysqli_affected_rows($db);
	if($how_many == 1) ;
    else {
		$msg = "A critical error occurred  in child insertion. <br />";
                write_form_error_page($msg);
                exit;
	}
    // echo $sql;
    // insert enrollment

    $child_id     = 0;
    $sql          = "SELECT id from `child` where parent_id = '$parent_id' and first_name = '$child_fname'";
    $result       = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0) {
        $row       = mysqli_fetch_array($result);
        $child_id = $row[0];
    }
    $enrollment = 0;
    $program=$_POST['program'];
    for($i = 0; $i < count($program); $i++) {
		$program_id = get_program_id($program[$i]);
        $sql = "INSERT INTO `enrollment`(`program_id`, `child_id`) VALUES ($program_id, $child_id);";
        mysqli_query($db,$sql);
        $how_many = mysqli_affected_rows($db);
//		echo $sql;
		if($how_many == 1) ;
        else {
		    $msg = "A critical error occurred  in enrollment insertion.";
                    write_form_error_page($msg);
                    exit;
	    }
    }
    mysqli_close($db);
}



function is_dup_record($params) {
    $db           = get_db_handle();
    $parent_id    = 0;
    $parent_phone = $params['home_area_phone'].$params['home_prefix_phone'].$params['home_phone'];
    $sql          = "SELECT id from parent where primary_phone='$parent_phone';";
    $result       = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) >0) {
        $row = mysqli_fetch_array($result);
        $parent_id = $row[0];
    }

    $child_id  = 0;
    $cname     = $params['cfname'];
    $sql       = "SELECT id from child where parent_id=$parent_id and first_name='$cname';";
    $result    = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) >0) {
        $row = mysqli_fetch_array($result);
        $child_id = $row[0];
    }

    $enrollment = 0;
    $program    = $_POST['program'];
    for($i = 0; $i < count($program); $i++) {
        $sql = "SELECT * from enrollment where program_id=".($i+1)." and child_id=$child_id;";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) >0) {
            $row = mysqli_fetch_array($result);
            $enrollment = 1;
        }
    }

    if($parent_id && $child_id && $enrollment)
        return true;
    return false;
}


?>
