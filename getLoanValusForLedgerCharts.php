<?php

include './database/connection.php';
$member_id = $_GET['member_id'];
global $con;
if ($member_id != null) {
    $sql="SELECT application.application_id,application.application_lamount,application.application_date,application.member_id,SUM(dailycollection.dailycollection_amount_paid) AS amt  FROM application LEFT JOIN dailycollection ON dailycollection.application_id=application.application_id WHERE application.member_id=$member_id GROUP BY application.application_id";
//    $sql = "SELECT application.application_id,application.application_lamount,application.application_date,application.member_id,SUM(dailycollection.dailycollection_amount_paid) AS amt FROM dailycollection INNER JOIN application ON dailycollection.application_id=application.application_id  WHERE dailycollection.member_id=$member_id GROUP BY application.application_id";
}

$result = mysqli_query($con, $sql);
$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);
?>