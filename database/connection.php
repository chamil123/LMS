<?php

static $con;
$db_host ="127.0.0.1";
$db_name="LMS";
$db_user="root";
$db_password="";
//$db_name="idex_lms";
//$db_user="idex_chamiljay99";
//$db_password="amerck@2015";
$db_port="3306";

$con = new mysqli($db_host, $db_user, $db_password,$db_name, $db_port);
if ($con->connect_error) {
    echo 'Failed';
    die();
}
?>
