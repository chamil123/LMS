<?php

include '../../database/connection.php';

class Group {

    function addGroup($member_group, $centerid, $branchid) {
        global $con;
        mysqli_autocommit($con, FALSE);
        $sql = "INSERT into member_group (group_number,group_status,center_id,branch_id) VALUES('$member_group',0,$centerid,$branchid)";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function seachGroupByNo($groupNo) {
        global $con;
        echo $sql = "SELECT 
                    *
                FROM
                    member_group tmg
                WHERE
                    tmg.group_number = '$groupNo'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function commit() {
        global $con;
        $con->commit();
    }

    function rollback() {
        global $con;
        $con->rollback();
    }

}
?>

