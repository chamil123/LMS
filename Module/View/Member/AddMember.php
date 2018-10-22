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
                        Member Creation
                        <small>Add member</small>
                    </h1>

                </section>
                <section class="content">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Basic information</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="mNumber" class="col-sm-3 control-label">Member No</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Branch No">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Member No">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Center No">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">NIC Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="NIC number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Surname</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Surname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Initial</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 0px;">Initial full without surname</label>

                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3" placeholder="Enter ..." ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="inputEmail3">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="dob" class="col-sm-3 control-label">Marital Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Gender</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="inputEmail3">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Nationality</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="center" class="col-sm-3 control-label">Center</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="group" class="col-sm-3 control-label">Group</label>
                                            <div class="col-sm-9">
                                                <select class="form-control">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">Mobile Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="NIC number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Home Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Surname">
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Add Account" name="Add"/>
                                    <!-- <button type="submit" name="submit" class="btn btn-info">
                                         <i class="glyphicon glyphicon-save"></i>
                                         Submit</button>-->
                                    <button type="reset" name="reset" class="btn btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        Clear</button>
                                </div>
                        </div>
                           
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Address Informations</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal">
                                    <div class="box-body">
                                        
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Address Line 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 3</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Town</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                       

                                    </div>

                                </form>
                            </div>
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Husband or Main Guranter Details</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">NIC Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="NIC number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Surname</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Surname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Initial</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 0px;">Initial full without surname</label>

                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="2" placeholder="Enter ..." ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Contact Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Address Line 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 3</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Town</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Initial">
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
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
