<?php

//echo 'sdsdsdasdasdasd';
error_reporting(E_ERROR | E_WARNING);
$key = $_GET['guranter'];

include 'database/connection.php';


$con = $GLOBALS['con'];
 $sql = "SELECT 
            tg.guranter_NIC
        FROM
            guranter tg
        WHERE
            tg.guranter_NIC = '$key' AND tg.guranter_status=0";
$Query = mysqli_query($con, $sql);



$no = $Query->num_rows;

if ($no == 0) {
    echo "<i class='alert-success'>Availbale Guranter NIC number</i>";
} else {
    echo "<i class='alert-danger'>Existing Guranter NIC number</i>";
}
?>
