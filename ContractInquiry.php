<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require './database/connection.php';
include './includes/session_handling.php';
$branch_id = $_SESSION["BRANCH_CODE"];

$member_nic = $_GET['member_nic'];

include './Module/model/ContractInqueryModel.php';
include './Module/model/MemberModel.php';
$inquery = new ContractInquery();
$member = new Member();

if ($member_nic != null) {
    $result = $inquery->viewInqueryByMember_NIC($member_nic);
    $row = mysqli_fetch_assoc($result);

    $loanActiveDate = $row['application_activateDate'];
    $date = strtotime($loanActiveDate);
    $date = strtotime("+91 day", $date);
    $todate = date('Y-m-d', $date);


    $resultApp = $inquery->viewActiveApplicationDetailsBYAppId($row['application_id']);
    $rowApp = mysqli_fetch_assoc($resultApp);

    $operPayment = 0;
    if ($rowApp['dailycollection_amount_paid'] > $row['application_ldue']) {
        $operPayment = $rowApp['dailycollection_amount_paid'] - $row['application_ldue'];
    }
    $loanAmount = $row['application_lamount'];

    $resultDailCollectionTot = $member->availableAmount($row['application_id']);
    $rowDCT = mysqli_fetch_assoc($resultDailCollectionTot);
    $application_payAmount = $rowDCT['amt'];
    $ammountToBeCollect = $row['application_lamountWithInt'] - $application_payAmount;
    
    
    /////////////////////////////////////////////////////////////////////////////////
    $currentDate = date("Y-m-d");
    $datetime1 = new DateTime($loanActiveDate);
    $datetime2 = new DateTime($currentDate);
    $intervalForLastDateToCurrentDate = $datetime1->diff($datetime2);
    $differance = $intervalForLastDateToCurrentDate->format('%a');

    $center_day = $row['center_date'];

    $date2 = strtotime($loanActiveDate);
    $date2 = strtotime("+1 day", $date2);
    $lastPaymentDatePlusOne = date('Y-m-d', $date2);
    $next_day = date('Y-m-d', strtotime($center_day, strtotime($lastPaymentDatePlusOne)));
    
    

  
    $datetime3 = new DateTime($currentDate);
    $datetime4 = new DateTime($next_day);
    $intervalForLastDateToNextDate = $datetime3->diff($datetime4);
    $differanceToNext = $intervalForLastDateToNextDate->format('%a');
    
    $applicationDue=$row['application_ldue'];
    $loan_periouds=floor($differanceToNext/7);

     
     if($next_day>$currentDate){
         $totalShouldBePaid=($loan_periouds)*$applicationDue;
     }else if($next_day<$currentDate){
         $totalShouldBePaid=($loan_periouds+1)*$applicationDue;
        
     }
         
     if($totalShouldBePaid<$application_payAmount){
         $overPayment=$application_payAmount-$totalShouldBePaid;
         $arreasPayment=0;
     }else if($totalShouldBePaid>$application_payAmount){
         $arreasPayment=$totalShouldBePaid-$application_payAmount;
         $overPayment=0;
     }else if($totalShouldBePaid==$application_payAmount){
         $arreasPayment=0;
         $overPayment=0;
     }
     $loanPerioud=$row['application_lperiod'];
     $futureCapital=($ammountToBeCollect*100)/(10*$loanPerioud);

     $futureInterest=$ammountToBeCollect-$futureCapital;
    /////////////////////////////////////////////////////////////////////////////
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
        <link href="dist/css/Style.css" rel="stylesheet" type="text/css"/>

        <script src="dist/js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <!--<script src="dist/js/ApplicationValidate.js" type="text/javascript"></script>-->

        <link href="dist/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/jquery-ui.js" type="text/javascript"></script>

 <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
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
        <script>
            $(function () {
                $("#activate_date").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    // yearRange: "-55:-18"
                });
                $("#expire_date").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    // yearRange: "-55:-18"
                });

            });

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
            var Member = [
            ];
            var Guranter = [
            ];

            $(document).on("ready", function () {
                loadData();
            });
            //var member_group;
            var loadData = function () {
                $.ajax({
                    type: 'POST',
                    url: "getAllMemberAjax.php?branch_id=<?php echo $branch_id ?>"

                }).done(function (data) {
//                    alert(data);
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        member_id = pro[i].member_id;
                        member_number = pro[i].member_number;
                        member_NIC = pro[i].member_NIC;
                        member_surNmae = pro[i].member_surNmae;
                        member_inital = pro[i].member_inital;
                        member_group = pro[i].member_group;
                        member_mobileNumber = pro[i].member_mobileNumber;


                        member_AddressLine1 = pro[i].member_AddressLine1;

                        member_AddressLine2 = pro[i].member_AddressLine2;
                        member_AddressLine3 = pro[i].member_AddressLine3;
                        member_AddressLine4 = pro[i].member_AddressLine4;

                        address = member_AddressLine1 + "\n" + member_AddressLine2 + "\n" + member_AddressLine3 + "\n" + member_AddressLine4;

                        guranter_surName = pro[i].guranter_surName;
                        guranter_initial = pro[i].guranter_initial;
                        guranter_contact = pro[i].guranter_contact;
                        guranter_id = pro[i].guranter_id;

                        guranter_AddressLine1 = pro[i].guranter_AddressLine1;
                        guranter_AddressLine2 = pro[i].guranter_AddressLine2;
                        guranter_AddressLine3 = pro[i].guranter_AddressLine3;
                        guranter_AddressLine4 = pro[i].guranter_AddressLine4;

                        application_lamount = pro[i].application_lamount;
                        application_lperiod = pro[i].application_lperiod;
                        application_rentalf = pro[i].application_rentalf;
                        application_intCal = pro[i].application_intCal;
                        application_lamountWithInt = pro[i].application_lamountWithInt;
                        application_ldue = pro[i].application_ldue;
                        application_date = pro[i].application_date;
                        application_activateDate = pro[i].application_activateDate;

                        dailycollection_date = pro[i].dailycollection_date;
//                        dailycollection_amount_paid= pro[i].dailycollection_amount_paid;




                        addressGurenter = guranter_AddressLine1 + "\n" + guranter_AddressLine2 + "\n" + guranter_AddressLine3 + "\n" + guranter_AddressLine4;

                        Member.push({"label": member_NIC, "member_number": member_number, "member_surNmae": member_surNmae, "member_inital": member_inital, "member_group": member_group,
                            "guranter_surName": guranter_surName, "guranter_initial": guranter_initial, "guranter_contact": guranter_contact, "member_id": member_id, "member_mobileNumber": member_mobileNumber, "application_lamount": application_lamount,
                            "application_lperiod": application_lperiod, "application_rentalf": application_rentalf, "application_intCal": application_intCal, "application_lamountWithInt": application_lamountWithInt, "application_ldue": application_ldue, "application_date": application_date, "application_activateDate": application_activateDate, "dailycollection_date": dailycollection_date});
                    }
                });
            }
            $(document).ready(function () {
                $("#member_nic").autocomplete({source: Member, select: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                    }});
            });
            function zeroPad(num, places) {
                var zero = places - num.toString().length + 1;
                return Array(+(zero > 0 && zero)).join("0") + num;
            }


            function loanCalculations() {
                var loan_amount = document.getElementById('aplication_lamount').value;
                var loan_perioud = document.getElementById('aplication_lperiod').value;

                var aplication_irate = document.getElementById('aplication_irate').value;
                var aplication_months = document.getElementById('aplication_months').value;

                var loantWithInterest = (loan_amount * aplication_irate * aplication_months) / 100;
                document.getElementById('aplication_lamountWithInt').value = parseFloat(loantWithInterest) + parseFloat(loan_amount);
            }
            function loanPerioud() {
                var aplication_lamountWithInt = document.getElementById('aplication_lamountWithInt').value;
                var aplication_lperiod = document.getElementById('aplication_lperiod').value;

                var weeklyDue = aplication_lamountWithInt / aplication_lperiod;
                document.getElementById('aplication_ldue').value = parseFloat(weeklyDue);
            }
            function loanTerm(id) {

                $.ajax({
                    type: 'POST',
                    url: "getContactInquiryAjax.php?member_id=" + id
                }).done(function (data) {

                    // alert(data);
                    var pro = JSON.parse(data);
                    for (var i in pro) {

                    }
                });
            }
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
                        Contract Inquiry
                        <small>create Inquiry</small>
                    </h1>
                     <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">contact inquiry</li>
                    </ol>
                </section>
                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
                <section class="content">

                    <form class="form-horizontal"  name="frm" id="frm" action="Module/controller/ContractInqueryController.php?action=search"  method="POST" enctype="multiform/form-data">
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
                                            <label for="nic" class="col-sm-4 control-label">ID Number</label>
                                            <div class="col-sm-8">
                                                <div class="input-group add-on">
                                                    <input type="text" class="form-control" placeholder="Search" name="member_nic" id="member_nic" value="<?= $member_nic; ?>">
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
                                            <label for="initial" class="col-sm-4 control-label">Contact Number :</label>
                                            <div class="col-sm-8">
                                                <input  type="text"  class="form-control required" name="member_contact" id="member_contact"  value="<?= $row['member_mobileNumber']; ?>">
                                                <span id="msglamount"  style="color: #ff0000"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Address :</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" cols="35" rows="3" name="member_address" id="member_address"><?= $row['member_AddressLine1'] . "\n" . $row['member_AddressLine2'] . "\n" . $row['member_AddressLine3'] . "\n" . $row['member_AddressLine4']; ?></textarea>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label">Contract Amount</label>
                                            <div class="col-sm-8">
                                                <input  type="text" style="background-color: #ffffff;border: 1px solid#0000ff ; font-weight: bold" class="form-control required" name="aplication_lamount" id="aplication_lamount" onkeyup ="loanCalculations();" value="<?= $row['application_lamount']; ?>">
                                                <span id="msglamount"  style="color: #ff0000"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Period</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" name="aplication_lperiod" id="aplication_lperiod" value="<?= $row['application_lperiod']; ?>" onkeyup ="loanPerioud();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dob" class="col-sm-4 control-label" >Rental Frequence</label>
                                            <div class="col-sm-8">
                                                <select class="form-control required" name="aplication_rentalf" id="aplication_rentalf">
                                                    <option>Weekly</option>
                                                    <option>Monthly</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="dob" class="col-sm-4 control-label">Interest Calculate</label>
                                            <div class="col-sm-8">
                                                <select class="form-control required" name="aplication_intCal" id="aplication_intCal">
                                                    <option>Monthly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Gross rental</label>
                                            <div class="col-sm-5">
                                                <input style="font-size: 1.3em;font-weight: bold" type="text" class="form-control required" name="aplication_lamountWithInt" id="aplication_lamountWithInt" value="<?= $row['application_lamountWithInt']; ?>">
                                                <span id="msglamountWithInt"  style="color: #ff0000"></span>
                                            </div>
                                            <div class="col-sm-2" >
                                                <input  type="text" class="form-control required" name="aplication_irate" id="aplication_irate" onkeyup ="loanCalculations();"  placeholder="INT rate" value="10">
                                            </div>
                                            <div class="col-sm-1" style="margin-left:  -10px;padding: 0px">                                               
                                                <label  for="surname" class="col-sm-4 control-label">%</label>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Weekly or Monthly Due</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" id="aplication_ldue" name="aplication_ldue" value="<?= $row['application_ldue']; ?>">
                                                <span id="msgaplication_ldue"  style="color: #ff0000"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Activate date</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" id="activate_date" name="activate_date" placeholder="yyyy-mm-dd" value="<?= $row['application_activateDate']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Expire date</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" id="expire_date" name="expire_date" placeholder="yyyy-mm-dd" value="<?= $todate ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Main Gurantor details</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Guarantor Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_name" name="guranter_name" value="<?= $row['guranter_initial'] . " " . $row['guranter_surName']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Contacts:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_contact" name="guranter_contact"  value="<?= $row['guranter_contact']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Address:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" cols="35" rows="4" name="guranter_address" id="guranter_address"><?= $row['guranter_AddressLine1'] . "\n" . $row['guranter_AddressLine2'] . "\n" . $row['guranter_AddressLine3'] . "\n" . $row['guranter_AddressLine4']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Application details</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label">Last payment date:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ddd" name="ddd" value="<?= $rowApp['dailycollection_date']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label"> Last payment amount:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="guranter_contact" name="guranter_contact" value="<?= $rowApp['dailycollection_amount_paid']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label"> Total Arrears:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ddd" name="ddd" value="<?= $arreasPayment ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label"> Over payments:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ddd" name="ddd" value="<?= $overPayment; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label"> Future capital:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ddd" style="font-weight: bold;color: #3333ff" name="ddd" value="<?= floor($futureCapital); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label"> Future Interest:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ddd" style="font-weight: bold;" name="ddd" value="<?=floor($futureInterest);?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label"> Amount to be collect:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="ddd" name="ddd" value="<?= $ammountToBeCollect; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="row" style="margin-left: 15px;">
                            <div class="form-group">

                                <input type="submit" class="btn btn-primary" value="Add Application" name="AddApplication"/>
                                <!-- <button type="submit" name="submit" class="btn btn-info">
                                     <i class="glyphicon glyphicon-save"></i>
                                     Submit</button>-->
                                <button type="reset" name="reset" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Clear</button>
                            </div>
                        </div>
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
