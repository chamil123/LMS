<?php

if (!isset($_SESSION)) {
    session_start();
}
//error_reporting(E_ERROR || E_WARNING);
//require '../model/ApplicationModel.php';

$action = $_GET['action'];
$serchBoxBranch = $_POST['serchBoxBranch'];
$serchBoxCenter = $_POST['serchBoxCenter'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];


if (isset($_POST['searchissuedLoans'])) {
    if ($action == "search") {
        header("Location:../../LoanIssuedReport.php?serchBoxBranch=$serchBoxBranch&serchBoxCenter=$serchBoxCenter&from_date=$from_date&to_date=$to_date");
    }
}
if (isset($_POST['searchLoanOutstanding'])) {
    if ($action == "search") {

        header("Location:../../LoanOutstanding.php?serchBoxBranch=$serchBoxBranch&serchBoxCenter=$serchBoxCenter");
    }
}
if ($action == "excel") {
    $serchBoxBranch = $_GET['serchBoxBranch'];
    $serchBoxCenter = $_GET['serchBoxCenter'];
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    header("Location:../../LoanIssuedportINEXcel.php?serchBoxBranch=$serchBoxBranch&serchBoxCenter=$serchBoxCenter&from_date=$from_date&to_date=$to_date");
}
if ($action == "LoanOutstandingexcel") {
    $serchBoxBranch = $_GET['serchBoxBranch'];
    $serchBoxCenter = $_GET['serchBoxCenter'];

    header("Location:../../LoanOutstandingExcel.php?serchBoxBranch=$serchBoxBranch&serchBoxCenter=$serchBoxCenter");
}

?>