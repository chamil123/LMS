<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of getAllCustomerforAjax
 *
 * @author Chamil
 */

include './database/connection.php';
global $con;
$sql = "SELECT * FROM city";
$result = mysqli_query($con, $sql);

//$result = $database->query($sql);


$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
echo json_encode($array_curency);


?>
