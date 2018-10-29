<?php

include '../../database/connection.php';

class Center {

    function addCenter($center_branch, $center_number, $center_name, $center_day, $user_id) {
        global $con;
        $sql = "INSERT INTO center (branch_id,center_code,center_name,center_date,user_id,center_status)VALUES ($center_branch,
        '$center_number','$center_name','$center_day',$user_id,0)";
        $Query = mysqli_query($con, $sql);
        

        if ($Query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewAllCenters() {
        global $con;
        $sql = "SELECT 
                    *
                FROM
                    center tc
                        INNER JOIN
                    branch tb ON tc.branch_id = tb.branch_id
                WHERE
                    tc.center_status = 0 ORDER BY tb.branch_id DESC";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewCenterById($center_id) {
        global $con;
        $sql = "SELECT * from center WHERE center_id='$center_id'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function UpdateCenter($center_id, $center_branch, $center_number, $center_name, $center_day,$user_id) {
        global $con;
        $sql = "UPDATE center SET center_code='$center_number',center_name='$center_name',center_date='$center_day',branch_id=$center_branch,user_id=$user_id WHERE center_id='$center_id'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function deleteCenter($center_id) {
        echo 'sdadasd : ' . $center_id;
        global $con;
         $sql = "UPDATE center SET center_status=1 WHERE center_id='$center_id'";
     //   $sql = "DELETE FROM center WHERE center_id='$center_id'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function getPermission($user_id) {
        global $con;

        $sql = "SELECT*FROM rights_has_user INNER JOIN rights ON rights_has_user.rights_id=rights.rights_id WHERE rights_has_user.user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function getMaxId() {
        global $con;
        $sql = "SELECT MAX(tc.center_id) FROM center tc";
        $Query = mysqli_query($con, $sql);

        $data = mysqli_fetch_array($Query);
        return $data[0];
    }function getMaxCenterCode($branch_Id) {
        global $con;
        $sql = "SELECT 
                    MAX(tc.center_code) AS count_id
                FROM
                    center tc
                WHERE
                    tc.branch_id = $branch_Id
                        AND tc.center_status = 0";
        $Query = mysqli_query($con, $sql);

        $data = mysqli_fetch_array($Query);
        return $data[0];
    }

    function viewUserById($user_id) {
        global $con;
        $sql = "SELECT user_firstName,user_lastName FROM user WHERE user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
    function autocomplete($data) {
        global $con;
        $sql = "SELECT center_name,center_code FROM center WHERE center_name LIKE '$data%'";
        $query = mysqli_query($con, $sql);
        return $query;
    }

}

?>