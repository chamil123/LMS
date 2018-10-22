<?php

include '../../database/connection.php';

class User {

    function addUser($fname, $lname, $dob, $nic, $gender, $phone, $email, $rol_id, $address, $file) {
        global $con;
        $sql = "INSERT into user (user_firstName,user_lastName,user_email,user_status,user_NIC_number,user_DOB,user_phoneNumber,user_gender,user_address,user_image,role_id) VALUES('$fname','$lname','$email','active','$nic','$dob','$phone','$gender','$address','$file',$rol_id)";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function UpdateUser($user_id, $fname, $lname, $dob, $nic, $gender, $phone, $email, $rol_id, $address, $file) {
        global $con;
        $sql = "UPDATE user SET user_firstName='$fname',user_lastName='$lname',user_email='$email',user_NIC_number='$nic',user_DOB='$dob',user_phoneNumber='$phone',user_gender='$gender',user_address='$address',user_image='$file',role_id=$rol_id WHERE user_id=$user_id";
        $Query = mysqli_query($con, $sql);
       return $Query;
    }

    function DeleteUser($user_id) {
        global $con;
        echo 'sdasd : '.$user_id;
        $sql1 = "DELETE FROM rights_has_user WHERE user_id=$user_id";
        $sql2 = "DELETE FROM login WHERE user_id=$user_id";
        $sql = "DELETE FROM user WHERE user_id=$user_id";
        $Query1 = mysqli_query($con, $sql1);
        $Query2 = mysqli_query($con, $sql2);
        $Query = mysqli_query($con, $sql);
        return $Query1;
    }

    function getRole() {
        global $con;
        $sql = "SELECT*FROM role";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function getModule() {
        global $con;
        $sql = "SELECT*FROM module";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewModuleRights($m) {
        global $con;
        $sql = "SELECT*FROM rights INNER JOIN module ON rights.module_id=module.module_id WHERE module.module_id=$m";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewAllRightsByUser($user_id) {
        global $con;
        $sql = "SELECT*FROM rights_has_user  WHERE user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function addRightsHasUser($e, $lastUserId) {
        global $con;
        $sql = "INSERT into rights_has_user VALUES ($e,$lastUserId)";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function DeleteRightsHasUser($UserId) {
        global $con;
        $sqldelete = "DELETE FROM rights_has_user WHERE user_id=$UserId";
        $Query = mysqli_query($con, $sqldelete);
        return $Query;
    }

    function UpdateRightsHasUser($e, $UserId) {
        global $con;
        $sql = "INSERT into rights_has_user VALUES ($e,$UserId)";
        $Query2 = mysqli_query($con, $sql);
        return $Query2;
    }

    function addLogin($uname, $pass, $lastUserId) {
        global $con;
        $sql = "INSERT into login (login_userName,login_password,user_id) VALUES ('$uname','$pass',$lastUserId)";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function UpdateLogin($uname, $pass, $UserId) {
        global $con;
        $sql = "UPDATE login SET login_userName='$uname',login_password='$pass' WHERE user_id=$UserId";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewUserDetailsByID($user_id) {
        global $con;
        //  $sql = "SELECT * from member INNER JOIN address ON member.address_id=address.address_id INNER JOIN city ON address.city_id=city.city_id  WHERE member_id=$member_id GROUP BY member.member_id" ;
        $sql = "SELECT * from user INNER JOIN role ON user.role_id=role.role_id  WHERE user.user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewAllUsers() {
        global $con;
        $sql = "SELECT*FROM user";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function getPermission($user_id) {
        global $con;

        $sql = "SELECT*FROM rights_has_user INNER JOIN rights ON rights_has_user.rights_id=rights.rights_id WHERE rights_has_user.user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function getUserById($user_id) {
        global $con;
        $sql = "SELECT * from user INNER JOIN role ON user.role_id=role.role_id INNER JOIN login ON user.user_id=login.user_id WHERE user.user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
    function getUser() {
        global $con;
        $sql = "SELECT * from user ";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
    

}

?>