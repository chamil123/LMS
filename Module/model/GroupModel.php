<?php
include '../../database/connection.php';
class Group {
    function seachGroupByNo($groupNo) {
        global $con;
        $sql = "SELECT 
                    *
                FROM
                    member_group tmg
                WHERE
                    tmg.group_number = '$groupNo'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
}
?>

