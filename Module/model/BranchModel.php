<?php

include '../../database/connection.php';

class Branch {

//    function addBranch($center_number, $center_name, $center_day) {
//        global $con;
//        $sql = "INSERT INTO center (center_code,center_name,center_date)VALUES (
//        '$center_number','$center_name','$center_day')";
//        $Query = mysqli_query($con, $sql);
//        if ($Query) {
//            return TRUE;
//        } else {
//            return FALSE;
//        }
//    }

    function viewAllBranches() {
        global $con;
        $sql = "SELECT * from branch";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

  

}

?>