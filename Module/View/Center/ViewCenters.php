<?php
error_reporting(E_ERROR || E_WARNING);
require_once '../../../database/connection.php';
include '../../model/CenterModel.php';

$center = new Center();

$result = $center->viewAllCenters();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../../../dist/css/VikumTA.min.css">
        <link rel="stylesheet" href="../../../dist/css/_all-skins.min.css">
        <link href="../../../dist/css/Style.css" rel="stylesheet" type="text/css"/>

        <link href="../../../dist/css/Style.css" rel="stylesheet" type="text/css"/>

        <script src="../../../dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../../dist/js/UserValidate.js"></script>

        <script>
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

                    </nav>
                </header>
            </div>
            <?php include '../../../includes/navbar.php'; ?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Center 
                        <small>View Centers</small>
                    </h1>

                </section>
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="../../controller/CenterController.php?action=add" method="POST" name="addCenter">
                                <div class="box box-default">
                                  
                                    <!-- /.box-header -->
                                    <!-- form start -->

                                    <div class="box-body">

                                          <table class="table table-striped" width="70%">

                                                    <tr>
                                                        <th>&nbsp;No&nbsp;</th>
                                                        <th>Center Code&nbsp;</th>
                                                        <th>Center Name&nbsp;</th>
                                                        <th>Center Date&nbsp;</th>
                                                        <th>Action&nbsp;</th>
                                                    </tr>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $centerid = $row['center_id'];
                                                        $centercode = $row['center_code'];
                                                        $centername = $row['center_name'];
                                                        $centerdate = $row['center_date'];
                                                        
                                                        ?>
                                                        <tr>
                                                            <td style="text-align: left;"><?php echo $centerid; ?></td>
                                                            <td style="text-align: left;"><?php echo $centercode; ?></td>
                                                            <td style="text-align: left;"><?php echo $centername; ?></td>
                                                            <td style="text-align: left;"><?php echo $centerdate; ?></td>
                                                           <td style="valign:right">
                                                            <a href="UpdateAdminPapers.php?paper_id=<?php echo $row['center_id']; ?>"  style="color: white">  <button type="button" class="btn btn-warning btn-sm ">
                                                                    <i class="glyphicon glyphicon-edit"></i> update</button>  
                                                            </a>
                                                            <a href="controller/PaperController.php?paper_id=<?php echo $row['center_id']; ?>&action=delete"style="color: white"> <button type="button" class="btn btn-github btn-sm ">
                                                                  deactivate</button>  
                                                            </a>
                                                        </td> 
                                                        </tr>

                                                        <?php
                                                    }
                                                    ?>
                                                </table>



                                    </div>


                                </div>
                           
                                  
                            
                            </form>
                        </div>


                    </div>
                </section>
            </div>

            <?php include '../../../includes/footer.php'; ?>
        </div>

        <script src="../../../dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="../../../bootstrap/js/bootstrap.min.js"></script>
        <script src="../../../dist/js/app.min.js"></script>
        <link href="../../../dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="../../../dist/js/datePicker/jquery-ui.js"></script>
    </body>

</html>
