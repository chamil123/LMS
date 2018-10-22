<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once'./database/connection.php';
include 'Module/model/CenterModel.php';

$_SESSION["BRANCH_CODE"];


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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">

            function delete_buton(id) {
                      swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                             var myWindow = window.open("Module/controller/CenterController.php?center_id="+id+"&action=delete", "_self");
                          swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                          });
                        } else {
                          swal("Your imaginary file is safe!");
                        }
                      });

                
    //myWindow.document.write("<p>I replaced the current window.</p>");
               //window.location.assign("Module/controller/CenterController.php");
                   
            //     window.location.href = "https://www.example.com";
               // window.location.assign("https://www.w3schools.com");
//                $('#invoice_div').load("age_analysis_summary_search1.php", {'sr_id': $('#sr_id').val(), 'area_id': $('#area_id').val(), 'outstand': $('#outstand').val(), 'f_range1': $('#f_range1').val(), 't_range1': $('#t_range1').val(), 'f_range2': $('#f_range2').val(), 't_range2': $('#t_range2').val(), 'f_range3': $('#f_range3').val(), 't_range3': $('#t_range3').val(), 't_range4': $('#t_range4').val(), 'page': page});
            }

            function load() {
                var result = "<?php echo $_SESSION['msgc'] ?>";
                if (result == 1) {
                    $('.success').fadeIn(500).delay(1800).fadeOut(400);
                }
                else if (result == 2) {
                    // swal("Good job!", "You clicked the button!", "success");
//                    $('.failure').fadeIn(500).delay(1800).fadeOut(400);
//                    $('.failure').html('Successfully deleted record');

                } else if (result == 3) {
                    swal("Good job!", "You clicked the button!", "success");
//                    $('.warning').fadeIn(500).delay(1800).fadeOut(400);
//                    $('.warning').html('Successfully Updated record');
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
                        Center
                        <small>View Centers</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="CreateCenter.php"></i> Add center</a></li>
                        <li class="active">View Centers</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Process has been Successfully Done</div>
                <div class="alert alert-box failure " style="margin: 0px 15px 10px 15px"></div>
                <div class="alert alert-box warning " style="margin: 0px 15px 10px 15px"></div>
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <!--<form class="form-horizontal" action="../../controller/CenterController.php?action=add" method="POST" name="addCenter">-->
                                <div class="box box-default">
                                    <div class="box-body">
                                        <table class="table table-striped" width="100%" id="customer_data">

                                            <thead>
                                                <tr>
                                                     <th>Branch name&nbsp;</th>
                                                    <!--<th>&nbsp;Id&nbsp;</th>-->
                                                    <th>Center code&nbsp;</th>
                                                    <th>Center Name&nbsp;</th>
                                                    <th> Date&nbsp;</th>
                                                 
                                                    <th>Field Officer&nbsp;</th>
                                                    <th class="pull-right">Actions&nbsp;</th>

                                                    <!--<th>Action&nbsp;</th>-->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                if (isset($_SESSION["BRANCH_ID"])) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        if ($_SESSION["BRANCH_ID"] == $row['branch_id']) {

                                                            $center_id = $row['center_id'];
                                                            $center_code = $row['center_code'];
                                                            $center_name = $row['center_name'];
                                                            $center_date = $row['center_date'];
                                                            $branch_name = $row['branch_name'];

                                                            $resultUser = $center->viewUserById($row['user_id']);
                                                            $user_name = mysqli_fetch_array($resultUser);

                                                            $fieldOfficer = $user_name['user_firstName'] . " " . $user_name['user_lastName'];
                                                            ?>
                                                            <tr>
                                                                <!--<td style="text-align: left;"><?php echo $center_id; ?></td>-->
                                                                 <td style="text-align: left;"><?php echo $branch_name; ?></td>
                                                                <td style="text-align: left;"><?php echo $center_code; ?></td>
                                                                <td style="text-align: left;"><?php echo $center_name ?></td>
                                                                <td style="text-align: left;"><?php echo $center_date; ?></td>
                                                               
                                                                <td style="text-align: left;"><?php echo $fieldOfficer; ?></td>

                                                                <td class="pull-right">
                                                                    <?php
                                                                    $resultPermision = $center->getPermission($_SESSION['user_id']);
                                                                    while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                        if ($rowe['rights_name'] == "Update center") {
                                                                            ?>
                                                                            <a href="UpdateCenter.php?center_id=<?php echo $row['center_id']; ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                                    <i class="glyphicon glyphicon-edit"></i> </button>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    $resultPermision = $center->getPermission($_SESSION['user_id']);
                                                                    while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                        if ($rowe['rights_name'] == "Delete center") {            
                                                                            ?>
                                                                    <!--Module/controller/CenterController.php?center_id=<?php echo $center_id; ?>&action=delete-->
                                                                    <button type="button" class="btn btn-danger btn-sm "  onclick="delete_buton(<?php echo $center_id; ?>);">
                                                                                    <i class="glyphicon glyphicon-trash"></i> </button>
                                                                         
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
                                                        $center_id = $row['center_id'];
                                                        $center_code = $row['center_code'];
                                                        $center_name = $row['center_name'];
                                                        $center_date = $row['center_date'];
                                                        $branch_name = $row['branch_name'];

                                                        $resultUser = $center->viewUserById($row['user_id']);
                                                        $user_name = mysqli_fetch_array($resultUser);

                                                        $fieldOfficer = $user_name['user_firstName'] . " " . $user_name['user_lastName'];
                                                        ?>
                                                        <tr>
                                                             <td style="text-align: left;"><?php echo $branch_name; ?></td>
                                                            <!--<td style="text-align: left;"><?php echo $center_id; ?></td>-->
                                                            <td style="text-align: left;"><?php echo $center_code; ?></td>
                                                            <td style="text-align: left;"><?php echo $center_name ?></td>
                                                            <td style="text-align: left;"><?php echo $center_date; ?></td>
                                                           
                                                            <td style="text-align: left;"><?php echo $fieldOfficer; ?></td>

                                                            <td class="pull-right">
                                                                <?php
                                                                $resultPermision = $center->getPermission($_SESSION['user_id']);
                                                                while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                    if ($rowe['rights_name'] == "Update center") {
                                                                        ?>
                                                                        <a href="UpdateCenter.php?center_id=<?php echo $row['center_id']; ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                                <i class="glyphicon glyphicon-edit"></i> </button>
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <?php
                                                                $resultPermision = $center->getPermission($_SESSION['user_id']);
                                                                while ($rowe = mysqli_fetch_array($resultPermision)) {
                                                                    if ($rowe['rights_name'] == "Delete center") {
                                                                        ?>
                                                                        <a href="Module/controller/CenterController.php?center_id=<?php echo $row['center_id']; ?>&action=delete"  style="color: white">  <button type="button" class="btn btn-danger btn-sm ">
                                                                                <i class="glyphicon glyphicon-trash"></i> </button>
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
                            <!--</form>-->
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
                "iDisplayLength": 10,
                "order": [[0, "desc"]]
            });
        });
    </script> 

</html>
