<?php

//echo 'sdasdas';
include './database/connection.php';
$center_id=$_GET['nic_number'];
global $con;
if($center_id!=null){
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
                member.member_NIC = '$center_id'
                    AND member.member_status = 'Active'";    
}

//else{
//    $sql = "SELECT 
//                *
//            FROM
//                member
//                    INNER JOIN
//                guranter ON member.member_id = guranter.member_id
//                    INNER JOIN
//                center ON member.center_id = center.center_id
//                    INNER JOIN
//                branch ON center.branch_id = branch.branch_id
//            WHERE
//                member.member_status = 'Active' ";    
//}

$result = mysqli_query($con, $sql);
//var_dump($_REQUEST);

$array_curency = array();
while ($row = mysqli_fetch_array($result)) {

    $array_curency[] = $row;
}
//echo mysqli_errno($db);
echo json_encode($array_curency);
?>
