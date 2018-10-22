<?php
if(count($_SESSION['userinfo'])==0){
    $msg="Please Login";
    header("Location:index.php?msg=$msg");
    
    
    exit;
    
}




?>

