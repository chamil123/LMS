<?php

//echo 'sdasdas';
include './database/connection.php';
$branch_id=$_GET['branch_id'];
global $con;
if($branch_id!=null){
$sql = "SELECT 
                *
            FROM
                member
                    INNER JOIN
                guranter ON member.member_id = guranter.member_id
                    INNER JOIN
                center ON member.center_id = center.center_id
                    INNER JOIN
                branch ON center.branch_id = branch.branch_id
            WHERE
                branch.branch_id = $branch_id
                    AND member.member_status = 'Active'";    
}else{
    $sql = "SELECT 
                *
            FROM
                member
                    INNER JOIN
                guranter ON member.member_id = guranter.member_id
                    INNER JOIN
                center ON member.center_id = center.center_id
                    INNER JOIN
                branch ON center.branch_id = branch.branch_id
            WHERE
                member.member_status = 'Active' ";    
}

$result = mysqli_query($con, $sql);
//var_dump($_REQUEST);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
//echo mysqli_errno($db);
echo json_encode($array_curency);
?>
