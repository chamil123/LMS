<?php

session_start();
require '../model/StudentModel.php';

$StundetModel=new StudentModel();

if (isset($_POST["st_data_packet"])) {

    $st_name = $_POST['st_name'];
    $st_email = $_POST['st_email'];
    $st_contact = $_POST['st_contact'];
    $st_parent_contact = $_POST['st_parent_contact'];
    $st_parent_name = $_POST['st_parent_name'];
    $st_username = $_POST['st_username'];
    $st_password = $_POST['st_password'];
    $st_confirm_password = $_POST['st_confirm_password'];
    
    $StundetModel->createAccount($st_name,$st_email,$st_contact,$st_parent_contact,$st_parent_name,$st_username,$st_password,$st_confirm_password);
}
if (isset($_POST["st_login_packet"])) {

    $st_username = $_POST['st_username'];
    $st_password = $_POST['st_password'];
    
    $StundetModel->StudentLogin($st_username, $st_password);
}
if (isset($_POST["UpdateStudent"])) {

    $st_id = $_SESSION['loggedUser'];
    $st_name = $_POST['st_name'];
    $st_email = $_POST['st_email'];
    $st_contact = $_POST['st_contact'];
    $st_parent_contact = $_POST['st_parent_contact'];
    $st_parent_name = $_POST['st_parent_name'];
      
    $StundetModel->updateStudentDetails($st_id,$st_name,$st_email,$st_contact,$st_parent_contact,$st_parent_name);
}
if (isset($_POST["UpdateStudentLogin"])) {

    $st_id = $_SESSION['loggedUser'];
    $st_username = $_POST['st_username'];
    $st_password = $_POST['st_password'];
    
    $StundetModel->updateUserDetails($st_id,$st_username,$st_password);
}
if(isset($_GET['uid']) && isset($_GET['status'])){
    $uid = $_GET['uid'];
    $status=$_GET['status'];
  
    $StundetModel->changeUserStatus($uid,$status);
}
?>