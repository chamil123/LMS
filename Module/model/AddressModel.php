<?php

include '../../database/connection.php';

class Address {

    function addAddress($member_aline1, $member_aline2, $member_aline3, $member_cityid) {
        global $con;
        $sql = "INSERT INTO address (address_line1,address_line2,address_line3,city_id)VALUES (
        '$member_aline1','$member_aline2','$member_aline3',$member_cityid)";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function updateMemberAddress($member_aline1, $member_aline2, $member_aline3, $member_cityid, $member_addressid) {
        global $con;
        $sql = "UPDATE address SET address_line1='$member_aline1',address_line2='$member_aline2',address_line3='$member_aline3',city_id=$member_cityid WHERE address_id=$member_addressid";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function updateGurantorAddress($guranter_addressln1, $guranter_addressln2, $guranter_addressln3, $gurantor_cityid,$gurantor_addressid) {
        global $con;
        $sql = "UPDATE address SET address_line1='$guranter_addressln1',address_line2='$guranter_addressln2',address_line3='$guranter_addressln3',city_id=$gurantor_cityid WHERE address_id=$gurantor_addressid";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

}

?>