<?php

include '../../database/connection.php';

class Guranter {

    function addGuranter($guranter_nic, $guranter_surname, $guranter_initial, $guranter_fullInitial, $guranter_contact, $guranter_dob, $resultMember, $guranter_addressln1, $guranter_addressln2, $guranter_addressln3, $guranter_addressln4) {
        global $con;
        mysqli_autocommit($con, FALSE);
        $guranter_sur = ucwords($guranter_surname);
        $guranter_fullIni = ucwords($guranter_fullInitial);
         $sql = "INSERT INTO guranter (guranter_surName,guranter_initialInFulWithoutSurname,guranter_initial,guranter_NIC,guranter_dateOfBirth,guranter_contact,member_id,guranter_AddressLine1 ,guranter_AddressLine2,guranter_AddressLine3,guranter_AddressLine4,guranter_status)VALUES (
        '$guranter_sur','$guranter_fullIni','$guranter_initial','$guranter_nic','$guranter_dob','$guranter_contact',$resultMember,'$guranter_addressln1', '$guranter_addressln2', '$guranter_addressln3', '$guranter_addressln4',0)";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
    }

    function updateGuranter($guranter_nic, $guranter_surname, $guranter_initial, $guranter_fullInitial, $guranter_contact, $guranter_dob, $member_id, $guranter_id, $guranter_addressln1, $guranter_addressln2, $guranter_addressln3, $guranter_addressln4) {
        global $con;
       echo $sql = "UPDATE guranter SET guranter_surName='$guranter_surname',guranter_initialInFulWithoutSurname='$guranter_fullInitial',guranter_initial='$guranter_initial',guranter_NIC='$guranter_nic',guranter_dateOfBirth='$guranter_dob',guranter_contact='$guranter_contact',member_id=$member_id,guranter_AddressLine1='$guranter_addressln1',guranter_AddressLine2='$guranter_addressln2',guranter_AddressLine3='$guranter_addressln3',guranter_AddressLine4='$guranter_addressln4' WHERE guranter_id=$guranter_id";
        $Query = mysqli_query($con, $sql);
        if ($Query) {
            return $con->insert_id;
        } else {
            return FALSE;
        }
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