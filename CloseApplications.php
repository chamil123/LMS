<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/ApplicationModel.php';
include './includes/session_handling.php';

$application = new Application();
$result = $application->viewCloseApplications();


include 'Module/model/MemberModel.php';
$member = new Member();
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
        <script>





        </script> 

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
                var result = "<?php echo $_SESSION['msgapu'] ?>";
                if (result == 1) {
                    $('.success').fadeIn(1500).delay(1500).fadeOut(400);

                }
                else if (result == 2) {
                    $('.failure').fadeIn(1500).delay(1500).fadeOut(400);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {
                    $('.warning').fadeIn(1500).delay(1500).fadeOut(400);
                    $('.warning').html('Successfully Updated record');
                }
<?php $_SESSION['msgapu'] = "" ?>
            }

            function alertFunction(val) {
                var application_id = val;
                var request = createXMLHttpRequest();
                var url = "ViewApplicationDetails.php";
                request.open("GET", url + "?application_id=" + application_id, true);
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
                        Application Creation
                        <small>View Application</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="CreateApplication.php"></i> Add Application</a></li>
                        <li class="active">View Application</li>
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
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Code</th>
                                                    <th>Loan Amount</th>
                                                    <th>Period</th>
                                                    <th>Loan With Int</th>
                                                    <th>Due</th>
                                                    <th>Loan Term</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_SESSION["BRANCH_CODE"])) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        if ($_SESSION["BRANCH_CODE"] == $row['member_branchNumber']) {
                                                            $application_id = $row['application_id'];

                                                            $availableAmt = $member->availableAmount($row['application_id']);
                                                            $rows = mysqli_fetch_array($availableAmt);
                                                            $application_payAmount = $rows['amt'];

                                                            $application_lamountWithInt = $row['application_lamountWithInt'];
                                                            $availableAmount = $application_lamountWithInt - $application_payAmount;

                                                            $application_lamount = $row['application_lamount'];
                                                            $application_lperiod = $row['application_lperiod'];
                                                            $application_ldue = $row['application_ldue'];
                                                            $application_lterm = $row['application_lterm'];
                                                            $application_date = $row['application_activateDate'];
                                                            $member_code = $row['member_code'];
                                                            $member_inital = $row['member_inital'];
                                                            $member_surNmae = $row['member_surNmae'];
                                                            $member_id = $row['member_id'];
                                                            $status = $row['application_status'];
                                                            if ($availableAmount <= 0) {
                                                                ?>
                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $application_id; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_date; ?></td>
                                                                    <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                                    <td style="text-align: left;"><?php echo $member_code ?></td>
                                                                    <td style="text-align: left;font-weight: bold;color: #cc3300;font-size: 15px"><?php echo $application_lamount; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_lperiod; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_lamountWithInt; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_ldue; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_lterm; ?></td>

                                                                                                        <!--<td style="text-align: left;"><?php echo $availableAmount ?></td>-->
                                                                    <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
                                                                    <td style="valign:right">

                                                                        <a onclick="alertFunction(<?php echo $row['application_id']; ?>)" style="color: white">  <button type="button" class="btn btn-default btn-sm " data-target="#myModal" data-toggle="modal" >
                                                                                <i class="glyphicon glyphicon-file"></i> </button>
                                                                        </a>


                                                                        <a href="UpdateApplication.php?application_id=<?php echo $row['application_id']; ?>&member_id=<?= $member_id ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                                <i class="glyphicon glyphicon-edit"></i> </button>
                                                                        </a>


                                                                        <a href="Module/controller/AplicationController.php?application_id=<?php echo $row['application_id']; ?>&action=delete"  style="color: white">  <button type="button" class="btn btn-danger btn-sm ">
                                                                                <i class="glyphicon glyphicon-trash"></i> </button>
                                                                        </a>

                                                                        <?php if ($status == "pending") { ?>
                                                                            <a href="Module/controller/AplicationController.php?application_id=<?= $application_id; ?>&member_id=<?= $member_id; ?>&action=active"style="color: white"> <button type="button" class="btn btn-success btn-sm ">
                                                                                    Active</button>
                                                                            </a>
                                                                            <?php
                                                                        } else if ($status == "activated") {
                                                                            if ($availableAmount <= 0) {
                                                                                ?>
                                                                                <a href="Module/controller/AplicationController.php?application_id=<?= $application_id; ?>&action=close"style="color: white"> <button type="button" class="btn btn-github btn-sm ">
                                                                                        Close</button>
                                                                                </a>

                                                                            <?php } 
                                                                                ?>
                                                                              
                                                                                <?php
                                                                            
                                                                        } else if ($status == "closed") {
                                                                            ?>
                                                                            <span class="label label-danger"> Closed </span>
                                                                            <?php
                                                                        }
                                                                        ?>


                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                   $application_id = $row['application_id'];

                                                            $availableAmt = $member->availableAmount($row['application_id']);
                                                            $rows = mysqli_fetch_array($availableAmt);
                                                            $application_payAmount = $rows['amt'];

                                                            $application_lamountWithInt = $row['application_lamountWithInt'];
                                                            $availableAmount = $application_lamountWithInt - $application_payAmount;

                                                            $application_lamount = $row['application_lamount'];
                                                            $application_lperiod = $row['application_lperiod'];
                                                            $application_ldue = $row['application_ldue'];
                                                            $application_lterm = $row['application_lterm'];
                                                            $application_date = $row['application_activateDate'];
                                                            $member_code = $row['member_code'];
                                                            $member_inital = $row['member_inital'];
                                                            $member_surNmae = $row['member_surNmae'];
                                                            $member_id = $row['member_id'];
                                                            $status = $row['application_status'];
                                                            if ($availableAmount <= 0) {
                                                                ?>
                                                                <tr>
                                                                    <td style="text-align: left;"><?php echo $application_id; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_date; ?></td>
                                                                    <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                                    <td style="text-align: left;"><?php echo $member_code ?></td>
                                                                    <td style="text-align: left;font-weight: bold;color: #cc3300;font-size: 15px"><?php echo $application_lamount; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_lperiod; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_lamountWithInt; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_ldue; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_lterm; ?></td>

                                                                                                        <!--<td style="text-align: left;"><?php echo $availableAmount ?></td>-->
                                                                    <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->
                                                                    <td style="valign:right">

                                                                        <a onclick="alertFunction(<?php echo $row['application_id']; ?>)" style="color: white">  <button type="button" class="btn btn-default btn-sm " data-target="#myModal" data-toggle="modal" >
                                                                                <i class="glyphicon glyphicon-file"></i> </button>
                                                                        </a>


                                                                        <a href="UpdateApplication.php?application_id=<?php echo $row['application_id']; ?>&member_id=<?= $member_id ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                                <i class="glyphicon glyphicon-edit"></i> </button>
                                                                        </a>


                                                                        <a href="Module/controller/AplicationController.php?application_id=<?php echo $row['application_id']; ?>&action=delete"  style="color: white">  <button type="button" class="btn btn-danger btn-sm ">
                                                                                <i class="glyphicon glyphicon-trash"></i> </button>
                                                                        </a>

                                                                        <?php if ($status == "pending") { ?>
                                                                            <a href="Module/controller/AplicationController.php?application_id=<?= $application_id; ?>&member_id=<?= $member_id; ?>&action=active"style="color: white"> <button type="button" class="btn btn-success btn-sm ">
                                                                                    Active</button>
                                                                            </a>
                                                                            <?php
                                                                        } else if ($status == "activated") {
                                                                            if ($availableAmount <= 0) {
                                                                                ?>
                                                                                <a href="Module/controller/AplicationController.php?application_id=<?= $application_id; ?>&action=close"style="color: white"> <button type="button" class="btn btn-github btn-sm ">
                                                                                        Close</button>
                                                                                </a>

                                                                            <?php } 
                                                                                ?>
                                                                              
                                                                                <?php
                                                                            
                                                                        } else if ($status == "closed") {
                                                                            ?>
                                                                            <span class="label label-danger"> Closed </span>
                                                                            <?php
                                                                        }
                                                                        ?>


                                                                    </td>
                                                                </tr>

                                                                <?php
                                                            }
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
                <div class="modal-dialog" style="width: 65%">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Application details</h4>
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
