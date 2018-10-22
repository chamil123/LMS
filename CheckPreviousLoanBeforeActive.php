<?php
if (!isset($_SESSION)) {
    session_start();
}
$application_id = $_GET['application_id'];
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/ApplicationModel.php';

$application = new Application();
//$result = $application->viewAllApplications();
$result = $application->checkPreviousNotClosedLoans($application_id);
$resultMember = $application->viewMemberAllDetailsByApplicationId($application_id);

$row = mysqli_fetch_array($resultMember);

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

        <style>
            .inputColor{
                background-color: #ecf0f5;
                border-color: #ecf0f5;
            }
        </style>

        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });

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
                var url = "incompleteLoanHistory.php";
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
                            <h5 style="padding-bottom: 10px;">Can't  complete the request, Because you have incomplete previous Loans</h5>
                            <div class="row">

                                <div class="col-md-5">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-6">Member Name:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control inputColor"  i value="<?= $row['member_inital'] . "  " . $row['member_surNmae'] ?>">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-6">NIC number :</label>
                                            <div class="col-sm-6">          
                                                <input type="text" class="form-control inputColor"   value="<?= $row['member_NIC'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">        
                                            <label class="control-label col-sm-6">Date Of Birth :</label>
                                            <div class="col-sm-6">          
                                                <input type="text" class="form-control inputColor"   value="<?= $row['member_dateOfBirth'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">        
                                            <label class="control-label col-sm-6">Gender :</label>
                                            <div class="col-sm-6">          
                                                <input type="text" class="form-control inputColor"   value="<?= $row['member_gender'] ?>">
                                            </div>

                                        </div>
                                        <div class="form-group">        
                                            <label class="control-label col-sm-6" >Group number :</label>
                                            <div class="col-sm-6">          
                                                <input type="text" class="form-control inputColor"   value="<?= $row['member_group'] ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" >Mobile number:</label>
                                            <div class="col-sm-8">
                                                <input  type="text" class="form-control inputColor"  i value="<?= $row['member_mobileNumber'] ?>">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" >Home number :</label>
                                            <div class="col-sm-8">          
                                                <input type="text" class="form-control inputColor"   value="<?= $row['member_homeNumber'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">        
                                            <label class="control-label col-sm-3" >Address :</label>
                                            <div class="col-sm-8">    
                                                <textarea class="form-control inputColor" rows="5"><?= $row['member_AddressLine1'] . ",\n" . $row['member_AddressLine2'] . ",\n" . $row['member_AddressLine3'] . ",\n" . $row['member_AddressLine4'] ?></textarea>


                                            </div>
                                        </div>


                                    </form>
                                </div>

                            </div>

                            <form class="form-horizontal" action="../../controller/CenterController.php?action=add" method="POST" name="addCenter">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <table class="table table-striped" width="100%" id="customer_data">

                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Date</th>
                                                    <th>Loan Amount</th>
                                                    <th>Loan with interest</th>
                                                    <th>Loan period</th>
                                                    <th>Due amount</th>
                                                    <th>Loan Outstanding</th>
                                                    <th>Loan term</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $application_id = $row['application_id'];
                                                    $application_date = $row['application_date'];
                                                    $application_lamount = $row['application_lamount'];
                                                    $application_lamountWithInt = $row['application_lamountWithInt'];
                                                    $application_lperiod = $row['application_lperiod'];
                                                    $application_ldue = $row['application_ldue'];
                                                    $application_lterm = $row['application_lterm'];
                                                    $status = $row['application_status'];

                                                    $availableAmt = $member->availableAmount($application_id);
                                                    $rows = mysqli_fetch_array($availableAmt);
                                                    $application_payAmount = $rows['amt'];

                                                    $availableAmount = $application_lamountWithInt - $application_payAmount;
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: left;"><?php echo $application_id; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_date; ?></td>
                                                        <td style="text-align: left;font-weight: bold;color: #cc3300;font-size: 15px"><?php echo $application_lamount; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_lamountWithInt; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_lperiod; ?></td>

                                                        <td style="text-align: left;"><?php echo $application_ldue; ?></td>
                                                        <td style="text-align: left;"><?php echo $availableAmount; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_lterm; ?></td>
                                                        <td style="text-align: left;"><?php echo $status; ?></td>
                                                        <td style="text-align: left;">
                                                            <a onclick="alertFunction(<?php echo $row['application_id']; ?>)" style="color: white">  <button type="button" class="btn btn-default btn-sm " data-target="#myModal" data-toggle="modal" >
                                                                    <i class="glyphicon glyphicon-file"></i> </button>
                                                            </a>
                                                        </td>


                                                        <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

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
                <div class="modal-dialog" style="width: 50%">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Collection details</h4>
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
                "iDisplayLength": 15
            });
        });
    </script> 
</html>
