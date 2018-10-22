<?php
include './database/connection.php';
global $con;
$sql = "SELECT DISTINCT  member_AddressLine1,member_AddressLine2,member_AddressLine3,member_AddressLine4 FROM member";
$result = mysqli_query($con, $sql);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);


?>