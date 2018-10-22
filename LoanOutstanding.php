<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
$serchBoxBranch = $_GET['serchBoxBranch'];
$serchBoxCenter = $_GET['serchBoxCenter'];

require_once './database/connection.php';
include 'Module/model/ReportModel.php';
include 'Module/model/MemberModel.php';
include './includes/session_handling.php';

$report = new Report();
$member = new Member();

//if ($serchBoxBranch == "" && $serchBoxCenter == "") {
//    $result = $report->viewAllApplications();
//}
 if ($serchBoxBranch != "" && $serchBoxCenter == "") {
    $result = $report->viewAllApplicationsByBranch($serchBoxBranch);
} else if ($serchBoxBranch == "" && $serchBoxCenter != "") {
    $result = $report->viewAllApplicationsByCenter($serchBoxCenter);
} else if ($serchBoxBranch != "" && $serchBoxCenter != "") {
    $result = $report->viewAllApplicationsByCenterAndBranch($serchBoxBranch, $serchBoxCenter);
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

        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>



        <script src="dist/js/app.min.js"></script>
 <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script>
            $(function () {
                $("#from_date").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                });
                $("#to_date").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                });
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
                var result = "<?php echo $_SESSION['msga'] ?>";
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
                        Report
                        <small>Loan Outstanding report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">loan outstanding report</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Process has been Successfully Done</div>
                <div class="alert alert-box failure " style="margin: 0px 15px 10px 15px"></div>
                <div class="alert alert-box warning " style="margin: 0px 15px 10px 15px"></div>
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="box box-default">
                                <div class="box-body">

                                    <div class="col-md-8 col-md-offset-4" style="padding-bottom: 10px;">
                                        <form class="form-horizontal pull-right" action="Module/controller/ReportController.php?action=search" method="POST" name="addCenter" >
                                            <div class="col-md-5" style="margin-right: -10px">
                                                <input type="text" name="serchBoxBranch" id="serchBox" class=" form-control " placeholder="Branch ID" value="<?= $serchBoxBranch ?>"/> 
                                            </div>
                                            <div class="col-md-5" style="margin-right: -10px">
                                                <input type="text" name="serchBoxCenter" id="serchBox" class=" form-control " placeholder="Center ID" value="<?= $serchBoxCenter ?>"/> 
                                            </div>
                                            <!--                                            <div class="col-md-3" style="margin-right: -10px">
                                                                                            <input type="text" name="from_date" id="from_date" class=" form-control " placeholder="From date" value="<?= $from_date ?>"/> 
                                                                                        </div>
                                                                                        <div class="col-md-3" style="margin-right: -10px">
                                                                                            <input type="text" name="to_date" id="to_date" class=" form-control " placeholder="To date" value="<?= $to_date ?>"/> 
                                                                                        </div>-->
                                            <div class="col-md-2" style="margin-right: -10px">
                                                <button type="submit" class="btn btn-primary" name="searchLoanOutstanding">
                                                    <span class="glyphicon glyphicon-search"></span> Search
                                                </button>
                                            </div>


                                        </form>
                                    </div>

                                    <div id="employee_table" >
                                        <table class="table table-striped" width="100%">

                                            <tbody>
                                                <tr style="font-size: 13px">
                                                    <th>Center</th>
                                                    <th>Client code</th>
                                                    <th>Member No</th>
                                                    <th>Name</th>
                                                    <th>Loan date</th>
                                                    <th>Loan amount</th>
                                                    <th>Total amount</th>
                                                    <th>Total Paid</th>
                                                    <th>Amount to be collect</th>

                                                </tr>
                                                <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $resultDailCollectionTot = $member->availableAmount($row['application_id']);
                                                    $rowDCT = mysqli_fetch_assoc($resultDailCollectionTot);
                                                    $totalPaid = $rowDCT['amt'];
                                                    $amtToBeClt = $row['application_lamountWithInt'] - $totalPaid;
                                                    ?>
                                                    <tr >
                                                        <td style="text-align: left;"><?php echo $row['center_name']; ?></td>
                                                        <td style="text-align: left;"><?php echo $row['member_code']; ?></td>
                                                        <td style="text-align: left;"><?php echo $row['member_number']; ?></td>
                                                        <td style="text-align: left;"><?php echo $row['member_inital'] . " " . $row['member_surNmae']; ?></td>
                                                        <td style="text-align: left;"><?php echo $row['application_date']; ?></td>

                                                        <td style="text-align: left;"><?php echo $row['application_lamount']; ?></td>
                                                        <td style="text-align: left;"><?php echo $row['application_lamountWithInt']; ?></td>
                                                        <td style="text-align: left;"><?php echo $totalPaid ?></td>
                                                        <td style="text-align: left;"><?php echo $amtToBeClt; ?></td>
                                                        <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

                                                    </tr>

                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>


                            </div> 
                            <a href="Module/controller/ReportController.php?serchBoxBranch=<?php echo $serchBoxBranch; ?>&serchBoxCenter=<?= $serchBoxCenter ?>&searchCombo=<?= $searchCombo ?>&action=LoanOutstandingexcel"  style="color: white">  <button type="button" class="btn btn-warning">
                                    <i class="fas fa-file-excel" style="margin-right: 5px;"></i> Download Excel File</button>
                            </a>

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
        <link href="dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/datePicker/jquery-ui.js"></script>
    </body>

</html>
