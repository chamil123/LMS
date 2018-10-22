<?php

include './database/connection.php';
global $con;
$sql = "SELECT * from member INNER JOIN center ON member.member_id=center.center_id";
$result = mysqli_query($con, $sql);

//$result = $database->query($sql);


$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);
?>
