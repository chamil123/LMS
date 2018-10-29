<?php
clearstatcache();
// Report runtime warnings

if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);


require './database/connection.php';
include './Module/model/BranchModel.php';
include './includes/session_handling.php';
include './Module/model/UserModel.php';
include './Module/model/CenterModel.php';
$branch = new Branch();
$result = $branch->viewAllBranches();

$user = new User();
$resultUser = $user->getUser();

$branch_Id = $_SESSION["BRANCH_ID"];

$center = new Center();
//$maxId = $center->getMaxId();
//$maxId++;
//$num_str = sprintf("%03d", $maxId);

$maxcode = $center->getMaxCenterCode($branch_Id);
$maxcode++;
$code_str = sprintf("%03d", $maxcode);
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
                var branchNum = document.getElementById("center_branch").value;
              
                // xmlhttp.open("GET", "getUserName.php?q=" + str, true);
                xmlhttp.open("GET", "getCenterName.php?c_name="+ str+"&branch_id="+branchNum, true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {

                var result = "<?php echo $_SESSION['msgc'] ?>";

                if (result == 1) {
                    swal("Good job!", "You clicked the button!", "success");
                    swal("Successfully inserted!", "You clicked the button!", "success");
                    // $('.success').fadeIn(700).delay(1500).fadeOut(400);
                }
                else if (result == 2) {
                    $('.failure').fadeIn(700).delay(1500).fadeOut(400);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {
                    $('.warning').fadeIn(700).delay(1500).fadeOut(400);
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
                <section class="content-header">
                    <h1>
                        Center Creation
                        <small>Add Center</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i>Home</a></li>
                        <li class="active">Add center</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="Module/controller/CenterController.php?action=add" method="POST" name="addCenter">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Basic information</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">

                                        <div class="form-group">

                                            <div class="col-sm-4">
                                                <input type="hidden"  class="form-control required" id="center_branch" name="center_branch" value="<?= $branch_Id ?>"  >
                                            </div>
                                        </div>

                                        <!--                                        <div class="form-group">
                                                                                    <label for="center_branch" class="col-sm-4 control-label">Branch:<?= $branch_Id ?></label>
                                                                                    <div class="col-sm-4">
                                                                                        <select class="form-control" id="center_branch" name="center_branch">
                                                                                            <option>---- please select an option</option>
                                                                                            <//?php
                                                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                                                ?>
                                                                                                <option value="<//?= $row['branch_id'] ?>" ><//?= $row['branch_name'] ?></option>
                                                                                                <//?php
                                                                                            }
                                                                                            ?//>
                                        
                                                                                        </select>
                                                                                    </div>
                                                                                </div>-->
                                        <div class="form-group">
                                            <label for="center_number" class="col-sm-4 control-label">Center Code</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control required" id="center_number" name="center_number" value="<?= $code_str ?>" readonly placeholder="center code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="center_name" class="col-sm-4 control-label" >Center Name</label>
                                            <div class="col-sm-4">
                                                 <span id="txtHint"></span>
                                                <input type="text" class="form-control required" onkeyup="showUserName(this.value)" id="center_name" name="center_name" autocomplete="off" placeholder="center name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="center_day" class="col-sm-4 control-label" >Center Day</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" id="center_day" name="center_day">
                                                    <option>----------------please Select a day------------------</option>
                                                    <option>Sunday</option>
                                                    <option>Monday</option>
                                                    <option>Tuesday</option>
                                                    <option>Wednesday</option>
                                                    <option>Thursday</option>
                                                    <option>Friday</option>
                                                    <option>Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="center_branch" class="col-sm-4 control-label">Field Officer:</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" id="user_id" name="user_id">
                                                    <option>---------------- please select an option----------------</option>
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($resultUser)) {
                                                        ?>
                                                        <option value="<?= $row['user_id'] ?>" ><?= $row['user_firstName'] . " " . $row['user_lastName'] ?></option>
                                                        <?php
                                                    }
                                                    ?>

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
            <?php include 'includes/footer.php'; ?>
        </div>
        <script src="dist/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="dist/js/app.min.js"></script>
        <link href="dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/datePicker/jquery-ui.js"></script>
    </body>

</html>
