<?php
if (!isset($_SESSION)) {
    session_start();
}
$user_id = $_GET['user_id'];
error_reporting(E_ERROR || E_WARNING);
require './database/connection.php';
include './Module/model/UserModel.php';

$user = new User();
$resultRole = $user->getRole();

$userById = $user->getUserById($user_id);
$rowResult = mysqli_fetch_array($userById);


$resultModule = $user->getModule();

if ($_SESSION["BRANCH_CODE"] != "") {

    $branch_code = $_SESSION["BRANCH_CODE"];
    $member_branchCode = "SR" . $branch_code;
} else {
    $member_branchCode = "";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="dist/css/VikumTA.min.css">
        <link rel="stylesheet" href="dist/css/_all-skins.min.css">
        <link href="dist/css/Style.css" rel="stylesheet" type="text/css"/>


        <script src="dist/js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="dist/js/UserValidate.js" type="text/javascript"></script>

        <link href="dist/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/jquery-ui.js" type="text/javascript"></script>

         <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script>
            $(function () {
                $("#dob").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    yearRange: "-55:-16"
                });

            });

        </script>
        <script>
            function showUserName(str)
            {
                // alert("sasas");
                var xmlhttp;
                if (str == "")
                {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
                // xmlhttp.open("GET", "getUserName.php?q=" + str, true);
                xmlhttp.open("GET", "getUserName.php?uname=" + str, true);
                xmlhttp.send();
            }

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah')
                                .attr('src', e.target.result)
                                .height(200)
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {
                var result = "<?php echo $_SESSION['msgU'] ?>";

                if (result == 1) {
                    $('.success').fadeIn(500).delay(1500).fadeOut(200);
                }
                else if (result == 2) {
                    $('.failure').fadeIn(500).delay(1500).fadeOut(200);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {
                    $('.warning').fadeIn(500).delay(1500).fadeOut(200);
                    $('.warning').html('Successfully Updated record');
                }
<?php $_SESSION['msgU'] = "" ?>
            }

//            $(document).ready(function () {
//                $('#empID').change(function () {
//                    $.get('getCenterInfoAjax.php', {empId: $(this).val()}, function (data) {
//
//                        $("#centerNumber").val(data);
//                        $("#centerid").val(data);
//                    });
//                });
//            });
        </script>
        <div class="wrapper">
            <div style="height: 50px" >
                <header class="main-header effect" >
                    <a href="../../index2.html" class="logo" >
                        <span class="logo-mini" style="font-size: 12px"><b>S</b>ilver ray</span>
                        <span class="logo-lg"><b>SILVER RAY</b> </span>
                    </a>
                    <nav class="navbar navbar-static-top " role="navigation"  >
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" >
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                        </a>
                        <?php include './includes/signOut.php'; ?>
                    </nav>
                </header>
            </div>
            <?php include 'includes/navbar.php'; ?>
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Creation
                        <small>Add user</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Add user</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
                <section class="content">

                    <form class="form-horizontal" action="Module/controller/UserController.php?action=update" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Basic information</h3>
                                    </div>
                                    <div class="box-body">


                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="fname">First name :</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="fname" name="fname" value="<?= $rowResult['user_firstName'] ?>">
                                                <input type="hidden" class="form-control " id="user_id" name="user_id" value="<?= $rowResult['user_id'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="lname">Last name :</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="lname" name="lname" value="<?= $rowResult['user_lastName'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="dob">Date of birth :</label>
                                            <div class="col-sm-9">
                                                <span id="msgdob"></span>
                                                <input type="text" class="form-control required" id="dob" name="dob" value="<?= $rowResult['user_DOB'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="nic">NIC number :</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="nic" name="nic" value="<?= $rowResult['user_NIC_number'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="gender">Gender :</label>
                                            <div class="col-sm-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="male" value="male" <?php
                                                    if ($rowResult['user_gender'] == "male") {
                                                        echo "checked";
                                                    }
                                                    ?> >Male
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="female" value="female"<?php
                                                    if ($rowResult['user_gender'] == "female") {
                                                        echo "checked";
                                                    }
                                                    ?> >Female
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="uname">User name:</label>
                                            <div class="col-sm-9">
                                                <div id="txtHint"></div>
                                                <input type="text" class="form-control required" id="uname" name="uname" value="<?= $rowResult['login_userName'] ?>"  oninput ="showUserName(this.value);"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Other information</h3>
                                    </div>
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="">Phone Number :</label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control required"name="phone" id="phone" value="<?= $rowResult['user_phoneNumber'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="email">Email:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" name="email" id="email" value="<?= $rowResult['user_email'] ?>">
                                            </div>                                 
                                        </div>
                                        <div class="form-group">                               
                                            <label class="control-label col-sm-3" for="role">User role :</label>
                                            <div class="col-sm-9">
                                                <select  name="rol_id" id="role_id" class="form-control required">
                                                    <option value="">-----Plese select role----</option>
                                                    
                                                        

                                                    <?php while ($row = mysqli_fetch_array($resultRole)) { ?>

                                                        <option value="<?php echo $row['role_id']; ?>"
                                                        <?php
                                                        if ($row['role_id'] == $rowResult['role_id']) {
                                                            echo "selected";
                                                        }
                                                        ?>>
                                                                    <?php echo $row['role_name'] ?>
                                                        </option> 
                                                    <?php } ?>   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">                               
                                            <label class="control-label col-sm-3" for="address">Address :</label>
                                            <div class="col-sm-9">
                                                <textarea name="address" id="address" rows="4" class="form-control required" placeholder="Enter Address"><?= $rowResult['user_address'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">                               
                                            <label class="control-label col-sm-3" for="name">Upload image :</label>
                                            <div class="col-sm-9">
                                                <img src="Sourse Files/uploads/<?= $rowResult['user_image']; ?>" width="150px"/>
                                                <input type="file" name="user_image" id="user_image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">

                            <?php while ($row = mysqli_fetch_array($resultModule)) { ?>
                                <div class="col-md-3">
                                    <b>
                                        <label class="control-label" for=""><?= $row['module_name'] ?> </label>
                                    </b>
                                    <br/>
                                    <div class="col-lg-12 col-sm-12 col-md-12">&nbsp;</div>
                                   <?php
                                $m = $row['module_id'];
                                $resultRights = $user->viewModuleRights($m);
                                ?>
                                <?php
                                while ($rowrights = mysqli_fetch_array($resultRights)) {
                                    $number = 0;
                                    $resultRightsByuser = $user->viewAllRightsByUser($user_id);
                                    while ($rowrightsUser = mysqli_fetch_array($resultRightsByuser)) {
                                        if ($rowrights['rights_id'] == $rowrightsUser['rights_id']) {
                                            $r_id = $rowrights['rights_id'];
                                            echo "<input type='checkbox' name='user_rights[]' checked=checked value='$r_id'/>&nbsp;&nbsp;&nbsp;";
                                            echo '' . $rowrights['rights_name'] . "<br/>";
                                            $number = 1;
                                        }
                                    }
                                    if ($number == 0) {
                                        $r_id = $rowrights['rights_id'];
                                        echo "<input type='checkbox' name='user_rights[]'  value='$r_id'/>&nbsp;&nbsp;&nbsp;";
                                        echo '' . $rowrights['rights_name'] . "<br/>";
                                    }
                                    $number = 0;
                                }
                                ?>
                                    <div class="col-lg-12 col-sm-12 col-md-12">&nbsp;</div>
                                </div>
                            <?php } ?>
                        </div>
                        <input type="submit" class="btn btn-warning" value="Update User" name="AddUser"/>
                        <!-- <button type="submit" name="submit" class="btn btn-info">
                             <i class="glyphicon glyphicon-save"></i>
                             Submit</button>-->
                        <button type="reset" name="reset" class="btn btn-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                            Clear</button>
                    </form>
                </section>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="dist/js/app.min.js"></script>
        <link href="dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/datePicker/jquery-ui.js"></script>
    </body>

</html>
