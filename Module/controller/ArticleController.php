<?php

session_start();
require '../model/ArticleModel.php';

$articleModel = new Article();
$action = $_GET['action'];
if (isset($_POST['article_data_packaet'])) {
    $article_topic = $_POST['article_topic'];
    $description = $_POST['description'];

    if ($_FILES['article_image']['name'] != "") {
        $article_image = $_FILES['article_image']['name'];

        $new = $article_image;
        $pathimg = "../articles/" . $new; //New path
        $old = $_FILES['article_image']['tmp_name']; //Old path
        move_uploaded_file($old, $pathimg); //To move an image 
        // $obj->updateImage($r, $new);
    }

    if ($_FILES['article_flash']['name'] != "") {
        $article_flash = $_FILES['article_flash']['name'];

        $new = $article_flash;
        $path = "../flash/" . $new; //New path
        $old = $_FILES['article_flash']['tmp_name']; //Old path
        move_uploaded_file($old, $path); //To move an image 
        // $obj->updateImage($r, $new);
    }

    $result = $articleModel->addArticle($pathimg, $path, $article_topic, $description);

    if ($result > 0) {
        $_SESSION['msga'] = 1;
    }
    header("Location:../AddArticle.php");
}

if (isset($_POST['Update_articles_data_packaet'])) {

    $article_topic = $_POST['article_topic'];
    $description = $_POST['description'];
    $article_id = $_POST['article_id'];

    $newpathimg = $_POST['article_image2'];
    $newpath = $_POST['article_flash2'];

    echo 'new image path iss  : ' . $newpathimg;

    if ($_FILES['article_image']['name'] != "") {
        $article_image = $_FILES['article_image']['name'];

        $new = $article_image;
        $pathimg = "../articles/" . $new; //New path
        $old = $_FILES['article_image']['tmp_name']; //Old path
        move_uploaded_file($old, $pathimg); //To move an image 
        // $obj->updateImage($r, $new);
        if ($pathimg == "") {
            //echo 'new path is : ' . $newpathimg;
        } else {
            $newpathimg = $pathimg;
        }
    }

    if ($_FILES['article_flash']['name'] != "") {
        $article_flash = $_FILES['article_flash']['name'];

        $new = $article_flash;
        $path = "../flash/" . $new; //New path
        $old = $_FILES['article_flash']['tmp_name']; //Old path
        move_uploaded_file($old, $path); //To move an image 
        // $obj->updateImage($r, $new);
        if ($path == "") {
            //echo 'new path is : ' . $newpathimg;
        } else {
            $newpath = $path;
        }
    }

    $result = $articleModel->updateArticle($article_id, $newpathimg, $newpath, $article_topic, $description);

    if ($result > 0) {
        $_SESSION['msga'] = 3;
    }
    header("Location:../ViewAdminArticles.php");
}


if ($action == "delete") {
    $article_id = $_GET['article_id'];
//    echo $article_id;

    $result = $articleModel->deleteArticle($article_id);
    if ($result > 0) {
        $_SESSION['msga'] = 2;
    }
    header("Location:../ViewAdminArticles.php");
}if ($action == "filteration") {
    $course = $_GET['course_name'];
    
    echo 'ssasasas d d  d  ; '.$course;
   header("Location:../ArticleGridView.php?course=$course");
}
?>
