<?php

include '../database/connection.php';
//require_once 'validation.php';

class StudentModel {

    private $stundet_id = null;

    public function createAccount($st_name, $st_email, $st_contact, $st_parent_contact, $st_parent_name, $st_username, $st_password, $st_confirm_password) {

        global $con;

        if ($this->userAvailability($st_username)) {

            if ($st_password == $st_confirm_password) {

                if (valid::validNumbersOnly($st_contact) && valid::validNumbersOnly($st_parent_contact) && valid::validEmail($st_email) && valid::validPassword($st_password) && valid::validPassword($st_confirm_password)) {

                    $this->stundet_id = $this->insertStudent($st_name, $st_email, $st_contact, $st_parent_contact, $st_parent_name);
                    if ($this->stundet_id != null) {
                        if ($this->insertUser($this->stundet_id, $st_name, $st_username, $this->encriptPassword($st_password))) {


                            $_SESSION['msg-type'] = "1";
                            $_SESSION['msg'] = 'Student Account has been Successfully Created';
                            header('location:http://localhost/Seminko/login-register.php');
                        } else {
                            $_SESSION['msg-type'] = "2";
                            $_SESSION['msg'] = 'Unable to create User Account';
                            header('location:http://localhost/Seminko/login-register.php');
                        }
                    } else {
                        $_SESSION['msg-type'] = "2";
                        $_SESSION['msg'] = 'Unable to create User Account';
                        header('location:http://localhost/Seminko/login-register.php');
                    }
                } else {
                    $_SESSION['msg-type'] = "2";
                    $_SESSION['msg'] = 'Incorrect Data found,Please enter valid data';
                    header('location:http://localhost/Seminko/login-register.php');
                }
            } else {
                $_SESSION['msg-type'] = "2";
                $_SESSION['msg'] = 'Passsword does not match,Please enter valid password';
                header('location:http://localhost/Seminko/login-register.php');
            }
        }
    }

    private function encriptPassword($st_password) {
        return valid::encryptIt($st_password);
    }

    private function userAvailability($st_username) {
        global $con;
        $validateUsername = "SELECT * FROM `user` WHERE user.`username`='$st_username'";
        $runvValidateUsername = mysqli_query($con, $validateUsername);
        if (mysqli_num_rows($runvValidateUsername) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function insertStudent($st_name, $st_email, $st_contact, $st_parent_contact, $st_parent_name) {
        global $con;
        $studentQuery = "INSERT INTO `student`
            (
             `st_name`,
             `st_email`,
             `st_contact`,
             `st_parent_contact`,
             `st_parent_name`,
             `status`)
VALUES (
        '$st_name',
        '$st_email',
        '$st_contact',
        '$st_parent_contact',
        '$st_parent_name',
        '1')";
        $runStudentQuery = mysqli_query($con, $studentQuery);
        if ($runStudentQuery) {
            return $con->insert_id;
        } else {
            echo 'Error';
        }
    }

    private function insertUser($st_id, $st_name, $st_username, $st_password) {
        global $con;
        $userQuery = "INSERT INTO `user`
            (
             `st_id`,
             `name`,
             `username`,
             `password`,
             `status`)
VALUES (
        '$st_id',
        '$st_name',
        '$st_username',
        '$st_password',
        '1')";
        $runUserQuery = mysqli_query($con, $userQuery);
        if ($runUserQuery) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function StudentLogin($username, $password) {
        global $con;
        $converted_pass = valid::encryptIt($password);
        if (valid::valiedLettersAndSpace($username) && valid::validPassword($password)) {
            $StudentUsername = "SELECT * FROM user WHERE username='$username'";
            $data = mysqli_query($con, $StudentUsername);
            if (mysqli_num_rows($data) > 0) {
                if ($row = mysqli_fetch_assoc($data)) {

                    if ($converted_pass == $row['password']) {
                        $_SESSION['loggedUser'] = $row['st_id'];
                        $_SESSION['loggedUserName'] = $row['name'];

                        header('location:http://localhost/Seminko/index-02.php');
                    } else {
                        $_SESSION['msg-type'] = "2";
                        $_SESSION['msg'] = 'Invalid Username or Password';
                        header('location:http://localhost/Seminko/login-register.php');
                    }
                }
            } else {
                $_SESSION['msg-type'] = "2";
                $_SESSION['msg'] = 'Invalid Username or Password';
                header('location:http://localhost/Seminko/login-register.php');
            }
        } else {
            $_SESSION['msg-type'] = "2";
            $_SESSION['msg'] = 'Invalid Username or Password';
            header('location:http://localhost/Seminko/login-register.php');
        }
    }

    function viewStudentFP() {
        echo 'dddddddddddddddddd';
        
        global $con;
        $userQuery = "SELECT
    `student`.`st_name`
    , `student`.`st_email`
    , `student`.`st_contact`
    , `student`.`st_parent_name`
    , `student`.`st_parent_contact`
    , `user`.`username`
    , `user`.`password`
    , `student`.`regDate`
    , `user`.`status`
    , `user`.`user_id`
FROM
    `user`
    INNER JOIN `seminko`.`student` 
        ON (`user`.`st_id` = `student`.`st_id`);";
         $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    function viewStudentByPageFP($page1) {

        global $con;
        $userQuery = "SELECT
    `student`.`st_name`
    , `student`.`st_email`
    , `student`.`st_contact`
    , `student`.`st_parent_name`
    , `student`.`st_parent_contact`
    , `user`.`username`
    , `user`.`password`
    , `student`.`regDate`
    , `user`.`status`
    , `user`.`user_id`
FROM
    `user`
    INNER JOIN `seminko`.`student` 
        ON (`user`.`st_id` = `student`.`st_id`) LIMIT " . $page1 . ",3";
        $runUserQuery = mysqli_query($con, $userQuery);
        return $runUserQuery;
    }

    public function viewStudentDetails($st_id) {
        global $con;
        $query = "SELECT
    `student`.`st_name`
    , `student`.`st_email`
    , `student`.`st_contact`
    , `student`.`st_parent_contact`
    , `student`.`st_parent_name`
    , `user`.`username`
    , `user`.`password`
    , `user`.`user_id`
FROM
    `user`
    INNER JOIN `student` 
        ON (`user`.`st_id` = `student`.`st_id`) WHERE `student`.`st_id`='$st_id'";

        return mysqli_query($con, $query);
    }

    public function updateStudentDetails($st_id, $st_name, $st_email, $st_contact, $st_parent_contact, $st_parent_name) {
        global $con;
        $query = "UPDATE student SET st_name='$st_name',st_email='$st_email',st_contact='$st_contact',st_parent_contact='$st_parent_contact',st_parent_name='$st_parent_name' WHERE st_id='$st_id'";
        $run = mysqli_query($con, $query);
        if ($run) {
            $query2 = "UPDATE user SET name='$st_name' WHERE st_id='$st_id'";
            $run2 = mysqli_query($con, $query2);
            if ($run2) {
                $_SESSION['msg-type'] = "1";
                $_SESSION['msg'] = 'Student Profile has been Successfully Updated';
                header('location:../UserProfile.php');
            } else {
                $_SESSION['msg-type'] = "2";
                $_SESSION['msg'] = 'Unable to Update Student Details,Please check the submited Data';
                header('location:../UserProfile.php');
            }
        } else {
            $_SESSION['msg-type'] = "2";
            $_SESSION['msg'] = 'Unable to Update Student Details,Please check the submited Data';
            header('location:../UserProfile.php');
        }
    }

    public function updateUserDetails($st_id, $username, $password) {
        global $con;
        $converted_pass = valid::encryptIt($password);
        $query = "UPDATE user SET username='$username',password='$converted_pass' WHERE st_id='$st_id'";
        $run = mysqli_query($con, $query);
        if ($run) {
            $_SESSION['msg-type'] = "1";
            $_SESSION['msg'] = 'User Login Information have been Successfully Updated';
            header('location:../UserProfile.php');
        } else {
            $_SESSION['msg-type'] = "2";
            $_SESSION['msg'] = 'Unable to Update Login Details,Please check the submited Data';
            header('location:../UserProfile.php');
        }
    }

    public function viewArticles($st_id) {
        global $con;
        $query = "SELECT * FROM article";
        $run = mysqli_query($con, $query);
        if (mysqli_num_rows($run) > 0) {
            $list = "";
            while ($row = mysqli_fetch_array($run)) {
                $article_id = $row['article_id'];
                $article_image = $row['article_image'];
                $article_flash = $row['article_flash'];
                $article_topic = $row['article_topic'];
                $article_description = $row['description'];

                $list.="<tr>";
                $list.="<td>$article_id</td";
                $list.="<td><img src='$article_image' width='100px;' height='100px;'></td";
                $list.="<td><img src='$article_flash' width='100px;' height='100px;'></td";
                $list.="<td>$article_topic</td";
                $list.="<td>$article_description</td";
                $list.="</tr>";
            }
            return $list;
        }
    }

    public function changeUserStatus($uid, $status) {
        echo $uid . " " . $status;
        global $con;
        if ($status == "1") {
            $status = "0";
        } else if ($status == "0") {
            $status = "1";
        }
//        echo $status;
        $query = "UPDATE `user` SET `status` = '$status' WHERE `user_id` = '$uid'";
        $run = mysqli_query($con, $query);
        if ($run) {
            $_SESSION['msg-type'] = "1";
            $_SESSION['msg'] = 'User Status has been Successfully Updated';
            header('location:../UserManagement.php');
        } else {
            $_SESSION['msg-type'] = "2";
            $_SESSION['msg'] = 'Unable to Update User Status';
            header('location:../UserManagement.php');
        }
    }

}

?>