<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
$branch_code = $_SESSION["BRANCH_CODE"];


$member_id = $_GET['member_id'];
require_once 'database/connection.php';
include 'Module/model/MemberModel.php';
include './Module/model/GroupModel.php';
$member = new Member();
$resultMember = $member->viewMemberDetailsByIDinVIEW($member_id);
$rowMember = mysqli_fetch_assoc($resultMember);

$member_Number = $rowMember['member_number'];
$pieces = explode("/", $member_Number);

$resultGuranter = $member->viewGuranterDetailsByID($member_id);
$rowGurantor = mysqli_fetch_assoc($resultGuranter);

include './Module/model/CenterModel.php';
$center = new Center();
$result = $center->viewAllCenters();
$group = new Group();
$resultGroup = $group->viewAllBroupByCenter($rowMember['center_id']);
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
        <script src="dist/js/MemberValidate.js" type="text/javascript"></script>

        <link href="dist/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/jquery-ui.js" type="text/javascript"></script>

        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
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
            var Center = [
            ];
            var City = [
            ];
            $(document).on("ready", function () {
                loadData();
            });
            var loadData = function () {
                $.ajax({
                    type: 'POST',
                    url: "getAllCenterAjax.php"
                }).done(function (data) {
                    // alert(data);
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        center_id = pro[i].center_id;
                        center_code = pro[i].center_code;
                        center_name = pro[i].center_name;
                        // center_date = pro[i].center_date;
                        Center.push({"label": center_name, "name": center_code, "id": center_id});
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "getAllCityAjax.php"
                }).done(function (data) {
                    //alert(data);
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        // center_id = pro[i].center_id;
                        city_id = pro[i].city_id;
                        city_name = pro[i].city_name;
                        // center_date = pro[i].center_date;
                        City.push({"label": city_name, "name": city_id});
                    }
                });
            }
            $(document).ready(function () {
                $("#member_center").autocomplete({source: Center, select: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                        $("#centerNumber").val(ui.item.name);
                        $("#centerid").val(ui.item.id);
                    }});
            });
            $(document).ready(function () {
                $("#member_city").autocomplete({source: City, select: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                        $("#member_cityid").val(ui.item.name);
                        //  $("#Pid").val(ui.item.pid);
                    }});
            });
            $(document).ready(function () {
                $("#gurantor_city").autocomplete({source: City, select: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                        $("#gurantor_cityid").val(ui.item.name);
                        //  $("#Pid").val(ui.item.pid);
                    }});
            });
        </script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {
                var result = "<?php echo $_SESSION['msgu'] ?>";

                if (result == 1) {
                    $('.success').fadeIn(1500).delay(1500).fadeOut(400);
                } else if (result == 2) {
                    $('.failure').fadeIn(1500).delay(1500).fadeOut(400);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {
                    $('.warning').fadeIn(1500).delay(1500).fadeOut(400);
                    $('.warning').html('Successfully Updated record');
                }
<?php $_SESSION['msgu'] = "" ?>


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
                        Member Creation
                        <small>Update members</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="AddMember.php"></i> Add Member</a></li>
                        <li class="active">Update Members</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
                <section class="content">
                    <form class="form-horizontal" action="Module/controller/MemberController.php?action=update" method="POST" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Basic information</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="center" class="col-sm-3 control-label">Center</label>
                                            <div class="col-sm-9">
                                                <!--<input type="text" class="form-control" id="member_center" name="member_center" value="<?php echo $rowMember['center_id']; ?>" >-->

                                                <select class="form-control" id="empID" name="member_center">
                                                    <option value="" >-----select an option-----</option>
                                                    <?php while ($rows = mysqli_fetch_assoc($result)) { ?>
                                                        <option value="<?php echo $rows['center_id'] ?>"
                                                        <?php
                                                        if ($rows['center_id'] == $rowMember['center_id']) {
                                                            echo "selected";
                                                        }
                                                        ?>>
                                                                    <?php echo $rows['center_name'] ?>
                                                        </option>     
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="mNumber"  class="col-sm-3 control-label">Member No</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="member_br" name="member_br" value="<?php echo $pieces[0]; ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="member_no" name="member_no" value="<?php echo $pieces[1]; ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="centerNumber" name="centerNumber" value="<?php echo $pieces[2]; ?>">
                                                <input type="hidden" class="form-control " id="centerid" name="centerid" value="<?php echo $rowMember['center_id']; ?>">
                                                <input type="hidden" class="form-control " id="member_id" name="member_id" value="<?php echo $rowMember['member_id']; ?>">
                                                <input type="hidden" class="form-control " id="branch_code" name="branch_code" value="<?= $branch_code; ?>">
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">NIC Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="member_nic" name="member_nic"  value="<?php echo $rowMember['member_NIC']; ?>"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Surname</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_surname" name="member_surname" value="<?php echo $rowMember['member_surNmae']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Initial</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_initial" name="member_initial" value="<?php echo $rowMember['member_inital']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 0px;">Initial full without surname</label>

                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3" name="member_fullInitial" id="member_fullInitial"  autocomplete="off"><?php echo $rowMember['member_initialInFulWithoutSurname']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="member_dob" name="member_dob" value="<?php echo $rowMember['member_dateOfBirth']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dob" class="col-sm-3 control-label">Marital Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control required" id="member_status" name="member_status">
                                                    <option value="">----------please select an option---------</option>
                                                    <option value="Sigle"<?php if ($rowMember['member_maritalStatus'] == 'Sigle') echo ' selected="selected"'; ?>>Sigle</option>
                                                    <option value="Married"<?php if ($rowMember['member_maritalStatus'] == 'Married') echo ' selected="selected"'; ?>>Married</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Gender</label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="member_gender" id="member_gender" value="male"  <?php
                                                    if ($rowMember['member_gender'] == "male") {
                                                        echo "checked";
                                                    }
                                                    ?> >male
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="member_gender" id="member_gender" value="female" <?php
                                                    if ($rowMember['member_gender'] == "female") {
                                                        echo "checked";
                                                    }
                                                    ?>>female
                                                </label>
                                                <span id="genderInfo"  class="col-sm-12" style="padding-left: 30px;color: #ff0033" ></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Nationality</label>
                                            <div class="col-sm-9">
                                                <select class="form-control required" id="member_nationality" name="member_nationality">
                                                    <option value="">----------please select an option---------</option>
                                                    <option value="Sinhala"<?php if ($rowMember['member_nationality'] == 'Sinhala') echo ' selected="selected"'; ?>>Sinhala</option>
                                                    <option value="Tamil"<?php if ($rowMember['member_nationality'] == 'Tamil') echo ' selected="selected"'; ?>>Tamil</option>
                                                    <option value="Muslim"<?php if ($rowMember['member_nationality'] == 'Muslim') echo ' selected="selected"'; ?>>Muslim</option>
                                                    <option value="christen"<?php if ($rowMember['member_nationality'] == 'christen') echo ' selected="selected"'; ?>>christen</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="group" class="col-sm-3 control-label">Group</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="member_group" name="member_group">
                                                    <option value="" >-----select an option-----</option>
                                                    <?php while ($rowg = mysqli_fetch_assoc($resultGroup)) { ?>
                                                        <option value="<?php echo $rowg['group_id'] ?>"
                                                        <?php
                                                        if ($rowg['group_id'] == $rowMember['group_id']) {
                                                            echo "selected";
                                                        }
                                                        ?>>
                                                                    <?php echo $rowg['group_number'] ?>
                                                        </option>     
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">Mobile Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_mobile" name="member_mobile" value="<?php echo $rowMember['member_mobileNumber']; ?>"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Home Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_homenumber" name="member_homenumber" value="<?php echo $rowMember['member_homeNumber']; ?>"  autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Address Informations</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Address Line 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_aline1" name="member_aline1" value="<?php echo $rowMember['member_AddressLine1']; ?>"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_aline2" name="member_aline2" value="<?php echo $rowMember['member_AddressLine2']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 3</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_aline3" name="member_aline3" value="<?php echo $rowMember['member_AddressLine3']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 4</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="member_aline4" name="member_aline4" value="<?php echo $rowMember['member_AddressLine4']; ?>" autocomplete="off">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Husband or Main Guranter Details</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <!--<form class="form-horizontal">-->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">NIC Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_nic" name="guranter_nic" value="<?php echo $rowGurantor['guranter_NIC']; ?>"  autocomplete="off">
                                                <input type="text" class="form-control hidden" id="guranter_id" name="guranter_id" value="<?php echo $rowGurantor['guranter_id']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Surname</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_surname" name="guranter_surname" value="<?php echo $rowGurantor['guranter_surName']; ?>"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Initial</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_initial" name="guranter_initial" value="<?php echo $rowGurantor['guranter_initial']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 0px;">Initial full without surname</label>

                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="2" placeholder="Enter ..." id="guranter_fullInitial" name="guranter_fullInitial"  autocomplete="off"><?php echo $rowGurantor['guranter_initialInFulWithoutSurname']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="guranter_dob" name="guranter_dob" value="<?php echo $rowGurantor['guranter_dateOfBirth']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Contact Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_contact" name="guranter_contact" value="<?php echo $rowGurantor['guranter_contact']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Address Line 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_addressln1" name="guranter_addressln1" value="<?php echo $rowGurantor['guranter_AddressLine1']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_addressln2" name="guranter_addressln2" value="<?php echo $rowGurantor['guranter_AddressLine2']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 3</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_addressln3" name="guranter_addressln3" value="<?php echo $rowGurantor['guranter_AddressLine3']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 4</label>
                                            <div class="col-sm-9">

                                                <input type="text" class="form-control" id="guranter_addressln4" name="guranter_addressln4" value="<?php echo $rowGurantor['guranter_AddressLine4']; ?>" autocomplete="off">

                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning" value="Update Member" name="UpdateMember"/>
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
