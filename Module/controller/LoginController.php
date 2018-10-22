<?php

if (!isset($_SESSION)) {
    session_start();
}
include '../../database/connection.php';
include '../model/LoginModel.php';
$login = new Login();


if (isset($_POST['branch_code'])) {

    if ($_POST['branch_code'] != "--- select branch-----") {
        $branch_code = $_POST['branch_code'];
        $result = $login->branchByCode($branch_code);
        $row = mysqli_fetch_assoc($result);
        $_SESSION["BRANCH_NAME"] = $row['branch_name'];
        $branch_id = $row['branch_id'];
    }
}

if ($_POST['Username'] != "" && $_POST['Password'] != "") {
    $r = $login->loginValidate($_POST['Username'], $_POST['Password']);

    $nor = $r->num_rows;
    if ($nor > 0) {
        $rows = mysqli_fetch_assoc($r);
        $_SESSION['userinfo'] = $rows;

        $user_id = $rows['user_id'];
        $permision = $login->getPermission($user_id);
        $_SESSION['user_id'] = $user_id;

        while ($rowp = mysqli_fetch_assoc($permision)) {
            $_SESSION['permission'] = $rowp['rights_name'];
        }
        
        $user_infomation = $login->getUserDetails($user_id);
         while ($rowu= mysqli_fetch_assoc($user_infomation)) {
            $_SESSION['role_id'] = $rowu['role_id'];
        }
    }
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $_SESSION["USER_NAME"] = $Username;
    $_SESSION["BRANCH_CODE"] = $branch_code;
    $_SESSION["BRANCH_ID"] = $branch_id;
    header("Location:../../Dashboard.php");
}
?>

