<?php
include './database/connection.php';

$member_id=$_GET['member_id'];
global $con;

$sql = "SELECT count(*) as num_comments FROM application WHERE member_id=$member_id";
$result = mysqli_query($con, $sql);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);
?>
