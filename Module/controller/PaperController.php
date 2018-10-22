<?php

session_start();
require '../model/PaperModel.php';

$paper = new Paper();
$action = $_GET['action'];

if (isset($_POST['paper_data_packaet'])) {
    $publish_date = $_POST['publish_date'];
    $paper_type_id = $_POST['paper_type_id'];
    $description = $_POST['description'];

    if ($_FILES['paper_image']['name'] != "") {
        $paper_image = $_FILES['paper_image']['name'];

        $new = $paper_image;
        $path = "../papers/" . $new; //New path
        $old = $_FILES['paper_image']['tmp_name']; //Old path
        move_uploaded_file($old, $path); //To move an image 
        echo 'path is : ' . $path;
        // $obj->updateImage($r, $new);
    }



    $result = $paper->addPaper($paper_type_id, $path, $description, $publish_date);
    if ($result > 0) {
        $_SESSION['msgp'] = 1;
    }
    header("Location:../AddPapers.php");
}
if (isset($_POST['Update_paper_data_packaet'])) {
    $publish_date = $_POST['publish_date'];
    $paper_type_id = $_POST['paper_type_id'];
    $description = $_POST['description'];
    $paper_id = $_POST['paper_id'];
    $newpath = $_POST['paper_image2'];

    if ($_FILES['paper_image']['name'] != "") {
        $paper_image = $_FILES['paper_image']['name'];

        $new = $paper_image;
        $path = "../papers/" . $new; //New path
        $old = $_FILES['paper_image']['tmp_name']; //Old path
        move_uploaded_file($old, $path); //To move an image 
        //
        if ($path == "") {

            echo 'new path is : ' . $newpath;
        } else {
            $newpath = $path;
        }
        // $obj->updateImage($r, $new);
    }

    $result = $paper->updatePaper($paper_id, $paper_type_id, $newpath, $description, $publish_date);
    if ($result > 0) {
        $_SESSION['msgp'] = 3;
    }
    header("Location:../ViewAdminPapers.php");
}

if ($action == "delete") {
    $paper_id = $_GET['paper_id'];
    echo $paper_id;
    $result = $paper->deletePaper($paper_id);
    if ($result > 0) {
        $_SESSION['msgp'] = 2;
    }
    header("Location:../ViewAdminPapers.php");
}
?>
