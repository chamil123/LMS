<?php
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
$center_id = $_GET['center_id'];

include 'Module/model/CenterModel.php';
include './Module/model/UserModel.php';
include './Module/model/BranchModel.php';

$center = new Center();
$result = $center->viewCenterById($center_id);
$row = mysqli_fetch_assoc($result);



$branch = new Branch();
$resultb = $branch->viewAllBranches();

$user = new User();
$resultUser = $user->getUser();
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
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                var result = "<?php echo $_SESSION['msgc'] ?>";

                if (result == 1) {
                    $('.success').fadeIn(1500).delay(1500).fadeOut(400);
                }
                else if (result == 2) {
                    $('.failure').fadeIn(1500).delay(1500).fadeOut(400);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {
                    swal("Good job!", "You clicked the button!", "success");
                    $('.warning').fadeIn(1500).delay(1500).fadeOut(400);
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
                        Center
                        <small>Update Center</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="CreateCenter.php"></i> Add center</a></li>
                        <li class="active">Update Center</li>
                    </ol>
                </section>

                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="Module/controller/CenterController.php?action=update" method="POST" name="addCenter">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Basic information</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->

                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden"  id="center_id" name="center_id" value="<?php echo $row['center_id']; ?>">
                                            <input type="hidden"  id="center_branch" name="center_branch" value="<?php echo $row['branch_id']; ?>">

                                        </div>
                                        <div class="form-group">
                                            <label for="center_number" class="col-sm-4 control-label">Center Code</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="center_number" name="center_number" value="<?php echo $row['center_code']; ?>" placeholder="center code" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="center_name" class="col-sm-4 control-label">Center Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="center_name" name="center_name" autocomplete="off" value="<?php echo $row['center_name']; ?>" placeholder="center name">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="center_day" class="col-sm-4 control-label" >Center Day</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" id="center_day" name="center_day">
                                                    <option>----------------please Select a day------------------</option>
                                                    <option <?php
                                                    if ($row['center_date'] == "Sunday") {
                                                        echo "selected";
                                                    };
                                                    ?> >Sunday</option>
                                                    <option <?php
                                                    if ($row['center_date'] == "Monday") {
                                                        echo "selected";
                                                    };
                                                    ?> >Monday</option>
                                                    <option <?php
                                                    if ($row['center_date'] == "Tuesday") {
                                                        echo "selected";
                                                    };
                                                    ?> >Tuesday</option>
                                                    <option <?php
                                                    if ($row['center_date'] == "Wednesday") {
                                                        echo "selected";
                                                    };
                                                    ?> >Wednesday</option>
                                                    <option <?php
                                                    if ($row['center_date'] == "thursday") {
                                                        echo "selected";
                                                    };
                                                    ?> >thursday</option>
                                                    <option <?php
                                                    if ($row['center_date'] == "Friday") {
                                                        echo "selected";
                                                    };
                                                    ?> >Friday</option>
                                                    <option <?php
                                                    if ($row['center_date'] == "Saturday") {
                                                        echo "selected";
                                                    };
                                                    ?> >Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="center_branch" class="col-sm-4 control-label">Field Officer :</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" id="user_id" name="user_id">
                                                    <option value="" >-----select an option-----</option>
                                                    <?php while ($rowb = mysqli_fetch_assoc($resultUser)) { ?>
                                                        <option value="<?php echo $rowb['user_id'] ?>"
                                                        <?php
                                                        if ($rowb['user_id'] == $row['user_id']) {
                                                            echo "selected";
                                                        }
                                                        ?>>
                                                                    <?php echo $rowb['user_firstName'] . " " . $rowb['user_lastName'] ?>
                                                        </option>     
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <input type="submit" class="btn btn-warning" value="Update center" name="Adds"/>
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

            <?php include 'includes/footer.php'; ?>
        </div>

        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="dist/js/app.min.js"></script>
        <link href="dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/datePicker/jquery-ui.js"></script>
    </body>

</html>
