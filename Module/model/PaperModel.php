<?php

include '../database/connection.php';

class Paper {

    function addPaper($paper_type_id, $paper_image, $description, $publish_date) {
        global $con;

        $userQuery = "INSERT INTO paper (paper_type_id,image,description,status,publish_date)VALUES (
        '$paper_type_id',
        '$paper_image','$description','1','$publish_date')";
        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function viewPapers() {
        global $con;
        $userQuery = "SELECT * from paper";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewPapersFP($st_id) {
        global $con;
        $userQuery = "SELECT
    `paper`.`paper_id`
    , `paper_type`.`paper_type`
    , `paper`.`image`
    , `paper`.`description`
    ,`paper`.`publish_date`
FROM
    `seminko`.`paper`
    INNER JOIN `seminko`.`paper_type` 
        ON (`paper`.`paper_type_id` = `paper_type`.`paper_type_id`)
    INNER JOIN `seminko`.`course_has_subject_has_paper` 
        ON (`course_has_subject_has_paper`.`paper_id` = `paper`.`paper_id`)
    INNER JOIN `seminko`.`course_has_subject` 
        ON (`course_has_subject_has_paper`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
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
        ON (`student_has_class`.`st_id` = `student`.`st_id`) WHERE `student`.`st_id`='$st_id'";

        $runUserQuery = mysqli_query($con, $userQuery);
        $nor = $runUserQuery->num_rows;
        $nopage = ceil($nor / 5);

        return $nopage;
    }

    function viewPapersByPageFP($st_id, $page1) {

        global $con;
        $userQuery = "SELECT
    `paper`.`paper_id`
    , `paper_type`.`paper_type`
    , `paper`.`image`
    , `paper`.`description`
    ,`paper`.`publish_date`
FROM
    `seminko`.`paper`
    INNER JOIN `seminko`.`paper_type` 
        ON (`paper`.`paper_type_id` = `paper_type`.`paper_type_id`)
    INNER JOIN `seminko`.`course_has_subject_has_paper` 
        ON (`course_has_subject_has_paper`.`paper_id` = `paper`.`paper_id`)
    INNER JOIN `seminko`.`course_has_subject` 
        ON (`course_has_subject_has_paper`.`course_has_subject_id` = `course_has_subject`.`course_has_subject_id`)
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
        ON (`student_has_class`.`st_id` = `student`.`st_id`) WHERE `student`.`st_id`='$st_id'  LIMIT " . $page1 . ",5";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewPapersByPage($page1) {
        global $con;
        $userQuery = "SELECT * from paper ORDER BY paper_id DESC LIMIT " . $page1 . ",5";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewPapersById($paper_id) {
        global $con;
        $userQuery = "SELECT * from paper WHERE paper_id='$paper_id'";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function updatePaper($paper_id, $paper_type_id, $path, $description, $publish_date) {
        global $con;


        $userQuery = "UPDATE paper SET paper_type_id='$paper_type_id', image='$path',description='$description',publish_date='$publish_date' WHERE paper_id='$paper_id' ";

        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deletePaper($paper_id) {
        global $con;
        $userQuery = "DELETE from paper WHERE paper_id='$paper_id'";

        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

}

?>