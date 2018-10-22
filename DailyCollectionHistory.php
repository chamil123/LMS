<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/DailyCollectionModel.php';

$dailyCollection = new DailyCollection();
$result = $dailyCollection->viewAll();

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
                        Daily Collection
                        <small>View daily collection</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="DailyCollection.php"></i> Add daily collection</a></li>
                        <li class="active">View Daily Collection</li>
                    </ol>
                </section>
                
                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Process has been Successfully Done</div>
                <div class="alert alert-box failure " style="margin: 0px 15px 10px 15px"></div>
                <div class="alert alert-box warning " style="margin: 0px 15px 10px 15px"></div>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="Module/controller/DailyCollectionController.php" method="POST" name="addCenter">
                                <div class="box box-default">
                                    <div class="box-body">
                                        <table id="customer_data" class="table table-striped" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;Id</th>
                                                    <th>Date&nbsp;</th>
                                                    <th>Member Name</th>
                                                    <th> Member number</th>
                                                    <th> NIC Number</th>
                                                    <th>Center</th>
                                                    <th>Group</th>
                                                    <th>Loan Amount</th>
                                                    <th>Loan Outstanding</th>
                                                <!--<th>Action&nbsp;</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_SESSION["BRANCH_CODE"])) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        if ($_SESSION["BRANCH_CODE"] == $row['member_branchNumber']) {
                                                            $dailycollection_id = $row['dailycollection_id'];
                                                            $dailycollection_date = $row['dailycollection_date'];
                                                            $dailycollection_amount_paid = $row['dailycollection_amount_paid'];

                                                            $member_number = $row['member_number'];
                                                            $member_inital = $row['member_inital'];
                                                            $member_surNmae = $row['member_surNmae'];
                                                            $member_NIC = $row['member_NIC'];
                                                            $member_group = $row['member_group'];
                                                            $center_id = $row['center_id'];
                                                            $application_lamount = $row['application_lamount'];
                                                            $application_lamountWithInt = $row['application_lamountWithInt'];
                                                            $application_ldue = $row['application_ldue'];
                                                            ?>
                                                            <tr>
                                                                <td style="text-align: left;"><?php echo $dailycollection_id; ?></td>
                                                                <td style="text-align: left;"><?php echo $dailycollection_date; ?></td>
                                                                <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                                <td style="text-align: left;"><?php echo $member_number ?></td>
                                                                <td style="text-align: left;"><?php echo $member_NIC; ?></td>
                                                                <td style="text-align: left;"><?php echo $center_id; ?></td>
                                                                <td style="text-align: left;"><?php echo $member_group; ?></td>
                                                                <td style="text-align: left;"><?php echo $application_lamount; ?></td>
                                                                <td style="text-align: left;font-weight: bold"><?php echo $application_ldue; ?></td>                                                                                                               <!--<td style="text-align: left;"><input type="text" class="form-control" name="pay<?= $rowcount ?>"></td>-->
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $dailycollection_id = $row['dailycollection_id'];
                                                        $dailycollection_date = $row['dailycollection_date'];
                                                        $dailycollection_amount_paid = $row['dailycollection_amount_paid'];
                                                        $member_number = $row['member_number'];
                                                        $member_inital = $row['member_inital'];
                                                        $member_surNmae = $row['member_surNmae'];
                                                        $member_NIC = $row['member_NIC'];
                                                        $member_group = $row['member_group'];
                                                        $center_id = $row['center_id'];
                                                        $application_lamount = $row['application_lamount'];
                                                        $application_lamountWithInt = $row['application_lamountWithInt'];
                                                        $application_ldue = $row['application_ldue'];
                                                        ?>
                                                        <tr>
                                                            <td style="text-align: left;"><?php echo $dailycollection_id; ?></td>
                                                            <td style="text-align: left;"><?php echo $dailycollection_date; ?></td>
                                                            <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                            <td style="text-align: left;"><?php echo $member_number ?></td>
                                                            <td style="text-align: left;"><?php echo $member_NIC; ?></td>
                                                            <td style="text-align: left;"><?php echo $center_id; ?></td>
                                                            <td style="text-align: left;"><?php echo $member_group; ?></td>
                                                            <td style="text-align: left;"><?php echo $application_lamount; ?></td>
                                                            <td style="text-align: left;font-weight: bold"><?php echo $application_ldue; ?></td>                                                                                                                         <!--<td style="text-align: left;"><input type="text" class="form-control" name="pay<?= $rowcount ?>"></td>-->
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
        }
        );
    </script>  

</html>
