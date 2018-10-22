<?php

//echo 'sdsdsdasdasdasd';
error_reporting(E_ERROR | E_WARNING);
$key = $_GET['c_name'];
$brnch_id = $_GET['branch_id'];

include 'database/connection.php';


$con = $GLOBALS['con'];
$sql = "SELECT 
            tc.center_name
        FROM
            center tc
        WHERE
            tc.center_name = '$key' AND tc.branch_id=$brnch_id";
$Query = mysqli_query($con, $sql);



$no = $Query->num_rows;

if ($no == 0) {
    echo "<i class='alert-success'>Availbale Center Name</i>";
} else {
    echo "<i class='alert-danger'>Existing Center Name</i>";
}
?>
