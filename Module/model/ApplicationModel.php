<?php

include '../../database/connection.php';

class Application {

    function addApplication($member_id, $aplication_lamount, $aplication_lperiod, $aplication_months, $aplication_lamountWithInt, $aplication_irate, $aplication_ldue, $aplication_lterm, $aplication_rentalf, $aplication_intCal) {
        global $con;
        $dt = new DateTime();
        $date = $dt->format('Y-m-d');
        echo 'date :' . $date;
        $sql = "INSERT INTO application (application_lamount,application_lperiod,application_month,application_lamountWithInt,application_availableAmount 
,application_irate,application_ldue,application_lterm,application_rentalf,application_intCal,application_date,member_id,application_status)VALUES (
        $aplication_lamount,$aplication_lperiod,$aplication_months,$aplication_lamountWithInt,$aplication_lamountWithInt,$aplication_irate,$aplication_ldue,$aplication_lterm,'$aplication_rentalf','$aplication_intCal','$date','$member_id','pending')";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function OtherGuranters($lastApplicationId, $memberId) {
        global $con;
        $sql = "INSERT INTO application_has_member VALUES ($lastApplicationId,$memberId)";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewAllApplications() {
        global $con;
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id WHERE application.application_status='pending'  ORDER BY application_id DESC";
        // $sql = "SELECT * from application INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id ORDER BY member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }
     function viewCloseApplications() {
        global $con;
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id WHERE application.application_status='activated' ORDER BY application_id DESC";
        // $sql = "SELECT * from application INNER JOIN branch ON member.member_branchNumber=branch.branch_code INNER JOIN center ON member.center_id=center.center_id ORDER BY member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewApplicationDetailsByID($application_id) {
        global $con;
        //  $sql = "SELECT * from member INNER JOIN address ON member.address_id=address.address_id INNER JOIN city ON address.city_id=city.city_id  WHERE member_id=$member_id GROUP BY member.member_id" ;
        $sql = "SELECT * from application INNER JOIN application_has_member ON application.application_id=application_has_member.application_id INNER JOIN member ON application_has_member.member_id=member.member_id   WHERE application.application_id=$application_id ";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewGuranterDetailsByApplicationId($application_id) {
        global $con;
        $sql = "SELECT * from application_has_member INNER JOIN member ON  application_has_member.member_id=member.member_id WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewApplicationDetailsAndAddressByID($application_id) {
        global $con;
        $sql = "SELECT * from application INNER JOIN application_has_member ON application.application_id=application_has_member.application_id INNER JOIN member ON application_has_member.member_id=member.member_id INNER JOIN guranter ON member.member_id=guranter.member_id   WHERE application.application_id=$application_id ";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewMemberById($member_id) {
        global $con;
        $sql = "SELECT member_NIC,member_inital,member_surNmae,member_id from member WHERE member_id='$member_id'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function updateApplication($member_id, $aplication_lamount, $aplication_lperiod, $aplication_months, $aplication_lamountWithInt, $aplication_irate, $aplication_ldue, $aplication_lterm, $aplication_rentalf, $aplication_intCal, $application_id) {
        global $con;
        $sql = "UPDATE  application  set , application_lamount=$aplication_lamount,application_lperiod=$aplication_lperiod,application_month=$aplication_months,application_lamountWithInt=$aplication_lamountWithInt,application_irate=$aplication_irate,application_ldue=$aplication_ldue,application_lterm= $aplication_lterm,application_rentalf='$aplication_rentalf',application_intCal='$aplication_intCal',member_id=$member_id WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function DeleteApplication($application_id) {
        global $con;
        $sql = "DELETE FROM application_has_member WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewMemberDetailsByApplicationId($application_id) {
        global $con;

        $sql = "SELECT member.member_NIC,member.member_inital,member.member_surNmae,member.member_id from member INNER JOIN application ON application.member_id= member.member_id WHERE application.application_id='$application_id' ";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewMemberAllDetailsByApplicationId($application_id) {
        global $con;

        $sql = "SELECT*from member INNER JOIN application ON application.member_id= member.member_id WHERE application.application_id='$application_id' ";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function activeStatus($application_id) {

        global $con;
        $dt = new DateTime();
        $date = $dt->format('Y-m-d');
        
        $sql = "UPDATE application set application_status ='activated',application_activateDate='$date' WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return 1;
        } else {
            return FALSE;
        }
    }

    function checkPreviousNotClosedLoans($application_id) {
        global $con;
        $sql = "SELECT*FROM application WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        $result = mysqli_fetch_array($Query);
        $member_NIC = $result['member_id'];

        $sql2 = "SELECT*FROM application  WHERE member_id=$member_NIC AND application_status='activated'";
        $Query2 = mysqli_query($con, $sql2);
        if ($Query2) {
            return $Query2;
        } else {
            return FALSE;
        }
        return $Query2;
    }

    function pendingStatus($application_id) {
        $dt = new DateTime();
        $date = $dt->format('Y-m-d');
        global $con;
        $sql = "UPDATE application set application_status ='active',application_activateDate='$date' WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return 1;
        } else {
            return FALSE;
        }
    }

    function closeAplication($application_id) {
        $dt = new DateTime();
        $date = $dt->format('Y-m-d');
        global $con;
        $sql = "UPDATE application set application_status ='closed',application_activateDate='$date' WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return 1;
        } else {
            return FALSE;
        }
    }

    function deleteAplication($application_id) {
        global $con;

        $sqldailyCollection = "DELETE FROM dailycollection WHERE application_id=$application_id";
        $sqlapplicationHasMember = "DELETE FROM application_has_member WHERE application_id=$application_id";
        $sql = "DELETE FROM application WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return 1;
        } else {
            return FALSE;
        }
    }

    function dailyCollectionByApplicationID($application_id) {
        global $con;
        $sql = "SELECT*FROM dailycollection WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $Query;
        } else {
            return FALSE;
        }

    }
     function checkLoanTerm($member_id) {
        global $con;
        $sql = "SELECT count(*) as num_comments FROM application WHERE member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $Query;
        } else {
            return FALSE;
        }
     
    }

}

?>
