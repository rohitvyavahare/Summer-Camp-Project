<?php
    include ( 'helpers.php' );
	$db           = get_db_handle();
    $parent_id    = 0;
    $parent_phone = $_POST['home_area_phone'].$_POST['home_prefix_phone'].$_POST['home_phone'];
    $sql          = "SELECT id from parent where primary_phone='$parent_phone';";
    $result       = mysqli_query($db,$sql);
	echo $sql;
    if(mysqli_num_rows($result) >0) {
        $row = mysqli_fetch_array($result);
        $parent_id = $row[0];
    }

    $child_id  = 0;
    $cname     = $_POST['cfname'];
    $sql       = "SELECT id from child where parent_id=$parent_id and first_name='$cname';";
    $result    = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) >0) {
        $row = mysqli_fetch_array($result);
        $child_id = $row[0];
    }

	echo $sql;
    $enrollment = 0;
    $program    = $_POST['program'];

    for($i = 0; $i < count($program); $i++) {
        $sql = "SELECT * from enrollment where program_id=".($i+1)." and child_id=$child_id;";
        $result = mysqli_query($db,$sql);
	echo $sql;
        if(mysqli_num_rows($result) >0) {
            $row = mysqli_fetch_array($result);
            $enrollment = 1;
        }
    }
    if($parent_id && $child_id && $enrollment)
        echo "DUP";
    echo "OK";
?>
