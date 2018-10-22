<?php

if (!isset($_SESSION)) {
    session_start();
}
require '../model/CenterModel.php';
$center = new Center();

$action = $_GET['action'];
if (isset($_POST['Adds'])) {

    if ($action == "add") {
        $center_branch = $_POST['center_branch'];
        $center_number = $_POST['center_number'];
        $center_name = $_POST['center_name'];
        $center_day = $_POST['center_day'];
        $user_id = $_POST['user_id'];
//             echo $center_branch."<br/>".$center_number.'<br/>'.$center_name."<br/>".$center_day."<br/>".$user_id;
        $result = $center->addCenter($center_branch, $center_number, $center_name, $center_day, $user_id);

        if ($result > 0) {
            $_SESSION['msgc'] = 1;
        }
        header("Location:../../CreateCenter.php");
    }
    if ($action == "update") {
        $center_id = $_POST['center_id'];
        $center_branch = $_POST['center_branch'];
        $center_number = $_POST['center_number'];
        $center_name = $_POST['center_name'];
        $center_day = $_POST['center_day'];
        $user_id = $_POST['user_id'];
        $result = $center->UpdateCenter($center_id, $center_branch, $center_number, $center_name, $center_day,$user_id);

        if ($result > 0) {
            $_SESSION['msgc'] = 3;
        }
        header("Location:../../ViewCenters.php");
    }
}
if ($action == "delete") {

    $center_id = $_GET['center_id'];
    echo ''.$center_id;
    $result = $center->deleteCenter($center_id);

    if ($result > 0) {
        $_SESSION['msgc'] = 2;
    }
    header("Location:../../ViewCenters.php");
}
?>
