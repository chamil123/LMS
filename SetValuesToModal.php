<?php
$application_id = $_GET['application_id'];
require_once './database/connection.php';

global $con;
$sql = "SELECT * from member INNER JOIN application ON member.member_id=application.member_id WHERE application_status='Active' AND application.application_id=$application_id ";
$result = mysqli_query($con, $sql);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
//echo mysqli_errno($db);
echo json_encode($array_curency);


//var_dump($row);
?>


