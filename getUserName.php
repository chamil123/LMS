<?php

//echo 'sdsdsdasdasdasd';
error_reporting(E_ERROR | E_WARNING);
$key = $_GET['uname'];
include 'database/connection.php';


$con = $GLOBALS['con'];
$sql = "SELECT login_userName FROM login WHERE login_userName='$key'";
$Query = mysqli_query($con, $sql);



$no = $Query->num_rows;

if ($no == 0) {
    echo "<i class='alert-success'>Availbale User Name</i>";
} else {
    echo "<i class='alert-danger'>Existing User Name</i>";
}
?>
