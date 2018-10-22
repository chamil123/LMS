<?php
include './database/connection.php';
global $con;
$sql = "SELECT DISTINCT member_AddressLine2 FROM member";
$result = mysqli_query($con, $sql);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);


?>