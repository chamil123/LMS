<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once'./database/connection.php';
include 'Module/model/UserModel.php';
include 'Module/model/MemberModel.php';

$user = new User();
$member = new Member();
$result = $user->viewAllUsers();
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

        <link href="dist/css/Style.css" rel="stylesheet" type="text/css"/>



        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="dist/js/UserValidate.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <script src="dist/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="dist/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="dist/js/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <script src="dist/js/app.min.js"></script>

        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        <script type="text/javascript">

            function createXMLHttpRequest()
            {
                var xmlhttp;
                if (window.XMLHttpRequest)
                {
                    xmlhttp = new XMLHttpRequest();
                } else
                {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                return xmlhttp;
            }
        </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {

                var result = "<?php echo $_SESSION['msgd'] ?>";

                if (result == 1) {
                    $('.success').fadeIn(500).delay(1800).fadeOut(400);
                }
                else if (result == 2) {
                    $('.failure').fadeIn(500).delay(1800).fadeOut(400);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {

                    $('.warning').fadeIn(500).delay(1800).fadeOut(400);
                    $('.warning').html('Successfully Updated record');
                }
<?php $_SESSION['msgd'] = "" ?>
            }
            function alertFunction(val) {

                var userid = val;

                var request = createXMLHttpRequest();
                var url = "ViewUserDetails.php";
                request.open("GET", url + "?user_id=" + userid, true);
                request.send();
                request.onreadystatechange = function () {
                    // alert("sdasdasdasda");
                    if (request.readyState == 4) {
                        if (request.status == 200) {
                            var data = request.responseText;
                            //alert(data);
                            document.getElementById("div").innerHTML = data;
                        }
                    }
                }
            }
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
                        User
                        <small>View Users</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i>Home</a></li>
                        <li><a href="AddUser.php"></i> Add User</a></li>
                        <li class="active">View Users</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Process has been Successfully Done</div>
                <div class="alert alert-box failure " style="margin: 0px 15px 10px 15px"></div>
                <div class="alert alert-box warning " style="margin: 0px 15px 10px 15px"></div>
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="../../controller/CenterController.php?action=add" method="POST" name="addCenter">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <table class="table table-striped" width="100%" id="customer_data">

                                            <thead>
                                                <tr>
                                                    <th>&nbsp;Id&nbsp;</th>
                                                    <th>Name&nbsp;</th>
                                                    <th>Email&nbsp;</th>
                                                    <th> NIC nuber&nbsp;</th>
                                                    <th>Date of birth&nbsp;</th>
                                                    <th>Gender&nbsp;</th>
                                                    <th>Address&nbsp;</th>
                                                    <th>Actions&nbsp;</th>

                                                    <!--<th>Action&nbsp;</th>-->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                while ($row = mysqli_fetch_array($result)) {

                                                    $user_id = $row['user_id'];
                                                    $user_firstName = $row['user_firstName'] . "   " . $row['user_lastName'];
                                                    $user_email = $row['user_email'];
                                                    $user_NIC_number = $row['user_NIC_number'];
                                                    $user_DOB = $row['user_DOB'];
                                                    $user_gender = $row['user_gender'];
                                                    $user_address = $row['user_address'];
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: left;"><?php echo $user_id; ?></td>
                                                        <td style="text-align: left;"><?php echo $user_firstName; ?></td>
                                                        <td style="text-align: left;"><?php echo $user_email ?></td>
                                                        <td style="text-align: left;"><?php echo $user_NIC_number; ?></td>
                                                        <td style="text-align: left;"><?php echo $user_DOB; ?></td>
                                                        <td style="text-align: left;"><?php echo $user_gender; ?></td>
                                                        <td style="text-align: left;"><?php echo $user_address; ?></td>
                                                        <td class="pull-right">

                                                            <?php
                                                            $resultPermision = $member->getPermission($_SESSION['user_id']);
                                                            while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                if ($rowe['rights_name'] == "View User") {
                                                                    ?>
                                                                    <a onclick="alertFunction(<?php echo $user_id; ?>)" style="color: white">  <button type="button" class="btn btn-default btn-sm " data-target="#myModal" data-toggle="modal" >
                                                                            <i class="glyphicon glyphicon-file"></i> </button>
                                                                    </a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            $resultPermision = $member->getPermission($_SESSION['user_id']);
                                                            while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                if ($rowe['rights_name'] == "Update User") {
                                                                    ?>
                                                                    <a href="UpdateUser.php?user_id=<?php echo $row['user_id']; ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                            <i class="glyphicon glyphicon-edit"></i> </button>
                                                                    </a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            $resultPermision = $member->getPermission($_SESSION['user_id']);
                                                            while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                if ($rowe['rights_name'] == "Delete User") {
                                                                    ?>
                                                                    <a href="Module/controller/UserController.php?user_id=<?php echo $row['user_id']; ?>&action=delete"  style="color: white">  <button type="button" class="btn btn-danger btn-sm ">
                                                                            <i class="glyphicon glyphicon-trash"></i> </button>
                                                                    </a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>


                                                            <?php
//                                                                }
//                                                            }
                                                            ?>

                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Modal -->
            <div class="modal fade " id="myModal" role="dialog" >
                <div class="modal-dialog" style="width: 70%">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">User details</h4>
                        </div>
                        <div class="modal-body">
                            <div id="div" style="font-size: 13px;align-content: flex-start"></div> <!--Here Will show the Data-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>



    </body>
    <script>
        $(document).ready(function () {
            $('#customer_data').DataTable({
                "aLengthMenu": [[3, 5, 10, 15, 20], [3, 5, 10, 15, 20]],
                "iDisplayLength": 10,
                 "order": [[0, "desc"]]
            });
        });
    </script> 

</html>
