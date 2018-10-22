<?php

if (!isset($_SESSION)) {
    session_start();
}
$action = $_GET['action'];
if ($action == "Ledgersearch") {
    echo 'dfsdfsdfsdfsdfsfsdfsdf';

    $member_AnyNumber = $_POST['member_AnyNumber'];
    header("Location:../../LedgerReport.php?member_AnyNumber=$member_AnyNumber");
}
if ($action == "excel") {
    $applicatio_id = $_GET['application_id'];
    $member_AnyNumber = $_GET['member_AnyNumber'];

    header("Location:../../LedgerReportINEXcel.php?application_id=$applicatio_id");

}
?>

