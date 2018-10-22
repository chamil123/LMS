<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/MemberModel.php';
$member = new Member();
$result = $member->viewAllMembers();
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

        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <script src="dist/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="dist/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="dist/js/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <script src="dist/js/app.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--        <script>
   $(document).ready(function () {
       $('#example').DataTable();
   });

</script> -->

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
                var result = "<?php echo $_SESSION['msga'] ?>";
                if (result == 1) {
                    $('.success').fadeIn(1500).delay(1500).fadeOut(400);

                }
                else if (result == 2) {
                    $('.failure').fadeIn(1500).delay(1500).fadeOut(400);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {
                    swal("Good job!", "Successfuly Updated!", "success");
                    //  $('.warning').fadeIn(1500).delay(1500).fadeOut(400);
                    //  $('.warning').html('Successfully Updated record');
                }
<?php $_SESSION['msga'] = "" ?>
            }

            function alertFunction(val) {
                var memberid = val;
                var request = createXMLHttpRequest();
                var url = "ViewMemberDetails.php";
                request.open("GET", url + "?member_id=" + memberid, true);
                request.send();
                request.onreadystatechange = function () {
                    // alert("sdasdasdasda");
                    if (request.readyState == 4) {
                        if (request.status == 200) {
                            var data = request.responseText;
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
                        Member Creation
                        <small>View members</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="AddMember.php"></i> Add Member</a></li>
                        <li class="active">View Members</li>
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
                                                    <th>Id</th>
                                                    <th>Member Number&nbsp;</th>
                                                    <th>Name&nbsp;</th>
                                                    <th> NIC&nbsp;</th>
                                                    <!--<th>Gender&nbsp;</th>-->
                                                    <th>Mobile &nbsp;</th>
                                                    <th>Center&nbsp;</th>
                                                    <th>Branch&nbsp;</th>
                                                    <th>Group&nbsp;</th>
                                                    <th>Action&nbsp;</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                if (isset($_SESSION["BRANCH_CODE"])) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        if ($_SESSION["BRANCH_CODE"] == $row['member_branchNumber']) {
                                                            $member_id = $row['member_id'];
                                                            $member_number = $row['member_number'];
                                                            $member_inital = $row['member_inital'];
                                                            $member_surNmae = $row['member_surNmae'];
                                                            $member_NIC = $row['member_NIC'];
                                                            $member_gender = $row['member_gender'];
                                                            $member_mobileNumber = $row['member_mobileNumber'];
                                                            $center = $row['center_name'];
                                                            $branch_name = $row['branch_name'];
                                                            $group = $row['member_group'];
                                                            $status = $row['member_status'];
                                                            ?>
                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $member_id; ?></td>
                                                                <td style="text-align: left;"><?php echo $member_number; ?></td>
                                                                <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                                <td style="text-align: left;"><?php echo $member_NIC; ?></td>
                                                                <!--<td style="text-align: left;"><?php echo $member_gender; ?></td>-->
                                                                <td style="text-align: left;"><?php echo $member_mobileNumber; ?></td>
                                                                <td style="text-align: left;"><?php echo $center; ?></td>
                                                                <td style="text-align: left;"><?php echo $branch_name; ?></td>
                                                                <td style="text-align: left;"><?php echo $group; ?></td>
                                                                <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
                                                                <td style="valign:right">
                                                                    <?php
                                                                    $resultPermision = $member->getPermission($_SESSION['user_id']);
                                                                    while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                        if ($rowe['rights_name'] == "View member") {
                                                                            ?>
                                                                            <a onclick="alertFunction(<?php echo $row['member_id']; ?>)" style="color: white">  <button type="button" class="btn btn-default btn-sm " data-target="#myModal" data-toggle="modal" >
                                                                                    <i class="glyphicon glyphicon-file"></i> </button>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    $resultPermision = $member->getPermission($_SESSION['user_id']);
                                                                    while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                        if ($rowe['rights_name'] == "Update member") {
                                                                            ?>
                                                                            <a href="UpdateMember.php?member_id=<?php echo $row['member_id']; ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                                    <i class="glyphicon glyphicon-edit"></i> </button>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if ($_SESSION['role_id'] == 1) {
                                                                        if ($status == "Active") {
                                                                            ?>
                                                                            <a href="Module/controller/MemberController.php?member_id=<?= $member_id; ?>&action=deactivate"style="color: white"> <button type="button" class="btn btn-github btn-sm ">
                                                                                    deactivate</button>
                                                                            </a>
                                                                        <?php } else if ($status == "Deactive") { ?>
                                                                            <a href="Module/controller/MemberController.php?member_id=<?= $member_id; ?>&action=activate"style="color: white"> <button type="button" class="btn btn-danger btn-sm ">
                                                                                    Activate</button>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $member_id = $row['member_id'];
                                                        $member_number = $row['member_number'];
                                                        $member_inital = $row['member_inital'];
                                                        $member_surNmae = $row['member_surNmae'];
                                                        $member_NIC = $row['member_NIC'];
                                                        $member_gender = $row['member_gender'];
                                                        $member_mobileNumber = $row['member_mobileNumber'];
                                                        $center = $row['center_name'];
                                                        $branch_name = $row['branch_name'];
                                                        $group = $row['member_group'];
                                                        $status = $row['member_status'];
                                                        ?>
                                                        <tr>
                                                            <td style="text-align: left;"><?php echo $member_id; ?></td>
                                                            <td style="text-align: left;"><?php echo $member_number; ?></td>
                                                            <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                            <td style="text-align: left;"><?php echo $member_NIC; ?></td>
                                                            <!--<td style="text-align: left;"><?php echo $member_gender; ?></td>-->
                                                            <td style="text-align: left;"><?php echo $member_mobileNumber; ?></td>
                                                            <td style="text-align: left;"><?php echo $center; ?></td>
                                                            <td style="text-align: left;"><?php echo $branch_name; ?></td>
                                                            <td style="text-align: left;"><?php echo $group; ?></td>
                                                            <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
                                                            <td style="valign:right">
                                                                <?php
                                                                $resultPermision = $member->getPermission($_SESSION['user_id']);
                                                                while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                    if ($rowe['rights_name'] == "View member") {
                                                                        ?>
                                                                        <a onclick="alertFunction(<?php echo $row['member_id']; ?>)" style="color: white">  <button type="button" class="btn btn-default btn-sm " data-target="#myModal" data-toggle="modal" >
                                                                                <i class="glyphicon glyphicon-file"></i> </button>
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <?php
                                                                $resultPermision = $member->getPermission($_SESSION['user_id']);
                                                                while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                    if ($rowe['rights_name'] == "Update member") {
                                                                        ?>
                                                                        <a href="UpdateMember.php?member_id=<?php echo $row['member_id']; ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                                <i class="glyphicon glyphicon-edit"></i> </button>
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($_SESSION['role_id'] == 1) {
                                                                    if ($status == "Active") {
                                                                        ?>
                                                                        <a href="Module/controller/MemberController.php?member_id=<?= $member_id; ?>&action=deactivate"style="color: white"> <button type="button" class="btn btn-github btn-sm ">
                                                                                deactivate</button>
                                                                        </a>
                                                                    <?php } else if ($status == "Deactive") { ?>
                                                                        <a href="Module/controller/MemberController.php?member_id=<?= $member_id; ?>&action=activate"style="color: white"> <button type="button" class="btn btn-danger btn-sm ">
                                                                                Activate</button>
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                    }
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
                <div class="modal-dialog" style="width: 60%">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
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
                "iDisplayLength": 15,
                "order": [[0, "desc"]]
            });
        });
    </script> 
</html>
