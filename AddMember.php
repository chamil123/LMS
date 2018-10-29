<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require './database/connection.php';
include './Module/model/CenterModel.php';
include './includes/session_handling.php';
include './Module/model/MemberModel.php';
$center = new Center();
$member = new Member();
$result = $center->viewAllCenters();
if ($_SESSION["BRANCH_CODE"] != "") {

    $branch_code = $_SESSION["BRANCH_CODE"];
    $member_branchCode = "SR" . $branch_code;
    $branch_Id = $_SESSION["BRANCH_ID"];
    $maxcode = $member->getMaxmemberNo($branch_Id);
    $member_str = sprintf("%03d", $maxcode);

//    $member->getAllMemberGroupByCenter($branch_Id);
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

        <script src="dist/js/jquery.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="dist/js/app.min.js"></script>
        <script src="dist/js/jquery_1.js" type="text/javascript"></script>
        <script src="dist/js/jquery.autocomplete.js" type="text/javascript"></script>
        <script src="dist/js/MemberValidate.js" type="text/javascript"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="dist/css/jquery.autocomplete_1.css" rel="stylesheet" type="text/css"/>

        <script src="dist/js/datePicker/jquery-ui.js"></script>

        <link href="dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>

        <script>
            $(function () {
                $('.dropdown-menu a').click(function () {
                    alert($(this).attr('data-value'));
                    $(this).closest('.dropdown').find('input.countrycode')
                            .val($(this).attr('data-value'));
                });
            });

            $(function () {
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var maxDate = year - 18 + '-' + month + '-' + day;
                var minDate = year - 60 + '-' + month + '-' + day;
                $('#member_dob').attr('max', maxDate);
                $('#member_dob').attr('min', minDate);
                $('#guranter_dob').attr('max', maxDate);
                $('#guranter_dob').attr('min', minDate);
            });
        </script>
        <script>

            function setValueToBranchCode() {
                var branch = document.getElementById('member_br').value;

                var branch_code = branch.replace('SR', '');
                document.getElementById('branch_code').value = branch_code;
            }

        </script>
        <script>

            $(document).on("ready", function () {
                loadData();
            });

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
                    guranter_contact
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                    }
                }
//                var branchNum = document.getElementById("member_br").value;
//                var centerNum = document.getElementById("centerNumber").value;
                // xmlhttp.open("GET", "getUserName.php?q=" + str, true);
                xmlhttp.open("GET", "getMemberName.php?uname=" + str, true);
                xmlhttp.send();
            }
            function showGuranterName(str)
            {

                var xmlhttp;
                if (str == "")
                {
                    document.getElementById("txtHintG").innerHTML = "";
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
                        var pro = JSON.parse(xmlhttp.responseText);
                        if (pro != '') {
                            document.getElementById("txtHintG").innerHTML = "<i class='alert-danger'>Existing Guranter NIC number</i>";
                            for (var i in pro) {
                                guranter_NIC = pro[i].guranter_NIC;
                                guranter_surName = pro[i].guranter_surName;
                                guranter_initial = pro[i].guranter_initial;
                                guranter_initialInFulWithoutSurname = pro[i].guranter_initialInFulWithoutSurname;
                                guranter_dateOfBirth = pro[i].guranter_dateOfBirth;
                                guranter_contact = pro[i].guranter_contact;
                                guranter_AddressLine1 = pro[i].guranter_AddressLine1;
                                guranter_AddressLine2 = pro[i].guranter_AddressLine2;
                                guranter_AddressLine3 = pro[i].guranter_AddressLine3;
                                guranter_AddressLine4 = pro[i].guranter_AddressLine4;
                            }

                            document.getElementById("guranter_surname").value = guranter_surName;
                            document.getElementById("guranter_surname").style.color = 'red';
                            document.getElementById("guranter_initial").value = guranter_initial;
                            document.getElementById("guranter_initial").style.color = 'red';
                            document.getElementById("guranter_fullInitial").value = guranter_initialInFulWithoutSurname;
                            document.getElementById("guranter_fullInitial").style.color = 'red';
                            document.getElementById("guranter_dob").value = guranter_dateOfBirth;
                            document.getElementById("guranter_dob").style.color = 'red';
                            document.getElementById("guranter_contact").value = guranter_contact;
                            document.getElementById("guranter_contact").style.color = 'red';
                            document.getElementById("guranter_addressln1").value = guranter_AddressLine1;
                            document.getElementById("guranter_addressln1").style.color = 'red';
                            document.getElementById("guranter_addressln2").value = guranter_AddressLine2;
                            document.getElementById("guranter_addressln2").style.color = 'red';
                            document.getElementById("guranter_addressln3").value = guranter_AddressLine3;
                            document.getElementById("guranter_addressln3").style.color = 'red';
                            document.getElementById("guranter_addressln4").value = guranter_AddressLine4;
                            document.getElementById("guranter_addressln4").style.color = 'red';
                        } else {
                            document.getElementById("txtHintG").innerHTML = "<i class='alert-success'>Availbale Guranter NIC number</i>";
                        }
                    }
                }
//                var branchNum = document.getElementById("member_br").value;
//                var centerNum = document.getElementById("centerNumber").value;
                // xmlhttp.open("GET", "getUserName.php?q=" + str, true);
                xmlhttp.open("GET", "getGuranterName.php?guranter=" + str, true);
                xmlhttp.send();
            }

            var Center = [
            ];
            var City = [
            ];
            var Address = [
            ];
            var AddressLine2 = [
            ];
            var AddressLine3 = [
            ];
            var AddressLine4 = [
            ];

            var loadData = function () {

                $.ajax({
                    type: 'POST',
                    url: "getAllCenterAjax.php?branch_code=<?php echo $branch_code ?>"
                }).done(function (data) {
//                     alert(data);
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
                $.ajax({
                    type: 'POST',
                    url: "getAllAddressLine1Ajax.php"
                }).done(function (data) {

                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        // center_id = pro[i].center_id;
                        member_AddressLine1 = pro[i].member_AddressLine1;
                        member_AddressLine2 = pro[i].member_AddressLine2;
                        member_AddressLine3 = pro[i].member_AddressLine3;
                        member_AddressLine4 = pro[i].member_AddressLine4;

                        Address.push({"label": member_AddressLine1, "member_AddressLine2": member_AddressLine2, "member_AddressLine3": member_AddressLine3, "member_AddressLine4": member_AddressLine4});
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "getAllAddressLine2Ajax.php"
                }).done(function (data) {
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        Line2 = pro[i].member_AddressLine2;
                        AddressLine2.push({"label": Line2});
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "getAllAddressLine3Ajax.php"
                }).done(function (data) {
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        Line3 = pro[i].member_AddressLine3;
                        AddressLine3.push({"label": Line3});
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "getAllAddressLine4Ajax.php"
                }).done(function (data) {
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        Line4 = pro[i].member_AddressLine4;
                        AddressLine4.push({"label": Line4});
                    }
                });
            }
//            $(document).ready(function () {
//                $("#member_center").autocomplete({source: Center, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                        $("#centerNumber").val(ui.item.name);
//                        $("#centerid").val(ui.item.id);
//                    }});
//            });
///////////////////// for member address details////////////////////////////////////
//            $(document).ready(function () {
//                $("#member_aline1").autocomplete({source: Address, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                        $("#member_aline2").val(ui.item.member_AddressLine2);
//                        $("#member_aline3").val(ui.item.member_AddressLine3);
//                        $("#member_aline4").val(ui.item.member_AddressLine4);
//
//                    }});
//            });
//            $(document).ready(function () {
//                $("#member_aline2").autocomplete({source: AddressLine2, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                    }});
//            });
//            $(document).ready(function () {
//                $("#member_aline3").autocomplete({source: AddressLine3, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                    }});
//            });
//            $(document).ready(function () {
//                $("#member_aline4").autocomplete({source: AddressLine4, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                    }});
//            });
///////////////// for guranter address details////////////////////////////////////
//            $(document).ready(function () {
//                $("#guranter_addressln1").autocomplete({source: Address, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                        $("#guranter_addressln2").val(ui.item.member_AddressLine2);
//                        $("#guranter_addressln3").val(ui.item.member_AddressLine3);
//                        $("#guranter_addressln4").val(ui.item.member_AddressLine4);
//
//                    }});
//            });
//            $(document).ready(function () {
//                $("#guranter_addressln2").autocomplete({source: AddressLine2, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                    }});
//            });
//            $(document).ready(function () {
//                $("#guranter_addressln3").autocomplete({source: AddressLine3, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                    }});
//            });
//            $(document).ready(function () {
//                $("#guranter_addressln4").autocomplete({source: AddressLine4, select: function (event, ui) {
//                        event.preventDefault();
//                        $(this).val(ui.item.label);
//                    }});
//            });


        </script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {
                var result = "<?php echo $_SESSION['msgm'] ?>";

                if (result == 1) {
                    // swal("Good job!", "You clicked the button!", "success");
                    swal("Successfully inserted!", "You clicked the button!", "success");
                    // $('.success').fadeIn(700).delay(1500).fadeOut(200);
                } else if (result == 2) {
                    $('.failure').fadeIn(700).delay(1500).fadeOut(200);
                    $('.failure').html('Successfully deleted record');
                } else if (result == 3) {
                    $('.warning').fadeIn(700).delay(1500).fadeOut(200);
                    $('.warning').html('Successfully Updated record');
                } else if (result == 5) {
                    swal("Error!", "Could't Complete the request, process is Rollback", "error");
                }
<?php $_SESSION['msgm'] = "" ?>


            }

//            $(document).ready(function () {
//                $('#zone').change(function () {
//                    $.get('getCenterInfoAjax.php', {empId: $(this).val()}, function (data) {
//
//                        $("#centerNumber").val(data);
//                        $("#centerid").val(data);
//                    });
//                });
//            });
        </script>
        <script>
//          jQuery.noConflict();
// $.noConflict();
            $.noConflict();

            jQuery(document).ready(function () {
                jQuery("#zone").autocomplete("loadZoneNameauto.php", {
                    width: 375,
                    matchContains: true,
                    selectFirst: true
                });
                jQuery("#zone").result(function (event, data, formatted) {
//                        $("#zone").val(data[0]);
                    var data = data + "";
                    var string = data.split(" ");
                    jQuery("#centerNumber").val(string[1]);
                    jQuery("#centerid").val(string[2]);
                   jQuery("#member_group").load('load_editable_group_dropdown.php',{'branch_id':$('#branch_id').val(),'center_id':$('#centerid').val()});
                     
                });
            });

            $(function () {
                $("#member_dob").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    yearRange: "-60:-18"
                });
//                $("#guranter_dob").datepicker({
//                    changeMonth: true,
//                    changeYear: true,
//                    dateFormat: 'yy-mm-dd',
//                    yearRange: "-60:-18"
//                });
            });

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
                        <small>Add member</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i>Home</a></li>

                        <li class="active">Add member</li>
                    </ol>
                </section>

                <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
                <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
                <section class="content">

                    <form class="form-horizontal" action="Module/controller/MemberController.php?action=add" method="POST" >
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
                                                <input type="text" class="form-control required" id="zone" name="zone"   placeholder="Please Enter Center Name">
<!--                                                <select class="form-control required" id="empID" name="member_center">
                                                    <option value="" >-----select an option-----</option>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                                                                                                                                                                                <option value="<?= $row['center_id'] ?>" ><?= $row['center_name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>-->

                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label for="mNumber"  class="col-sm-3 control-label">Member No</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control required" id="member_br" name="member_br" onkeyup="setValueToBranchCode();" value="<?= $member_branchCode ?>" placeholder="SRxxx">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control required" id="centerNumber" name="centerNumber" placeholder="Center No">
                                                <input type="hidden" class="form-control " id="centerid" name="centerid" >
                                                <input type="hidden" class="form-control " id="branch_code" name="branch_code" value="<?= $branch_code ?>">
                                                <input type="hidden" class="form-control " id="branch_id" name="branch_id" value="<?php echo  $_SESSION["BRANCH_ID"];?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control required" id="member_no" name="member_no" value="<?= $member_str; ?>"  placeholder="Member No">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">NIC Number</label>
                                            <div class="col-sm-9">
                                                <span id="txtHint"></span>
                                                <input type="text" class="form-control required" id="member_nic" name="member_nic" placeholder="NIC number" onkeyup="showUserName(this.value)" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Surname</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="member_surname" name="member_surname" placeholder="Surname" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Initial</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="member_initial" name="member_initial" placeholder="Initial" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 0px;">Initial full without surname</label>

                                            <div class="col-sm-9">
                                                <textarea class="form-control required" rows="3" name="member_fullInitial" id="member_fullInitial" placeholder="Enter ..." autocomplete="off"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control required" id="member_dob" name="member_dob">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dob" class="col-sm-3 control-label">Marital Status</label>
                                            <div class="col-sm-9">
                                                <select class="form-control  required" id="member_status" name="member_status">
                                                    <option value="">----------please select an option---------</option>
                                                    <option>Single</option>
                                                    <option>Married</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Gender</label>
                                            <div class="col-md-9">
                                                <label class="radio-inline">
                                                    <input type="radio"   name="member_gender" id="member_gender" value="male">male
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="member_gender" id="member_gender" value="female">female
                                                </label>
                                                <span id="genderInfo"  class="col-sm-12" style="padding-left: 30px;color: #ff0033" ></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Nationality</label>
                                            <div class="col-sm-9">
                                                <select class="form-control  required" id="member_nationality" name="member_nationality">
                                                    <option value="">----------please select an option---------</option>
                                                    <option>Sinhala</option>
                                                    <option>Tamil</option>
                                                    <option>Muslim</option>
                                                    <option>
                                                        Christian</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="group" class="col-sm-3 control-label">Group</label>
                                            <div class="col-sm-9" id="member_group">
                                                <div class="input-group dropdown">
                                                    <input type="text" class="form-control countrycode dropdown-toggle" >
                                                    <ul class="dropdown-menu">
                                                       
                                                    </ul>
                                                    <span role="button" class="input-group-addon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></span>
                                                </div>
                                                                                        <!--<input type="text" class="form-control required" id="member_group" name="member_group" placeholder="Group number" autocomplete="off">-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-3 control-label">Mobile Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="member_mobile" name="member_mobile" value="+94" placeholder="Mobile number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-3 control-label">Home Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control " id="member_homenumber" name="member_homenumber" placeholder="Home number" autocomplete="off">
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
                                                <input type="text" class="form-control required" id="member_aline1" name="member_aline1" placeholder="Address Line 1" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control required" id="member_aline2" name="member_aline2" placeholder="Address Line 2" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 3</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control " id="member_aline3" name="member_aline3" placeholder="Address Line 3" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Line 4</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control " id="member_addressln4" name="member_aline4" placeholder="Address Line 4" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Husband or Main Guarantor Details</h3>
                                    </div>

                                    <form class="form-horizontal">
                                        <div class="box-body">
                                            <div class="form-group">

                                                <label for="nic" class="col-sm-3 control-label">NIC Number</label>
                                                <div class="col-sm-9">
                                                    <span id="txtHintG"></span>
                                                    <input type="text" class="form-control required" id="guranter_nic" onkeyup="showGuranterName(this.value)" name="guranter_nic" placeholder="NIC number" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="surname" class="col-sm-3 control-label">Surname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control required" id="guranter_surname" name="guranter_surname" placeholder="Surname" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="initial" class="col-sm-3 control-label">Initial</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control required" id="guranter_initial" name="guranter_initial" placeholder="Initial" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-3 control-label" style="padding-top: 0px;">Initial full without surname</label>

                                                <div class="col-sm-9">
                                                    <textarea class="form-control required" rows="2" placeholder="Enter ..." id="guranter_fullInitial" name="guranter_fullInitial" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="surname" class="col-sm-3 control-label">Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="form-control required" id="guranter_dob" name="guranter_dob">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="initial" class="col-sm-3 control-label">Contact Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control required" id="guranter_contact" value="+94" name="guranter_contact" placeholder="Contact NUmber" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="initial" class="col-sm-3 control-label">Address Line 1</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control required" id="guranter_addressln1" name="guranter_addressln1" placeholder="Address Line 1" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="initial" class="col-sm-3 control-label"> Line 2</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control required" id="guranter_addressln2" name="guranter_addressln2" placeholder="Address Line 2" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="initial" class="col-sm-3 control-label"> Line 3</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="guranter_addressln3" name="guranter_addressln3" placeholder="Address Line 3" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="initial" class="col-sm-3 control-label"> Line 4</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control " id="guranter_addressln4" name="guranter_addressln4" placeholder="Address Line 4" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Add Member" name="AddMember"/>
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
        <link href="dist/js/datePicker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="dist/js/datePicker/jquery-ui.js"></script>
    </body>
</html>
