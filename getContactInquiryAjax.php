<?php
include './database/connection.php';
$member_id=$_GET['member_id'];
global $con;
$sql = "SELECT * FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN address ON member.address_id=address.address_id  INNER JOIN city ON address.city_id=city.city_id WHERE application.member_id=$member_id AND application.application_status='active'";
$result = mysqli_query($con, $sql);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);
?>