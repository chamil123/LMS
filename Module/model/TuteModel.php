<?php

include '../database/connection.php';

class Tute {

    function addTute($tute_image, $tute_name, $tute_chapter, $tute_description, $publish_date) {
        global $con;
        $userQuery = "INSERT INTO tute (Image,tute_name,tute_chapter,tute_description,status,publish_date)VALUES (
        '$tute_image','$tute_name',
        '$tute_chapter','$tute_description',
        '1','$publish_date')";
        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewTutes() {
        global $con;
        $userQuery = "SELECT * from tute";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }
    function viewTutesFP($st_id) {
        global $con;
        $userQuery = "SELECT
    `tute`.`tute_id`
    , `tute`.`Image`
    , `tute`.`tute_name`
    , `tute`.`tute_chapter`
    , `tute`.`tute_description`
    , `tute`.`publish_date`
FROM
    `seminko`.`course_has_subject_has_tute`
    INNER JOIN `seminko`.`tute` 
        ON (`course_has_subject_has_tute`.`tute_id` = `tute`.`tute_id`)
    INNER JOIN `seminko`.`course_has_subject` 
        ON (`course_has_subject_has_tute`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
    INNER JOIN `seminko`.`course` 
        ON (`course_has_subject`.`course_id` = `course`.`course_id`)
    INNER JOIN `seminko`.`subject` 
        ON (`course_has_subject`.`subject_id` = `subject`.`subject_id`)
    INNER JOIN `seminko`.`course_has_subject_has_class` 
        ON (`course_has_subject_has_class`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
    INNER JOIN `seminko`.`class` 
        ON (`course_has_subject_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`student_has_class` 
        ON (`student_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`student` 
        ON (`student_has_class`.`st_id` = `student`.`st_id`)WHERE `student`.`st_id`='$st_id'";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }
    function viewTuteByPageFP($st_id,$page1) {
        global $con;
        $userQuery = "SELECT
    `tute`.`tute_id`
    , `tute`.`Image`
    , `tute`.`tute_name`
    , `tute`.`tute_chapter`
    , `tute`.`tute_description`
    , `tute`.`publish_date`
FROM
    `seminko`.`course_has_subject_has_tute`
    INNER JOIN `seminko`.`tute` 
        ON (`course_has_subject_has_tute`.`tute_id` = `tute`.`tute_id`)
    INNER JOIN `seminko`.`course_has_subject` 
        ON (`course_has_subject_has_tute`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
    INNER JOIN `seminko`.`course` 
        ON (`course_has_subject`.`course_id` = `course`.`course_id`)
    INNER JOIN `seminko`.`subject` 
        ON (`course_has_subject`.`subject_id` = `subject`.`subject_id`)
    INNER JOIN `seminko`.`course_has_subject_has_class` 
        ON (`course_has_subject_has_class`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
    INNER JOIN `seminko`.`class` 
        ON (`course_has_subject_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`student_has_class` 
        ON (`student_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`student` 
        ON (`student_has_class`.`st_id` = `student`.`st_id`)WHERE `student`.`st_id`='$st_id' LIMIT " . $page1 . ",5";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewTuteById($tute_id) {
        global $con;
        $userQuery = "SELECT * from tute WHERE tute_id='$tute_id'";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewTuteByPage($page1) {
        global $con;
        $userQuery = "SELECT * from tute ORDER BY tute_id DESC LIMIT " . $page1 . ",5";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function updateTute($tutes_id, $path, $tute_name, $tute_chapter, $tute_description, $publish_date) {
        global $con;
        $userQuery = "UPDATE tute SET  image='$path',tute_name='$tute_name',tute_chapter='$tute_chapter',tute_description='$tute_description',publish_date='$publish_date' WHERE tute_id='$tutes_id' ";
        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteTute($tutes_id) {
        global $con;
        echo 'tute id : ' . $tutes_id;
        $userQuery = "DELETE from tute WHERE tute_id='$tutes_id'";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

}

?>