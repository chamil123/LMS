<?php

include '../../database/connection.php';

class Report {

    function viewArreasApplications() {
        global $con;
        $sql = "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewArreasApplicationsByBranchId($serchBoxBranch) {
        global $con;
        $sql = "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_id=$serchBoxBranch";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewArreasApplicationsByCenterId($serchBoxCenter) {
        global $con;
        $sql = "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id  WHERE center.center_id=$serchBoxCenter";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewArreasApplicationsBothId($serchBoxBranch, $serchBoxCenter) {
        global $con;
        $sql = "SELECT*FROM application INNER JOIN member ON application.member_id=member.member_id INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE center.center_id=$serchBoxCenter AND branch.branch_id=$serchBoxBranch";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function viewAllApplications() {
        global $con;
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id ";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewDocumentChargesByApplicationID($application_id) {
        global $con;
        $sql = "SELECT * from charges WHERE application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllApplicationsByBranch($serchBoxBranch) {
       global $con;
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllApplicationsByCenter($serchBoxCenter) {
       global $con;
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE center.center_code=$serchBoxCenter";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllApplicationsByCenterAndBranch($serchBoxBranch,$serchBoxCenter) {
       global $con;
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch AND center.center_code=$serchBoxCenter";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllApplicationsBetweenDates($from_date, $to_date) {
       global $con; 
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE application.application_date BETWEEN '$from_date' AND '$to_date'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllApplicationsBetweenDatesANDbranch_center($from_date, $to_date,$serchBoxBranch,$serchBoxCenter) {
       global $con; 
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch AND center.center_code=$serchBoxCenter AND application.application_date BETWEEN '$from_date' AND '$to_date'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllApplicationsBetweenDatesANDbranch($from_date, $to_date,$serchBoxBranch) {
       global $con; 
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE branch.branch_code=$serchBoxBranch  AND application.application_date BETWEEN '$from_date' AND '$to_date'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllApplicationsBetweenDatesANDcenter($from_date, $to_date,$serchBoxCenter) {
       global $con; 
        $sql = "SELECT * from application INNER JOIN member ON application.member_id=member.member_id  INNER JOIN center ON member.center_id=center.center_id INNER JOIN branch ON center.branch_id=branch.branch_id WHERE center.center_code=$serchBoxCenter  AND application.application_date BETWEEN '$from_date' AND '$to_date'";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

}

?>
