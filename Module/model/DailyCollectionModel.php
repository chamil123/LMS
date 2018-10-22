<?php

include '../../database/connection.php';

class DailyCollection {

    function addCollection($date, $pay, $app_id, $m_id) {
        global $con;
        $sql = "INSERT INTO dailycollection (dailycollection_date,dailycollection_amount_paid,application_id,member_id)VALUES (
        '$date',$pay,$app_id,$m_id)";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function viewAll() {
        global $con;
        $sql = "SELECT*FROM dailycollection INNER JOIN member ON dailycollection.member_id=member.member_id INNER JOIN application ON dailycollection.application_id=application.application_id  LIMIT 150";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }function viewAllByApplicationID($application_id) {
 
        global $con;
        $sql = "SELECT*FROM dailycollection  INNER JOIN application ON dailycollection.application_id=application.application_id WHERE application.application_id=$application_id ";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

}
?>

