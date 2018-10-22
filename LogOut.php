<?php

if (!isset($_SESSION)) {
    session_start();
}
unset($_SESSION['userinfo']);
unset($_SESSION['BRANCH_CODE']);
session_destroy();

 header("Location:index.php");
?>

