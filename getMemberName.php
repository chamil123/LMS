<?php

//echo 'sdsdsdasdasdasd';
error_reporting(E_ERROR | E_WARNING);
$key = $_GET['uname'];
include 'database/connection.php';


$con = $GLOBALS['con'];
$sql = "SELECT member_number FROM member WHERE member_number='$key'";
$Query = mysqli_query($con, $sql);



$no = $Query->num_rows;

if ($no == 0) {
    echo "<i class='alert-success'>Availbale Member Number</i>";
} else {
    echo "<i class='alert-danger'>Existing Member Number</i>";
}
?>
