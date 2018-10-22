<?php
session_start();
error_reporting(E_ERROR || E_WARNING);

require_once './../../../database/connection.php';
include '../../model/CourseModel.php';
include '../../model/SubjectModel.php';
//include 'model/';
$course = new Course();
$subject = new Subject();
$resultsubject = $course->viewCourse();
$resultcourse = $subject->viewAllSubjects();
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
                        Center Creation
                        <small>Add Center</small>
                    </h1>

                </section>
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="../../controller/CenterController.php?action=add" method="POST" name="addCenter">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Basic information</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->

                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="center_number" class="col-sm-4 control-label">Center Code</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="center_number" name="center_number" placeholder="center code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="center_name" class="col-sm-4 control-label">Center Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="center_name" name="center_name" placeholder="center name">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="center_day" class="col-sm-4 control-label" >Center Day</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" id="center_day" name="center_day">
                                                    <option>----------------please Select a day------------------</option>
                                                    <option>Sunday</option>
                                                    <option>Monday</option>
                                                    <option>Tuesday</option>
                                                    <option>Wednesday</option>
                                                    <option>thursday</option>
                                                    <option>Friday</option>
                                                    <option>Saturday</option>
                                                </select>
                                            </div>
                                        </div>



                                    </div>


                                </div>
                           
                                    <input type="submit" class="btn btn-primary" value="Add Account" name="Adds"/>
                                    <!-- <button type="submit" name="submit" class="btn btn-info">
                                         <i class="glyphicon glyphicon-save"></i>
                                         Submit</button>-->
                                    <button type="reset" name="reset" class="btn btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        Clear</button>
                            
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
