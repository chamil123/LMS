<?php
$branch_code = $_GET['branch_code'];
include './database/connection.php';
global $con;
if ($branch_code != "") {
    $sql = "SELECT * FROM center WHERE branch_id=$branch_code";
} else {
    $sql = "SELECT * FROM center";
}
$result = mysqli_query($con, $sql);


//$result = $database->query($sql);


$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);
?>
