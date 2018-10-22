<?php
session_start();
require '../model/TuteModel.php';

$tuteModel = new Tute();
$action = $_GET['action'];
if (isset($_POST['tute_data_packaet'])) {
    $publish_date = $_POST['publish_date'];
//    echo $publish_date;
    $tute_name = $_POST['tute_name'];
    $tute_chapter = $_POST['tute_chapter'];
    $tute_description = $_POST['tute_description'];

    if ($_FILES['tute_image']['name'] != "") {
        $paper_image = $_FILES['tute_image']['name'];

        $new = $paper_image;
        $path = "../tutes/" . $new; //New path
        $old = $_FILES['tute_image']['tmp_name']; //Old path
        move_uploaded_file($old, $path); //To move an image 
        // $obj->updateImage($r, $new);
    }
    $result = $tuteModel->addTute($path, $tute_name, $tute_chapter, $tute_description, $publish_date);
    if ($result > 0) {
        $_SESSION['msgt'] = 1;
    }
    header("Location:../AddTute.php?msg=$msg");
}

if (isset($_POST['Update_tute_data_packaet'])) {
    $tutes_id = $_POST['tutes_id'];
    $publish_date = $_POST['publish_date'];
    $tute_name = $_POST['tute_name'];
    $tute_chapter = $_POST['tute_chapter'];
    $tute_description = $_POST['tute_description'];
    $newpath = $_POST['tute_image2'];
    
    if ($_FILES['tute_image']['name'] != "") {
        $paper_image = $_FILES['tute_image']['name'];

        $new = $paper_image;
        $path = "../tutes/" . $new; //New path
        $old = $_FILES['tute_image']['tmp_name']; //Old path
        move_uploaded_file($old, $path); //To move an image 
     
         if ($path == "") {

            echo 'new path is : ' . $newpath;
        } else {
            $newpath = $path;
        }
    }

    $result = $tuteModel->updateTute($tutes_id, $newpath, $tute_name, $tute_chapter, $tute_description, $publish_date);
    if ($result > 0) {
        $_SESSION['msgt'] = 3;
    }
    header("Location:../ViewAdminTutes.php?msg=$msg");
}

$action = $_GET['action'];

if ($action == "delete") {
    $tutes_id = $_GET['tutes_id'];

    $result = $tuteModel->deleteTute($tutes_id);
    if ($result > 0) {
        $_SESSION['msgt'] = 2;
    }
    header("Location:../ViewAdminTutes.php?msg=$msg");
}
?>
