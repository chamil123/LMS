<?php

include '../../database/connection.php';

class ContractInquery {

    function viewInqueryByMember_NIC($member_nic) {
        global $con;
        $sql = "SELECT * FROM member INNER JOIN guranter ON member.member_id=guranter.member_id INNER JOIN application ON member.member_id=application.member_id INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id  WHERE  application_status='activated' AND member.member_NIC='$member_nic' ";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $Query;
        } else {
            return FALSE;
        }
    }

    function viewActiveApplicationDetailsBYAppId($application_id) {
        global $con;
        $sql = "SELECT * FROM dailycollection WHERE  application_id=$application_id ORDER BY dailycollection_id DESC LIMIT 1";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $Query;
        } else {
            return FALSE;
        }
    }

}

?>
