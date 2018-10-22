<?php

include '../../database/connection.php';

class Login {

    function loginValidate($Username, $Password) {
        global $con;
//                $sql = "SELECT*FROM login INNER JOIN user ON login.login_id=user.login_id INNER JOIN role ON user.role_id=role.role_id INNER JOIN rights_has_user ON user.user_id=rights_has_user.user_id INNER JOIN rights ON rights_has_user.rights_id=rights.rights_id";
        
        $sql = "SELECT*FROM login INNER JOIN user ON login.user_id=user.user_id INNER JOIN role ON user.role_id=role.role_id WHERE login.login_userName='$Username' AND login.login_password='$Password'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
    function getPermission($user_id){
         global $con; 
         echo 'user id : '.$user_id;
        $sql = "SELECT*FROM rights_has_user INNER JOIN rights ON rights_has_user.rights_id=rights.rights_id WHERE rights_has_user.user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
      function branchByCode($branch_id) {
        global $con;
        $sql = "SELECT * from branch WHERE branch_code='$branch_id'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
     function getUserDetails($user_id) {
        global $con;
        $sql = "SELECT 
                    *
                FROM
                    user tu
                WHERE
                    user_id = $user_id AND user_status = 0;";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

}
?>

