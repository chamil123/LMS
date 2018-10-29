<?php
error_reporting(E_ERROR || E_WARNING);
include './database/connection.php';
include './Module/model/CenterModel.php';
$auto=new Center();
global $con;

$q = $_GET['q'];
$my_data = mysqli_real_escape_string($con, $q);
$result=$auto->autocomplete($my_data);
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        echo $row[0]." ".$row[1]." ".$row[2]."\n";
    }
}
?>