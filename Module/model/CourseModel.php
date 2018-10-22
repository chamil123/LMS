<?php

include '../database/connection.php';

class Course {

    function addCourse($course_name, $description) {
        global $con;
        $userQuery = "INSERT INTO `course` (`course_name`,`description`,`status`)VALUES (
        '$course_name',
        '$description',
        '1')";
        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateCourse($course_id, $course_name, $description) {
        global $con;


        $userQuery = "UPDATE course SET course_name='$course_name', description='$description' WHERE course_id='$course_id' ";

        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewCourse() {
        global $con;
        $userQuery = "SELECT*from course";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewCourseFP($st_id) {
        global $con;
        $userQuery = "SELECT
    `course`.`course_name`
    , `subject`.`subject`
    , `class`.`class_no`
    , `course`.`description`
FROM
    `seminko`.`student_has_class`
    INNER JOIN `seminko`.`class` 
        ON (`student_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`student` 
        ON (`student_has_class`.`st_id` = `student`.`st_id`)
    INNER JOIN `seminko`.`course_has_subject_has_class` 
        ON (`course_has_subject_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`course_has_subject` 
        ON (`course_has_subject_has_class`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
    INNER JOIN `seminko`.`course` 
        ON (`course_has_subject`.`course_id` = `course`.`course_id`)
    INNER JOIN `seminko`.`subject` 
        ON (`course_has_subject`.`subject_id` = `subject`.`subject_id`)WHERE `student`.`st_id`='$st_id'";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewCourseByPageFP($st_id, $page1) {
        global $con;
        $userQuery = "SELECT
    `course`.`course_name`
    , `subject`.`subject`
    , `class`.`class_no`
    , `course`.`description`
FROM
    `seminko`.`student_has_class`
    INNER JOIN `seminko`.`class` 
        ON (`student_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`student` 
        ON (`student_has_class`.`st_id` = `student`.`st_id`)
    INNER JOIN `seminko`.`course_has_subject_has_class` 
        ON (`course_has_subject_has_class`.`class_id` = `class`.`class_id`)
    INNER JOIN `seminko`.`course_has_subject` 
        ON (`course_has_subject_has_class`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
    INNER JOIN `seminko`.`course` 
        ON (`course_has_subject`.`course_id` = `course`.`course_id`)
    INNER JOIN `seminko`.`subject` 
        ON (`course_has_subject`.`subject_id` = `subject`.`subject_id`)WHERE `student`.`st_id`='$st_id'  LIMIT " . $page1 . ",10";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewCourseByPage($page1) {
        global $con;
        $userQuery = "SELECT * from course ORDER BY course_id DESC LIMIT " . $page1 . ",5";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewSubject() {
        global $con;
        $userQuery = "SELECT*from subject";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewCourseById($course_id) {
        global $con;
        $userQuery = "SELECT*from course WHERE course_id='$course_id'";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function deleteCourse($course_id) {
        global $con;
        $userQuery = "DELETE from course WHERE course_id='$course_id'";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

}

?>
