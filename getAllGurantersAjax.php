<?php
$groupNumber=$_GET['group_id'];
include './database/connection.php';
global $con;
$sql = "SELECT * FROM member WHERE member_group='$groupNumber'";
$result = mysqli_query($con, $sql);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);


?>
