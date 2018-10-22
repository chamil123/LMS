<?php

if (!isset($_SESSION)) {
    session_start();
}

error_reporting(E_ERROR || E_WARNING);
$action = $_GET['action'];

if ($action == "add") {
//    if (isset($_POST['searchArrears'])) {
        $searchType = $_POST['serchCombo'];
        $serchBoxBranch = $_POST['serchBoxBranch'];
        $serchBoxCenter = $_POST['serchBoxCenter'];
//    $dailyCollection->serchByCenter($serchBox);
//    echo 'adasdasdasd : ' . $searchType . "  " . $serchBox;
        header("Location:../../ArreasReport.php?serchBoxBranch=$serchBoxBranch&serchBoxCenter=$serchBoxCenter&searchCombo=$searchType");
//    }
}
if ($action == "excel") {
//    header("Location:../../ArreasReport.php?serchBoxBranch=$serchBoxBranch&serchBoxCenter=$serchBoxCenter&searchCombo=$searchType");
    $serchBoxBranch = $_GET['serchBoxBranch'];
    $serchBoxCenter = $_GET['serchBoxCenter'];
    $searchCombo = $_GET['searchCombo'];
//    header("Location:../../ArrearsreportINEXcel.php");
    header("Location:../../ArrearsreportINEXcel.php?serchBoxBranch=$serchBoxBranch&serchBoxCenter=$serchBoxCenter&searchCombo=$searchCombo");

}
?>
