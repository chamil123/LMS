<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
$member_AnyNumber = $_GET['member_AnyNumber'];

require './database/connection.php';
include './includes/session_handling.php';
$branch_id = $_SESSION["BRANCH_CODE"];
include './Module/model/LedgerReportModel.php';
include './Module/model/DailyCollectionModel.php';

$ledger = new LedgerReport();
$result = $ledger->ViewMemberByMemberNum($member_AnyNumber);

$row = mysqli_fetch_assoc($result);
$resultApp = $ledger->viewAllApplicationByMember_id($row['member_id']);

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

        <script src="dist/js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <!--<script src="dist/js/ApplicationValidate.js" type="text/javascript"></script>-->

        <link href="dist/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/jquery-ui.js" type="text/javascript"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        <script src="plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>


        <style>
            .right_text{
                text-align: right;
            }
            .add-on .input-group-btn > .btn {
                border-left-width:0;left:-2px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            }
            /* stop the glowing blue shadow */
            .add-on .form-control:focus {
                box-shadow:none;
                -webkit-box-shadow:none; 
                border-color:#cccccc; 
            }s
        </style>
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
          <script type="text/javascript">
     
            function alertFunction(val) {
   
                var application_id = val;
                
                var request = createXMLHttpRequest();
                var url = "LedgerReportDetails.php";
                request.open("GET", url + "?application_id=" + application_id+"&member_AnyNumber=<?php echo $member_AnyNumber?>", true);
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
        <script>

            var Member = [
            ];
            var Application = [
            ];

            $(document).on("ready", function () {
                loadData();
                loadChart();
            });
            //var member_group;
            var loadData = function () {
                $.ajax({
                    type: 'POST',
                    url: "getAllMemberAjaxForLedger.php?branch_id=<?php echo $branch_id ?>"

                }).done(function (data) {
//                    alert(data);
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        member_number = pro[i].member_number;
                        member_NIC = pro[i].member_NIC;


                        Member.push({"label": member_number, "member_NIC": member_NIC});
                    }
                });
            }
            var loadChart = function () {
                $.ajax({
                    type: 'POST',
                    url: "getLoanValusForLedgerCharts?member_id=<?php echo $row['member_id'] ?>"

                }).done(function (data) {
                   
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        application_date = pro[i].application_date;
                        application_lamount = pro[i].application_lamount;
                        application_lamountWithInt = pro[i].amt;
                 
                        Application.push({"application_date": application_date, "application_lamount": application_lamount, "application_lamountWithInt": application_lamountWithInt});
                    }
                });
            }

            $(document).ready(function () {
                $("#member_AnyNumber").autocomplete({source: Member, select: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                    }});
            });
            function zeroPad(num, places) {
                var zero = places - num.toString().length + 1;
                return Array(+(zero > 0 && zero)).join("0") + num;
            }

        </script>
        <script>
            var chart;

            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = Application;
                chart.categoryField = "application_date";
                chart.startDuration = 1;
                chart.plotAreaBorderColor = "#DADADA";
                chart.plotAreaBorderAlpha = 1;
                // this single line makes the chart a bar chart
                chart.rotate = false;

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;

                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0.1;
                valueAxis.position = "left";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Loan amount";
                graph1.valueField = "application_lamount";
                graph1.balloonText = "Loan Amount:[[value]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "#ADD981";
                graph1.fillAlphas = 1;
                chart.addGraph(graph1);

                // second graph
                var graph2 = new AmCharts.AmGraph();
                graph2.type = "column";
                graph2.title = "Loan Outstanding";
                graph2.valueField = "application_lamountWithInt";
                graph2.balloonText = "application_lamountWithInt:[[value]]";
                graph2.lineAlpha = 0;
                graph2.fillColors = "#ff9e01";
                graph2.fillAlphas = 1;
                chart.addGraph(graph2);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";

                // WRITE
                chart.write("chartdiv");
            });
        </script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {
                var result = "<?php echo $_SESSION['msgap'] ?>";

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
<?php $_SESSION['msgap'] = "" ?>
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
                        <small>Ledger report</small>
                    </h1>
                     <ol class="breadcrumb">
                        <li><a href="Dashboard.php"> <i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">ledger report</li>
                    </ol>
                </section>
                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
                <section class="content">

                    <form class="form-horizontal"  name="frm" id="frm" action="Module/controller/LedgerReportController.php?action=Ledgersearch"  method="POST" enctype="multiform/form-data">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Basic information</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->

                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="nic" class="col-sm-4 control-label">Number</label>
                                            <div class="col-sm-8">
                                                <div class="input-group add-on">
                                                    <input type="text" class="form-control" placeholder="Client Code/ Member Number/ ID Number" name="member_AnyNumber" id="member_AnyNumber"  value="<?= $member_AnyNumber; ?>">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                                    </div>
                                                </div>
    <!--                                                <input type="text" class="form-control required" id="member_nic" name="member_nic" placeholder="NIC number" >
                                                    <input type="hidden" class="form-control" id="member_id" name="member_id">-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Member name:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="member_name" name="member_name" placeholder="Member name" value="<?= $row['member_inital'] . " " . $row['member_surNmae'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label">Member Number :</label>
                                            <div class="col-sm-8">
                                                <input  type="text"  class="form-control required" name="member_number" id="member_number"  value="<?= $row['member_number']; ?>">
                                                <span id="msglamount"  style="color: #ff0000"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label">NIC Number :</label>
                                            <div class="col-sm-8">
                                                <input  type="text"  class="form-control required" name="member_NIC" id="member_NIC"  value="<?= $row['member_NIC']; ?>">
                                                <span id="msglamount"  style="color: #ff0000"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label">Center name :</label>
                                            <div class="col-sm-8">
                                                <input  type="text"  class="form-control required" name="member_center" id="member_center"  value="<?= $row['center_name']; ?>">
                                                <span id="msglamount"  style="color: #ff0000"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label"> Contacts:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="member_contact" name="member_contact"  value="<?= $row['member_mobileNumber']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Address :</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" cols="35" rows="3" name="member_address" id="member_address"><?= $row['member_AddressLine1'] . "\n" . $row['member_AddressLine2'] . "\n" . $row['member_AddressLine3'] . "\n" . $row['member_AddressLine4']; ?></textarea>

                                            </div>                
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <section class="col-lg-6 connectedSortable">
                                <!-- Custom tabs (Charts with tabs)-->
                                <div class="nav-tabs-custom">
                                    <!-- Tabs within a box -->
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>

                                        <li class="pull-left header"><i class="fa fa-inbox"></i> Sample chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <!-- Morris chart - Sales -->

                                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 390px">
                                            <div id="chartdiv" style="width:100%; height:380px;;margin-bottom:  20px"></div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                            <div class="col-md-12">

                                <div class="box box-default">


                                    <div class="box-body">

                                        <table class="table table-striped" width="100%" id="customer_data">

                                            <thead>
                                                <tr>
                                                    <th>&nbsp;Id&nbsp;</th>
                                                    <th>Loan Date&nbsp;</th>
                                                    <th>Loan Amount&nbsp;</th>
                                                    <th> Period&nbsp;</th>
                                                    <th>Loan Active date&nbsp;</th>
                                                    <th>Status&nbsp;</th>
                                                    <th class="pull-right">Actions&nbsp;</th>

                                                    <!--<th>Action&nbsp;</th>-->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                while ($row = mysqli_fetch_array($resultApp)) {

                                                    $app_id = $row['application_id'];
                                                    $loan_date = $row['application_date'];
                                                    $loanAmount = $row['application_lamount'];
                                                    $loanPeriod = $row['application_lperiod'];
                                                    $application_activateDate = $row['application_activateDate'];

                                                    $application_status = $row['application_status'];
                                                    ?>
                                                    <tr <?php if ($application_status == "activated") { ?>
                                                            Style=" background-color: #d6e9c6;"
                                                        <?php } else if ($application_status == "closed") { ?>
                                                            Style=" background-color: #ffe6e6;" 
                                                        <?php } ?>>
                                                        <td style="text-align: left;"><?php echo $app_id; ?></td>
                                                        <td style="text-align: left;"><?php echo $loan_date; ?></td>
                                                        <td style="text-align: left;"><?php echo $loanAmount ?></td>
                                                        <td style="text-align: left;"><?php echo $loanPeriod; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_activateDate; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_status; ?></td>

                                                        <td class="pull-right">
                                                            <a onclick="alertFunction(<?php echo $app_id; ?>)" style="color: white">  <button type="button" class="btn btn-block btn-sm " data-target="#myModal" data-toggle="modal" >
                                                                    <i class="glyphicon glyphicon-file"></i> view</button>
                                                            </a>



                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>

                            </div>

                        </div>

                    </form>
                </section>
            </div>
            <!-- Modal -->
            <div class="modal fade " id="myModal" role="dialog" >
                <div class="modal-dialog" style="width: 70%;" >

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Collection history</h4>
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
        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="dist/js/app.min.js"></script>
        <link href="dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/datePicker/jquery-ui.js"></script>
    </body>
</html>
