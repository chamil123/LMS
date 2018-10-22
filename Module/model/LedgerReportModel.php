<?php

include '../../database/connection.php';

class LedgerReport {

    function ViewMemberByMemberNum($member_AnyNumber) {
        global $con;
        $sql = "SELECT * from member INNER JOIN application ON member.member_id=application.member_id INNER JOIN center ON member.center_id=center.center_id WHERE member_number='$member_AnyNumber' OR member_NIC='$member_AnyNumber' OR member_code='$member_AnyNumber'";
        //$sql = "SELECT * from memberCenter,member  WHERE member.member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewAllApplicationByMember_id($member_id) {
        global $con;
        $sql = "SELECT * from application WHERE member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
     function viewApplicationByApplication_ID($application_id) {
        global $con;
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id  WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

}

?>
