<?php

include '../database/connection.php';

class PaperType {


    function viewType() {
        global $con;
        $userQuery = "SELECT*from paper_type";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

 
}

?>