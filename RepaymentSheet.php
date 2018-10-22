<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once'./database/connection.php';
include 'Module/model/CenterModel.php';

$center = new Center();
$result = $center->viewAllCenters();
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


    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {

                var result = "<?php echo $_SESSION['msgc'] ?>";

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
<?php $_SESSION['msgc'] = "" ?>
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
                        <small>Repayment sheet</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">repayment sheet</li>
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
                                    <form class="form-horizontal" action="/action_page.php" style="padding-top: 30px">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" >Branch code:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="email" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" >Center code:</label>
                                            <div class="col-sm-6"> 
                                                <input type="text" class="form-control" id="pwd" placeholder="Enter password">
                                            </div>
                                        </div>

                                        <div class="form-group"> 
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <a href="Module/controller/ReportController.php?serchBoxBranch=<?php echo $serchBoxBranch; ?>&serchBoxCenter=<?= $serchBoxCenter ?>&searchCombo=<?= $searchCombo ?>&action=LoanOutstandingexcel"  style="color: white">  <button type="button" class="btn btn-warning">
                                                        <i class="fas fa-file-excel" style="margin-right: 5px;"></i> Download Excel File</button>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>



    </body>
    <script>
        $(document).ready(function () {
            $('#customer_data').DataTable({
                "aLengthMenu": [[3, 5, 10, 15, 20], [3, 5, 10, 15, 20]],
                "iDisplayLength": 10
            });
        });
    </script> 

</html>
