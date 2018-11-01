<?php

include '../../database/connection.php';

class Member {

    function getMemberName($key) {
        $con = $GLOBALS['con'];
        $sql = "SELECT member_number FROM member WHERE member_number='$key'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function addMember($member_number, $member_nic, $member_surname, $member_initial, $member_fullInitial, $member_dob, $member_status, $member_gender, $member_nationality, $member_mobile, $member_homenumber, $centerid, $branch_code, $member_aline1, $member_aline2, $member_aline3, $member_aline4, $group_id) {
        global $con;
        mysqli_autocommit($con, FALSE);
        $result = $con->query("SELECT member_id FROM member ORDER BY member_id  DESC LIMIT 1");
        $id;
        while ($row = $result->fetch_assoc()) {
            $id = $row['member_id'];
        }
        $id++;
        $num_str = sprintf("%010d", $id);

        $member_serNam = ucwords($member_surname);
        $member_fullIni = ucwords($member_fullInitial);

        $sql = "INSERT INTO member (member_number,member_NIC,member_surNmae,member_inital,member_initialInFulWithoutSurname,member_dateOfBirth,member_maritalStatus,
            member_gender,member_nationality,member_mobileNumber,member_homeNumber,center_id,member_branchNumber,member_status,member_AddressLine1,member_AddressLine2,member_AddressLine3,member_AddressLine4,member_code,group_id)VALUES (
        '$member_number','$member_nic','$member_serNam','$member_initial','$member_fullIni','$member_dob','$member_status','$member_gender','$member_nationality','$member_mobile','$member_homenumber',$centerid,'$branch_code','Active','$member_aline1', '$member_aline2', '$member_aline3', '$member_aline4','$num_str',$group_id)";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function updateMember($member_number, $member_nic, $member_surname, $member_initial, $member_fullInitial, $member_dob, $member_status, $member_gender, $member_nationality, $member_group, $member_mobile, $member_homenumber, $centerid, $member_id, $branch_code, $member_aline1, $member_aline2, $member_aline3, $member_aline4) {
        global $con;
        echo $sql = "UPDATE member set member_number='$member_number',member_NIC='$member_nic',member_surNmae='$member_surname',member_inital='$member_initial',member_initialInFulWithoutSurname='$member_fullInitial',member_dateOfBirth='$member_dob',member_maritalStatus='$member_status',
            member_gender='$member_gender',member_nationality='$member_nationality',group_id='$member_group',member_mobileNumber='$member_mobile',member_homeNumber='$member_homenumber',center_id=$centerid,member_branchNumber='$branch_code',member_AddressLine1 ='$member_aline1',member_AddressLine2 ='$member_aline2',member_AddressLine3='$member_aline3',member_AddressLine4='$member_aline4'  WHERE member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return 1;
        } else {
            return FALSE;
        }
    }

    function viewAllMembers() {
        global $con;
        $sql = "SELECT * from member INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id ORDER BY member_id DESC";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewMemberDetailsByID($member_id) {
        global $con;
        //  $sql = "SELECT * from member INNER JOIN address ON member.address_id=address.address_id INNER JOIN city ON address.city_id=city.city_id  WHERE member_id=$member_id GROUP BY member.member_id" ;
        $sql = "SELECT * from member  WHERE member.member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewMemberDetailsByIDinVIEW($member_id) {
        global $con;
        $sql = "SELECT * from member  WHERE member_id=$member_id";
        //$sql = "SELECT * from memberCenter,member  WHERE member.member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewGuranterDetailsByID($member_id) {
        global $con;
        $sql = "SELECT * from guranter INNER JOIN member ON guranter.member_id=member.member_id  WHERE guranter.member_id=member.member_id AND member.member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function activateStatus($member_id) {

        echo 'sssssssssssssss ' . $member_id;
        global $con;
        $sql = "UPDATE member set member_status='Deactive' WHERE member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return 1;
        } else {
            return FALSE;
        }
    }

    function deactivateStatus($member_id) {
        global $con;
        $sql = "UPDATE member set member_status='Active' WHERE member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return 1;
        } else {
            return FALSE;
        }
    }

    function viewAllMembersWithMemberCode() {
        global $con;
        $sql = "SELECT * from member INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id INNER JOIN application ON member.member_id=application.member_id WHERE application_status='activated'  ORDER BY member_group  DESC LIMIT 100";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewMemberANDApplicationDetailsByID($member_id) {
        global $con;
        $sql = "SELECT * from member INNER JOIN application ON member.member_id=application.member_id WHERE application_status='Active' AND member.member_id=$member_id ORDER BY member_group  DESC";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function availableAmount($applicatio_id) {
        global $con;
        $sql = "SELECT  SUM(dailycollection_amount_paid) AS amt FROM dailycollection WHERE application_id=$applicatio_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function serchByCenter($serchBox) {
        global $con;
        $sql = "SELECT * from member INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id INNER JOIN application ON member.member_id=application.member_id WHERE application.application_status='activated' AND member.center_id=$serchBox ORDER BY member_group  DESC";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function serchByMemberNum($serchBox) {
        global $con;
        $sql = "SELECT * from member INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id INNER JOIN application ON member.member_id=application.member_id WHERE application.application_status='activated' AND member.member_number='$serchBox' ORDER BY member_group  DESC";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function serchByNicNum($serchBox) {
        global $con;
        $sql = "SELECT * from member INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id INNER JOIN application ON member.member_id=application.member_id WHERE application.application_status='activated' AND member.member_NIC='$serchBox' ORDER BY member_group  DESC";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function serchByAppID($serchBox) {
        global $con;
        $sql = "SELECT * from member INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id INNER JOIN application ON member.member_id=application.member_id WHERE application_status='activated' AND application.application_id='$serchBox' ORDER BY member_group  DESC";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function getPermission($user_id) {
        global $con;

        $sql = "SELECT*FROM rights_has_user INNER JOIN rights ON rights_has_user.rights_id=rights.rights_id WHERE rights_has_user.user_id=$user_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function getMaxmemberNo($branch_Id) {
        global $con;
        $sql = "SELECT 
                    IFNULL(MAX(tm.member_id + 1), 1) AS max_member_id
                FROM
                    member tm
                        INNER JOIN
                    center tc ON tm.center_id = tc.center_id
                WHERE
                    tc.branch_id = $branch_Id
                        AND tm.member_status = 'Active'
                        AND tc.center_status = 0";
        $Query = mysqli_query($con, $sql);

        $data = mysqli_fetch_array($Query);
        return $data[0];
    }

    function getAllMemberGroupByCenter($branch_id, $center_id) {
        global $con;
        $sql = "SELECT 
                    tg.group_number, tg.group_id
                FROM
                    member_group tg
                WHERE
                    tg.branch_id = $branch_id AND tg.center_id = $center_id
                        AND tg.group_status = 0";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function autocomplete($data, $branch_id) {
        global $con;
        $sql = "SELECT 
                    tm.member_NIC,tm.member_id,tc.center_id
                FROM
                    member tm
                        INNER JOIN
                    center tc ON tm.center_id = tc.center_id
                WHERE
                    tm.member_NIC LIKE '$data%'
                        AND tc.branch_id = $branch_id";
        $query = mysqli_query($con, $sql);
        return $query;
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