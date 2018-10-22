<?php

if (!isset($_SESSION)) {
    session_start();
}
//error_reporting(E_ERROR || E_WARNING);
require '../model/ApplicationModel.php';
$application = new Application();

$action = $_GET['action'];
if ($action == "search") {
    $member_nic=$_POST['member_nic'];
     header("Location:../../ContractInquiry.php?member_nic=$member_nic");
    
}
?>
