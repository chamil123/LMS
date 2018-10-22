<?php
if (!isset($_SESSION)) {
    session_start();
}
$application_id = $_GET['application_id'];
error_reporting(E_ERROR || E_WARNING);
require './database/connection.php';
include './Module/model/ChragesModel.php';
include './includes/session_handling.php';

$charges = new Charges();
$resultApp = $charges->viewApplicationDetailsByID($application_id);
$row = mysqli_fetch_assoc($resultApp);


$loanTerm = $charges->loanTermByMemberID($row['member_id']);
$rowloan = mysqli_fetch_assoc($loanTerm);
$loanTermByMem = $rowloan['num_comments'];

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
                        Charges
                        <small>Add charges</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="ViewApplication.php">view application</a></li>
                        <li class="active">add charges</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
                <section class="content">

                    <form class="form-horizontal" action="Module/controller/AplicationController.php?action=charges" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Application information</h3>
                                    </div>
                                    <div class="box-body">


                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="fname">Application id :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required "  id="application_id" name="application_id" value="<?= $row['application_id'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="lname">Loan amount :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" disabled id="lname" name="lname" value="<?= $row['application_lamount'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="dob">Member number :</label>
                                            <div class="col-sm-8">
                                                <span id="msgdob"></span>
                                                <input type="text" class="form-control required" disabled id="dob" name="dob" value="<?= $row['member_number'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="nic">NIC number :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" disabled id="nic" name="nic" value="<?= $row['member_NIC'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="uname">Member name :</label>
                                            <div class="col-sm-8">
                                                <div id="txtHint"></div>
                                                <input type="text" class="form-control required" disabled id="uname" name="uname" value="<?= $row['member_inital'] . " " . $row['member_surNmae'] ?>"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Charges information</h3>
                                    </div>
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="">Document charges :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required"name="document_charges" id="document_charges" placeholder="Enter Document charges">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="">Security service :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required"name="security_service" id="security_service" placeholder="Enter Security service">
                                            </div>
                                        </div>
                                        <?php if ($loanTermByMem < 2) { ?>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="email">Member fee :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control required" name="member_fee" id="member_fee" placeholder="Enter Member fee">
                                                </div>                                 
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>



                        </div>

                        <input type="submit" class="btn btn-primary" value="Add Charges" name="AddUser"/>
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
