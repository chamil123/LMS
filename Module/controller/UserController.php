<?php

if (!isset($_SESSION)) {
    session_start();
}
//error_reporting(E_ERROR || E_WARNING);
require '../model/UserModel.php';
$user = new User();

$action = $_GET['action'];

if ($action == "add") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $gender = $_POST['gender'];
    $uname = $_POST['uname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $rol_id = $_POST['rol_id'];
    $address = $_POST['address'];

    $user_rights = $_POST['user_rights'];

    $folder = "../../uploads/";
    $file = $folder . basename($_FILES["user_image"]["name"]);
    $sourseFile = $_FILES["user_image"]["tmp_name"];
    if (file_exists($file)) {
        $file = $folder . date("ydmhis") . basename($_FILES["user_image"]["name"]);
    }
    if (move_uploaded_file($sourseFile, $file)) {
        echo 'upload successfull';
    } else {
        echo 'error uploading';
        $file = "../../images/blank_user_icon.png";
    }

    $lastUserId = $user->addUser($fname, $lname, $dob, $nic, $gender, $phone, $email, $rol_id, $address, $file);
    $pass = "123";
    $user->addLogin($uname, $pass, $lastUserId);

    foreach ($user_rights as $e) {
        $user->addRightsHasUser($e, $lastUserId);
    }


    if ($lastUserId > 0) {
        $_SESSION['msgU'] = 1;
    }
    header("Location:../../AddUser.php");
} if ($action == "update") {

    echo 'asdasdasd update';
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $nic = $_POST['nic'];
    $gender = $_POST['gender'];
    $uname = $_POST['uname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $rol_id = $_POST['rol_id'];
    $address = $_POST['address'];

    $user_rights = $_POST['user_rights'];

    $folder = "../../uploads/";
    $file = $folder . basename($_FILES["user_image"]["name"]);
    $sourseFile = $_FILES["user_image"]["tmp_name"];
    if (file_exists($file)) {
        $file = $folder . date("ydmhis") . basename($_FILES["user_image"]["name"]);
    }
    if (move_uploaded_file($sourseFile, $file)) {
        echo 'upload successfull';
    } else {
        echo 'error uploading';
        $file = "../../images/blank_user_icon.png";
    }

    $lastUserId = $user->UpdateUser($user_id, $fname, $lname, $dob, $nic, $gender, $phone, $email, $rol_id, $address, $file);
    $pass = sha1("123");
    $user->UpdateLogin($uname, $pass, $user_id);

    $user->DeleteRightsHasUser($user_id);
    foreach ($user_rights as $e) {
        $user->UpdateRightsHasUser($e, $user_id);
    }


    if ($lastUserId > 0) {
        $_SESSION['msgd'] = 3;
    }
    header("Location:../../ViewUsers.php");
}
//}
if ($action == "delete") {

    $userid = $_GET['user_id'];
    
    
    $lastUserId = $user->DeleteUser($userid);
    if ($lastUserId > 0) {
        $_SESSION['msgd'] = 2;
    }
    header("Location:../../ViewUsers.php");
}
?>