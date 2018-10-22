<?php

include '../database/connection.php';

class Article {

    function addArticle($article_image, $article_flash, $article_topic, $description) {
        global $con;
        $userQuery = "INSERT INTO article (article_image,article_flash,article_topic,description,status)VALUES (
        '$article_image',
        '$article_flash','$article_topic','$description',
        'active')";
        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewAllArticle() {
        global $con;
        $userQuery = "SELECT * from article";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }
      function viewAllArticles($page1) {
       global $con;
        $userQuery = "SELECT * from article ORDER BY article_id DESC LIMIT " . $page1 . ",7";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }
    
    function viewArticle($courseName,$page1) {
        global $con;
        echo 'ssssss ; '.$courseName;
        
        $userQuery = "SELECT
    `article`.`article_id`
    , `article`.`article_image`,`article`.`article_flash`,`article`.`article_topic`,`article`.`description`,`article`.`status`
FROM
    `course_has_subject`
    INNER JOIN `seminko`.`course` 
        ON (`course_has_subject`.`course_id` = `course`.`course_id`)
    INNER JOIN `seminko`.`course_has_subject_has_article` 
        ON (`course_has_subject_has_article`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
    INNER JOIN `seminko`.`subject` 
        ON (`course_has_subject`.`subject_id` = `subject`.`subject_id`)
    INNER JOIN `seminko`.`article` 
        ON (`course_has_subject_has_article`.`article_id` = `article`.`article_id`) WHERE course.`course_name`='$courseName' ORDER BY article_id DESC LIMIT " . $page1 . ",7";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

  /*  function viewArticle($page1) {
        global $con;
        $userQuery = "SELECT * from article ORDER BY article_id DESC LIMIT " . $page1 . ",5";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }
*/
    function updateArticle($article_id, $article_image, $article_flash, $article_topic, $description) {
        global $con;
        $userQuery = "UPDATE article SET article_image='$article_image', article_flash='$article_flash',article_topic='$article_topic',description='$description' WHERE article_id='$article_id' ";
        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewArticlesById($artilcle_id) {
        global $con;
        $userQuery = "SELECT * from article WHERE article_id='$artilcle_id'";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function deleteArticle($article_id) {
        global $con;
        $userQuery = "DELETE from article WHERE article_id='$article_id'";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewArticleDetails($article_id) {
        global $con;
        $userQuery = "SELECT * from article WHERE article_id='$article_id'";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

}
?>

