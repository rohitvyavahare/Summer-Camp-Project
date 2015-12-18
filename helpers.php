<?php

$bad_chars = array('$','%','?','<','>','php');

function check_post_only() {
    if(!$_POST) {
        write_error_page("This scripts can only be called from a form.");
        exit;
    }
}

function get_db_handle() {
    $server   = 'opatija.sdsu.edu:3306';
    $user     = 'jadrn056';
    $password = 'froth';
    $database = 'jadrn056';

    if(!($db = mysqli_connect($server, $user, $password, $database))) {
        write_error_page("Cannot Connect!");
    }
    return $db;
}

function insert_programs($db) {

    $values = array(
        1 => 'Basketball Camp',
        2 => 'Baseball Camp',
        3 => 'Physical Training',
        4 => 'Band Camp',
        5 => 'Swimming',
        6 => 'Nature Discovery');


    foreach($values as $k => $v) {
        $sql = "INSERT INTO program VALUES($k,'$v');\n";

#        echo "The sql statement is:\n$sql\n";

        if(!($result = mysqli_query($db, $sql))) {
            die('SQL ERROR: '. mysqli_error($db));
        } #end if
    } #end foreach

    mysqli_close($db); #don't forget to close the DB!
}

function calculate_age($birth_date){
	$dob = new DateTime($birth_date);
    $now = new DateTime();
    $age = $now->diff($dob);
	return $age;
}

function get_program_id($param) {

	$program['Basketball Camp']   = 1;
	$program['Baseball Camp']     = 2;
	$program['Physical Training'] = 3;
	$program['Band Camp']         = 4;
	$program['Swimming']          = 5;
	$program['Nature Discovery']  = 6;
	return $program[$param];
}

function get_id_from_program($param) {

	$program[1]  = "Basketball Camp";
	$program[2]  = "Baseball Camp";
	$program[3]  = "Physical Training";
	$program[4]  = "Band Camp";
	$program[5]  = "Swimming";
	$program[6]  = "Nature Discovery";
	return $program[$param];
}

function write_error_page($msg) {
    write_header();
    echo "<h2>Sorry, an error occurred<br />",
    $msg,"</h2>";
    write_footer();
}

function write_header() {
    print <<<ENDBLOCK
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;
    charset=iso-8859-1" />
    <title>Form Processing</title>

</head>
<body>
ENDBLOCK;
}

function write_footer() {
    echo "</body></html>";
}

?>
