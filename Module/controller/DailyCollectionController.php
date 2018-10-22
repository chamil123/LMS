<?php

if (!isset($_SESSION)) {
    session_start();
}
$date = date("Y-m-d");
error_reporting(E_ERROR || E_WARNING);
require '../model/../model/DailyCollectionModel.php';
$dailyCollection = new DailyCollection();

if (isset($_POST['dailyCollection'])) {
    $rowcount = $_POST['rowcount'];
    for ($i = 0; $i < $rowcount; $i++) {
        $app_id = $_POST["app_id$i"];
        $pay = $_POST["pay$i"];
        $m_id = $_POST["m_id$i"];
        //echo 'dddddddddd : ' . $app_id . " <br/>" . $pay . "<br/> " . $m_id;
        $dailyCollection->addCollection($date, $pay, $app_id, $m_id);
    }
    header("Location:../../DailyCollection.php");
}
if (isset($_POST['searchPayment'])) {
    $searchType = $_POST['serchCombo'];
    $serchBox = $_POST['serchBox'];
//    $dailyCollection->serchByCenter($serchBox);
//    echo 'adasdasdasd : ' . $searchType . "  " . $serchBox;
    header("Location:../../DailyCollection.php?searhValue=$serchBox&searchCombo=$searchType");
}


//$date = date("Y-m-d");
//error_reporting(E_ERROR || E_WARNING);
//require '../model/../model/DailyCollectionModel.php';
//$dailyCollection = new DailyCollection();
//
//if (isset($_POST['AddPayment'])) {
//    $m_id = $_POST['m_id'];
//    $m_number = $_POST['m_number'];
//    $m_surname = $_POST['m_surname'];
//    $m_weeklyDue = $_POST['m_weeklyDue'];
//    $payAnount = $_POST['payAnount'];
//    $application_id = $_POST['application_id'];
//    
//    
//    $dailyCollection->addCollection($date, $m_weeklyDue, $payAnount, $application_id,$m_id);
//}
?>