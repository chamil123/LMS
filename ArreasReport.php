<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/ReportModel.php';
include 'Module/model/ContractInqueryModel.php';
include 'Module/model/MemberModel.php';
include './includes/session_handling.php';
$report = new Report();


$inquery = new ContractInquery();
$member = new Member();

$serchBoxBranch = $_GET['serchBoxBranch'];
$serchBoxCenter = $_GET['serchBoxCenter'];
$searchCombo = $_GET['searchCombo'];


if ($serchBoxBranch == "" && $serchBoxCenter == "") {
    $result = $report->viewArreasApplications();
} else if ($serchBoxBranch != "" && $serchBoxCenter == "") {
    $result = $report->viewArreasApplicationsByBranchId($serchBoxBranch);
} else if ($serchBoxBranch == "" && $serchBoxCenter != "") {
    $result = $report->viewArreasApplicationsByCenterId($serchBoxCenter);
} else if ($serchBoxBranch != "" && $serchBoxCenter != "") {
    $result = $report->viewArreasApplicationsBothId($serchBoxBranch, $serchBoxCenter);
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
                        <small>Arrears report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"> <i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">arrears report</li>
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
                                    <div class="col-md-7 col-md-offset-5 pull-right" style="padding-bottom: 10px;">
                                        <form class="form-horizontal" action="Module/controller/ArrearsReportController.php?action=add" method="POST" name="addCenter">
                                            <div class="col-md-3" style="width: 227px">
                                                <select class=" form-control " name="serchCombo" id="serchCombo" onchange="changeColor()">
                                                    <option <?php
                                                    if ($searchCombo == "All Active") {
                                                        echo "selected";
                                                    };
                                                    ?> >All Active</option>
                                                    <option <?php
                                                    if ($searchCombo == "Arrears only") {
                                                        echo "selected";
                                                    };
                                                    ?>>Arrears only</option>

                                                </select>
                                            </div> 
                                            <div class="col-md-3" style="margin-left: -10px">
                                                <input type="text" name="serchBoxBranch" id="serchBox" class=" form-control " placeholder="Branch ID" value="<?= $serchBoxBranch ?>"/> 
                                            </div>
                                            <div class="col-md-3" style="margin-left: -10px">
                                                <input type="text" name="serchBoxCenter" id="serchBox" class=" form-control " placeholder="Center ID" value="<?= $serchBoxCenter ?>"/> 
                                            </div>
                                            <div class="col-md-2" style="margin-left: -10px">
                                                <button type="submit" class="btn btn-primary" name="searchArrears">
                                                    <span class="glyphicon glyphicon-search"></span> Search
                                                </button>
                                            </div>


                                        </form>
                                    </div>

                                    <div id="employee_table" >
                                        <table class="table table-striped" width="100%">

                                            <tbody>
                                                <tr>
                                                    <th>Client code</th>
                                                    <th>Member Number&nbsp;</th>
                                                    <th>Name&nbsp;</th>
                                                    <th>Loan date&nbsp;</th>
                                                    <th>Expire date&nbsp;</th>
                                                    <th>Loan amount &nbsp;</th>
                                                    <th>Rental arrears &nbsp;</th>
                                                    <th>Total arrears&nbsp;</th>
                                                    <th>Loan outstanding&nbsp;</th>

                                                </tr>




                                                <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    if ($row['application_status'] == "activated") {

                                                        $member_code = $row['member_code'];
                                                        $member_number = $row['member_number'];
                                                        $member_inital = $row['member_inital'];
                                                        $member_surNmae = $row['member_surNmae'];
                                                        $loanActiveDate = $row['application_activateDate'];
//
//                                                    $date = $row['application_activateDate'];
                                                        $date = strtotime($loanActiveDate);
                                                        $dd = "91";
                                                        $date = strtotime("+" . $dd . " day", $date);
                                                        $todate = date('Y-m-d', $date);


                                                        $application_lamount = $row['application_lamount'];
                                                        $center_day = $row['center_date'];

                                                        $resultLastPaymentDate = $inquery->viewActiveApplicationDetailsBYAppId($row['application_id']);
                                                        $rowdailyCollection = mysqli_fetch_array($resultLastPaymentDate);
                                                        $lastDate = $rowdailyCollection['dailycollection_date'];


                                                        //////////////////////////////////////////////////////////////////////////////////////////////////
                                                        $date2 = strtotime($loanActiveDate);
                                                        $date2 = strtotime("+1 day", $date2);
                                                        $lastPaymentDatePlusOne = date('Y-m-d', $date2);
                                                        $next_day = date('Y-m-d', strtotime($center_day, strtotime($lastPaymentDatePlusOne)));



                                                        $currentDate = date("Y-m-d");
                                                        $datetime3 = new DateTime($currentDate);
                                                        $datetime4 = new DateTime($next_day);
                                                        $intervalForLastDateToNextDate = $datetime3->diff($datetime4);
                                                        $differanceToNext = $intervalForLastDateToNextDate->format('%a');

                                                        $loan_periouds = floor($differanceToNext / 7);
                                                        $applicationDue = $row['application_ldue'];


                                                        if ($next_day > $currentDate) {
                                                            $totalShouldBePaid = ($loan_periouds) * $applicationDue;
                                                        } else if ($next_day < $currentDate) {
                                                            $totalShouldBePaid = ($loan_periouds + 1) * $applicationDue;
                                                        }
                                                        $resultDailCollectionTot = $member->availableAmount($row['application_id']);
                                                        $rowDCT = mysqli_fetch_assoc($resultDailCollectionTot);
                                                        $application_payAmount = $rowDCT['amt'];

                                                        $arrearsAmount = $totalShouldBePaid - $application_payAmount;
                                                        $arrearsRental = $arrearsAmount / $applicationDue;
                                                        if ($arrearsRental < 0) {
                                                            $arrearsRental = 0;
                                                            $arrearsAmount = 0;
                                                        }



                                                        $loanOutstanding = $row['application_lamountWithInt'] - $application_payAmount;


                                                        ///////////////////////////////////////////////////////////////////////////////////////////////////


                                                        $currentDate = date("Y-m-d");
//                                                        if ($lastDate != "") {
//
//
//                                                            $date2 = strtotime($lastDate);
//                                                            $date2 = strtotime("+1 day", $date2);
//                                                            $lastPaymentDatePlusOne = date('Y-m-d', $date2);
//                                                            $next_monday = date('Y-m-d', strtotime($center_day, strtotime($lastPaymentDatePlusOne)));
////
//                                                            $datetime1 = new DateTime($lastDate);
//                                                            $datetime2 = new DateTime($currentDate);
//                                                            $intervalForLastDateToCurrentDate = $datetime1->diff($datetime2);
//                                                            $differance = $intervalForLastDateToCurrentDate->format('%a');
//
//                                                            $datetime3 = new DateTime($lastDate);
//                                                            $datetime4 = new DateTime($next_monday);
//                                                            $intervalForLastDateToNextDate = $datetime3->diff($datetime4);
//                                                            $differanceToNext = $intervalForLastDateToNextDate->format('%a');
////                                                            echo ' ' . $lastDate . "  " . $currentDate . "<br/>";
//                                                        } else {
//                                                            $date2 = strtotime($loanActiveDate);
//                                                            $date2 = strtotime("+1 day", $date2);
//                                                            $lastPaymentDatePlusOne = date('Y-m-d', $date2);
//                                                            $next_monday = date('Y-m-d', strtotime($center_day, strtotime($lastPaymentDatePlusOne)));
//
//                                                            $datetime1 = new DateTime($loanActiveDate);
//                                                            $datetime2 = new DateTime($currentDate);
//                                                            $intervalForLastDateToCurrentDate = $datetime1->diff($datetime2);
//                                                            $differance = $intervalForLastDateToCurrentDate->format('%a');
//
//                                                            $datetime3 = new DateTime($loanActiveDate);
//                                                            $datetime4 = new DateTime($next_monday);
//                                                            $intervalForLastDateToNextDate = $datetime3->diff($datetime4);
//                                                            $differanceToNext = $intervalForLastDateToNextDate->format('%a');
//                                                        }
//                                                        echo 'ddddd : ' . $lastDate;
//                                                        $datetime1 = new DateTime('2009-10-11');
//                                                        $datetime2 = new DateTime('2009-10-16');
//                                                        $intervalForLastDateToCurrentDate = $datetime1->diff($datetime2);
//                                                        echo $intervalForLastDateToCurrentDate->format('%a');
//                                                        echo $next_monday;
                                                        if ($searchCombo == "All Active") {
                                                            ?>
                                                            <tr <?php if ($arrearsRental < 0) { ?>
                                                                    Style=" background-color: #d6e9c6;"
                                                                <?php } else if ($arrearsRental > 0) { ?>
                                                                    Style=" background-color: #ffe6e6;" 
                                                                <?php } ?>>
                                                                <td style="text-align: left;"><?php echo $row['member_code']; ?></td>
                                                                <td style="text-align: left;"><?php echo $member_number; ?></td>
                                                                <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                                <td style="text-align: left;"><?php echo $loanActiveDate; ?></td>
                                                                <td style="text-align: left;"><?php echo $todate; ?></td>
                                                                <td style="text-align: left;"><?php echo $application_lamount; ?></td>
                                                                <!--<td style="text-align: left;"><?//php echo $center_day; ?></td>-->

                                                                                                                                                                                                    <!--                                                                <td style="text-align: left;"><?php echo $next_monday; ?></td>
                                                                                                                                                                                                         <td style="text-align: left;"><?php echo $differance; ?></td>
                                                                                                                                                                                                         <td style="text-align: left;"><?php echo $differanceToNext; ?></td>-->
                                                                <td style="text-align: left;"><?php echo round($arrearsRental, 2); ?></td>
                                                                <td style="text-align: left;"><?php echo $arrearsAmount; ?></td>
                                                                <td style="text-align: left;"><?php echo $loanOutstanding; ?></td>
                                                                <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

                                                            </tr>

                                                            <?php
                                                        } else if ($searchCombo == "Arrears only") {
                                                            if ($totalShouldBePaid > $application_payAmount) {
                                                                ?>
                                                                <tr >
                                                                    <td style="text-align: left;"><?php echo $row['member_code']; ?></td>
                                                                    <td style="text-align: left;"><?php echo $member_number; ?></td>
                                                                    <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                                    <td style="text-align: left;"><?php echo $loanActiveDate; ?></td>
                                                                    <td style="text-align: left;"><?php echo $todate; ?></td>
                                                                    <td style="text-align: left;"><?php echo $application_lamount; ?></td>
                                                                    <!--<td style="text-align: left;"><?//php echo $center_day; ?></td>-->

                                                                                                                                                                                                                                    <!--                                                                <td style="text-align: left;"><?php echo $next_monday; ?></td>
                                                                                                                                                                                                                                         <td style="text-align: left;"><?php echo $differance; ?></td>
                                                                                                                                                                                                                                         <td style="text-align: left;"><?php echo $differanceToNext; ?></td>-->
                                                                    <td style="text-align: left;"><?php echo round($arrearsRental, 2); ?></td>
                                                                    <td style="text-align: left;"><?php echo $arrearsAmount; ?></td>
                                                                    <td style="text-align: left;"><?php echo $loanOutstanding; ?></td>
                                                                    <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

                                                                </tr>

                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>


                            </div> 
                            <a href="Module/controller/ArrearsReportController.php?serchBoxBranch=<?php echo $serchBoxBranch; ?>&serchBoxCenter=<?=$serchBoxCenter ?>&searchCombo=<?=$searchCombo?>&action=excel"  style="color: white">  <button type="button" class="btn btn-warning">
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

    </body>

</html>
