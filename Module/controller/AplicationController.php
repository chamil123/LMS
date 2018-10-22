<?php

if (!isset($_SESSION)) {
    session_start();
}
//error_reporting(E_ERROR || E_WARNING);
require '../model/ApplicationModel.php';
include '../model/ChragesModel.php';
$application = new Application();
$charges = new Charges();

$action = $_GET['action'];

if (isset($_POST['AddApplication'])) {
    $num = $_POST['rowcountss'];
    if ($action == "add") {
        $member_id = $_POST['member_id'];
        $aplication_lamount = $_POST['aplication_lamount'];
        $aplication_lperiod = $_POST['aplication_lperiod'];
        $aplication_months = $_POST['aplication_months'];
        $aplication_lamountWithInt = $_POST['aplication_lamountWithInt'];
        $aplication_irate = $_POST['aplication_irate'];
        $aplication_ldue = $_POST['aplication_ldue'];
        $aplication_lterm = $_POST['aplication_lterm'];
        $aplication_rentalf = $_POST['aplication_rentalf'];
        $aplication_intCal = $_POST['aplication_intCal'];

        $lastApplicationId = $application->addApplication($member_id, $aplication_lamount, $aplication_lperiod, $aplication_months, $aplication_lamountWithInt, $aplication_irate, $aplication_ldue, $aplication_lterm, $aplication_rentalf, $aplication_intCal);

        for ($i = 0; $i < $num; $i++) {
            if ($_POST["check_$i"] == "on") {
                $name = $_POST["name_$i"];
                $address = $_POST["address_$i"];
                $contactNum = $_POST["contactNum_$i"];
                $memberId = $_POST["memberID_$i"];
                $check = $_POST["check_$i"];

                echo 'ssfddasd ;' . $name . " / " . $address . " " . $check . "<br/>";
                $application->OtherGuranters($lastApplicationId, $memberId);
            }
        }
        if ($lastApplicationId > 0) {
            $_SESSION['msgap'] = 1;
        }
        header("Location:../../CreateApplication.php");
    }
}if (isset($_POST['UpdateAddApplication'])) {
    $num = $_POST['rowcountss'];
    if ($action == "Update") {

        $application_id = $_POST['application_id'];
        $member_id = $_POST['member_id'];

        $aplication_lamount = $_POST['aplication_lamount'];
        $aplication_lperiod = $_POST['aplication_lperiod'];
        $aplication_months = $_POST['aplication_months'];
        $aplication_lamountWithInt = $_POST['aplication_lamountWithInt'];
        $aplication_irate = $_POST['aplication_irate'];
        $aplication_ldue = $_POST['aplication_ldue'];
        $aplication_lterm = $_POST['aplication_lterm'];
        $aplication_rentalf = $_POST['aplication_rentalf'];
        $aplication_intCal = $_POST['aplication_intCal'];

        $result = $application->updateApplication($member_id, $aplication_lamount, $aplication_lperiod, $aplication_months, $aplication_lamountWithInt, $aplication_irate, $aplication_ldue, $aplication_lterm, $aplication_rentalf, $aplication_intCal, $application_id);

        $application->DeleteApplication($application_id);
        for ($i = 0; $i < $num; $i++) {
            if ($_POST["check_$i"] == "on") {
                $name = $_POST["name_$i"];
                $address = $_POST["address_$i"];
                $contactNum = $_POST["contactNum_$i"];
                $memberId = $_POST["memberID_$i"];
                $check = $_POST["check_$i"];

                echo 'ssfddasd  update ;' . $name . " / " . $address . " " . $check . "<br/>";
                $application->OtherGuranters($application_id, $memberId);
            }
            // mysqli_query($con, "INSERT INTO `com`(`name`, `add`, contact) Values('$name', '$address', '$contactNum')");
        }
        if ($result > 0) {
            $_SESSION['msgapu'] = 3;
        }
        header("Location:../../ViewApplication.php");
    }
}if ($action == "active") {
    $application_id = $_GET['application_id'];
    $member_id = $_GET['member_id'];
    $resultPrevious = $application->checkPreviousNotClosedLoans($application_id);
    $resultLoanTerm = $application->checkLoanTerm($member_id);

    $row = mysqli_fetch_assoc($resultLoanTerm);
    $num_rows = $row['num_comments'];

    if (mysqli_num_rows($resultPrevious) > 0) {

        header("Location:../../CheckPreviousLoanBeforeActive.php?application_id=$application_id");
    } else {
//        if ($num_rows > 1) {
//            $result = $application->activeStatus($application_id);
//            header("Location:../../ViewApplication.php");
//        } else {
//            header("Location:../../AddCharges.php?application_id=$application_id");
//        }
        /////////////updated .................>>>>>>>>>>>>>>>>>>>////////////////////////////
        header("Location:../../AddCharges.php?application_id=$application_id");
    }
}if ($action == "charges") {
    $application_id = $_POST['application_id'];
    $document_charges = $_POST['document_charges'];
    $security_service = $_POST['security_service'];

    if ($_POST['member_fee'] != null) {
        $member_fee = $_POST['member_fee'];
    } else {
        $member_fee = 0;
    }
    $charges->addCharges($application_id, $document_charges, $member_fee, $security_service);
   
    $result = $application->activeStatus($application_id);
    header("Location:../../ViewApplication.php");

//    $resultPrevious = $application->checkPreviousNotClosedLoans($application_id);
}
if ($action == "pending") {
    $application_id = $_GET['application_id'];
    $result = $application->pendingStatus($application_id);
    if ($result > 0) {
        $_SESSION['msga'] = 3;
    }
    header("Location:../../ViewApplication.php");
}if ($action == "close") {
    $application_id = $_GET['application_id'];
    $result = $application->closeAplication($application_id);
    if ($result > 0) {
        $_SESSION['msga'] = 2;
    }
    header("Location:../../ViewApplication.php");
}if ($action == "delete") {
    $application_id = $_GET['application_id'];
    $result = $application->deleteAplication($application_id);
    if ($result > 0) {
        $_SESSION['msgapu'] = 2;
    }
    header("Location:../../ViewApplication.php");
}
?>

