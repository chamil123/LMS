<?php

include '../../database/connection.php';

class Charges {

    function addCharges($application_id, $document_charges, $member_fee,$security_service) {
        global $con;
        $sql = "INSERT INTO charges (charges_documentCharges,charges_memberFee,charges_securityService,application_id) VALUES($document_charges,$member_fee,$security_service,$application_id) ";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function viewApplicationDetailsByID($application_id) {
        global $con;
        //  $sql = "SELECT * from member INNER JOIN address ON member.address_id=address.address_id INNER JOIN city ON address.city_id=city.city_id  WHERE member_id=$member_id GROUP BY member.member_id" ;
        $sql = "SELECT * from application INNER JOIN  member ON application.member_id=member.member_id WHERE application.application_id=$application_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

    function loanTermByMemberID($member_id) {
        global $con;
        $sql = "SELECT count(*) as num_comments FROM application WHERE member_id=$member_id";
        $Query = mysqli_query($con, $sql);
        return $Query;
    }

}

?>
