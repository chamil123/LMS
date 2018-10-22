<?php

include '../database/connection.php';

class Subject {

    function viewAllSubjects() {
        global $con;
        $userQuery = "SELECT * from subject";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

}
?>
