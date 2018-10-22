<?php
include './database/connection.php';
global $con;
if(isset($_REQUEST['empId'])){
    
  //  echo 'oooooooooooooooo'.$_REQUEST['empId']."<br/>";
  // connection should be on this page  
//    $sql = "SELECT * FROM center";
//$result = mysqli_query($con, $sql);

    $sql = "select*from center where center_id=".$_REQUEST['empId'];
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    
    echo $row['center_code'];die;
    
   // echo $res['center_code'];die;
}
?>