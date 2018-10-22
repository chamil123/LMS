<?php
session_start();
require '../model/CourseModel.php';

$courseModel = new Course();

if (isset($_POST['course_data_packaet'])) {
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];


   $result = $courseModel->addCourse($course_name, $description);
      if($result>0){
         $_SESSION['msgc']=1;
     }
    header("Location:../AddCourse.php");
}
if (isset($_POST['Update_course_data_packaet'])) {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];


     $result = $courseModel->updateCourse($course_id,$course_name, $description);
      if($result>0){
         $_SESSION['msgc']=3;
     }
    header("Location:../ViewAdminCourse.php");
}
$action = $_GET['action'];

if ($action == "delete") {
    $course_id = $_GET['course_id'];
    
     $result = $courseModel->deleteCourse($course_id);
     if($result>0){
         $_SESSION['msgc']=2;
     }
  
    header("Location:../ViewAdminCourse.php");
}
?>

