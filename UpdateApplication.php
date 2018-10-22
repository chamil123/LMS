<?php
if (!isset($_SESSION)) {
    session_start();
}
$application_id = $_GET['application_id'];
$member_id = $_GET['member_id'];

error_reporting(E_ERROR || E_WARNING);
require './database/connection.php';
include 'Module/model/ApplicationModel.php';
$application = new Application();
$resultApplication = $application->viewApplicationDetailsAndAddressByID($application_id);
$rowApplication = mysqli_fetch_assoc($resultApplication);

$resultMember = $application->viewMemberById($member_id);
$rowMember = mysqli_fetch_assoc($resultMember);

$resultGuranter = $application->viewGuranterDetailsByApplicationId($application_id);

$my_array = [];
while ($row = mysqli_fetch_array($resultGuranter)) {
    $my_array[] = $row['member_id'];
}
$js_array = json_encode($my_array);
$memberGroup = $rowApplication['member_group'];
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
        <script src="dist/js/ApplicationValidate.js" type="text/javascript"></script>
 <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <style>
            .right_text{
                text-align: right;
            }
        </style>
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
            var Member = [
            ];
            var Guranter = [
            ];

            $(document).on("ready", function () {
                loadData();
                var member_group = "<?php echo $memberGroup ?>";
                getGuranters(member_group);
            });
            var member_group;
            var loadData = function () {
                $.ajax({
                    type: 'POST',
                    url: "getAllMemberAjax.php"
                }).done(function (data) {
                    // alert(data);
                    var pro = JSON.parse(data);
                    for (var i in pro) {
                        member_id = pro[i].member_id;
                        member_number = pro[i].member_number;
                        member_NIC = pro[i].member_NIC;
                        member_surNmae = pro[i].member_surNmae;
                        member_inital = pro[i].member_inital;
                        member_group = pro[i].member_group;

                        guranter_surName = pro[i].guranter_surName;
                        guranter_initial = pro[i].guranter_initial;
                        guranter_contact = pro[i].guranter_contact;
                        guranter_id = pro[i].guranter_id;
                        address_line1 = pro[i].address_line1;
                        address_line2 = pro[i].address_line2;
                        address_line3 = pro[i].address_line3;
                        city_name = pro[i].city_name;

                        Member.push({"label": member_NIC, "member_number": member_number, "member_surNmae": member_surNmae, "member_inital": member_inital, "member_group": member_group,
                            "guranter_surName": guranter_surName, "guranter_initial": guranter_initial, "guranter_contact": guranter_contact, "address_line1": address_line1, "address_line2": address_line2, "address_line3": address_line3, "city_name": city_name, "member_id": member_id});
                    }
                });
            }
            $(document).ready(function () {
                $("#member_nic").autocomplete({source: Member, select: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                        $("#member_name").val(ui.item.member_inital + " " + ui.item.member_surNmae);
                        $("#guranter_name").val(ui.item.guranter_surName + " " + ui.item.guranter_initial);
                        $("#guranter_contact").val(ui.item.guranter_contact);
                        $("#guranter_address").val(ui.item.address_line1 + "\n" + ui.item.address_line2 + ",\n" + ui.item.address_line3 + ",\n" + ui.item.city_name);
                        getGuranters(ui.item.member_group);
                        deleteRows();
                        $("#member_code").val(zeroPad(ui.item.member_id, 10));
                        $("#member_id").val(ui.item.member_id);
                    }});
            });
            function zeroPad(num, places) {
                var zero = places - num.toString().length + 1;
                return Array(+(zero > 0 && zero)).join("0") + num;
            }
            var increment = 0;
            var rowCount;

            function getGuranters(member_group) {
                // alert(member_group);
                $.ajax({
                    type: 'POST',
                    url: "getAllGurantersAjax.php?group_id=" + member_group
                }).done(function (data) {
                    var javascript_array = <?php echo $js_array; ?>;
                    var pro = JSON.parse(data);
                    var member_nic = document.getElementById('member_nic').value;
                    for (var i in pro) {
                        member_number = pro[i].member_number;
                        member_NIC = pro[i].member_NIC;
                        member_surNmae = pro[i].member_surNmae;
                        member_id = pro[i].member_id;

                        var chtnumber = member_number;
                        var rcount = member_NIC;
                        var tpayment = member_surNmae;
                        var memberid = member_id;

                        if (member_nic != rcount) {
                            var tbl = document.getElementById('table1');
                            var lastRow = tbl.rows.length;
                            var iteration = lastRow - 1;
                            var row = tbl.insertRow(lastRow);

                            var checkCell = row.insertCell(0);
                            var el0 = document.createElement('input');
                            el0.class = 'require-one';
                            el0.type = 'checkbox';
                            el0.name = 'check_' + i;
                            el0.id = 'check_' + i;
//                            el0.onclick = function () {
//                               // alert("ggggggggggg");
//                            };
                            checkCell.appendChild(el0);
                            for (var j = 0; j < javascript_array.length; j++) {
                                if (memberid == javascript_array[j]) {
                                    document.getElementById(el0.id).checked = true;
                                }
                            }
                            var firstCell = row.insertCell(1);
                            var el = document.createElement('input');
                            el.type = 'text';
                            el.name = 'name_' + i;
                            el.id = 'name_' + i;
                            el.size = 15;
                            el.maxlength = 15;
                            el.value = member_number;
                            firstCell.appendChild(el);

                            var secondCell = row.insertCell(2);
                            var el2 = document.createElement('input');
                            el2.type = 'text';
                            el2.name = 'address_' + i;
                            el2.id = 'address_' + i;
                            el2.size = 15;
                            el2.maxlength = 15;
                            el2.value = rcount;
                            secondCell.appendChild(el2);

                            var thirdCell = row.insertCell(3);
                            var el3 = document.createElement('input');
                            el3.type = 'text';
                            el3.name = 'contactNum_' + i;
                            el3.id = 'contactNum_' + i;
                            el3.size = 15;
                            el3.maxlength = 15;
                            el3.value = tpayment;
                            thirdCell.appendChild(el3);

                            var forthCell = row.insertCell(4);
                            var el4 = document.createElement('input');
                            el4.type = 'text';
                            el4.name = 'memberID_' + i;
                            el4.id = 'memberID_' + i;
                            el4.size = 8;
                            el4.maxlength = 8;
                            el4.value = memberid;
                            forthCell.appendChild(el4);
                            // alert(i);
//                        frm.h.value = i;

                        }
                        i++;
//                        alert(i);
                    }
                    rowCount = i;
                    document.getElementById('rowcountss').value = parseFloat(rowCount);

                });
            }
            function deleteRows() {
                var table = document.getElementById('table1');
                var rowCount = table.rows.length;

                for (var i = 2; i < rowCount; i++) {
                    var row = table.rows[i];
                    var chkbox = row.cells[1].childNodes[0];
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            function loanCalculations() {
                var loan_amount = document.getElementById('aplication_lamount').value;
                var loan_perioud = document.getElementById('aplication_lperiod').value;

                var aplication_irate = document.getElementById('aplication_irate').value;
                var aplication_months = document.getElementById('aplication_months').value;

                var loantWithInterest = (loan_amount * aplication_irate * aplication_months) / 100;
                document.getElementById('aplication_lamountWithInt').value = parseFloat(loantWithInterest) + parseFloat(loan_amount);
            }
            function loanPerioud() {
                var aplication_lamountWithInt = document.getElementById('aplication_lamountWithInt').value;
                var aplication_lperiod = document.getElementById('aplication_lperiod').value;

                var weeklyDue = aplication_lamountWithInt / aplication_lperiod;
                document.getElementById('aplication_ldue').value = parseFloat(weeklyDue);
            }
        </script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="load()">
        <script type="text/javascript">
            function load() {

                var result = "<?php echo $_SESSION['msgapu'] ?>";

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
<?php $_SESSION['msgapu'] = "" ?>
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
                        Application
                        <small>Update application</small>
                    </h1>
                     <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li><a href="CreateApplication.php">create application</a></li>
                        <li class="active">update application</li>
                    </ol>
                </section>
                <section class="content">
                    <form class="form-horizontal"  name="frm" id="frm" action="Module/controller/AplicationController.php?action=Update"  method="POST" enctype="multiform/form-data">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Basic information</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="nic" class="col-sm-4 control-label">ID Number</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" id="member_nic" name="member_nic" value="<?= $rowMember['member_NIC'] ?>" placeholder="NIC number">
                                                <input type="hidden" class="form-control" id="rowcountss" name="rowcountss">
                                                <input type="hidden" class="form-control" id="member_id" value="<?= $rowMember['member_id'] ?>" name="member_id">
                                                <input type="hidden" class="form-control" id="member_id" value="<?= $application_id ?>" name="application_id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Member name:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="member_name" name="member_name" value="<?= $rowMember['member_inital'] . " " . $rowMember['member_surNmae'] ?>" placeholder="Member name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Client code</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="member_code" name="member_code" value="<?= $rowApplication['application_member_code'] ?>" placeholder="Client code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-4 control-label">Loan Ammount</label>
                                            <div class="col-sm-8">
                                                <input  type="text" style="background-color: #ffffff; font-weight: bold" class="form-control required" name="aplication_lamount"  id="aplication_lamount" onkeyup ="loanCalculations();" value="<?= $rowApplication['application_lamount'] ?>" placeholder="Loan Amount">
                                                <span id="msglamount"  style="color: #ff0000"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="dob" class="col-sm-4 control-label" >Rental Frequance</label>
                                            <div class="col-sm-8">
                                                <select class="form-control required" name="aplication_rentalf" id="aplication_rentalf">
                                                    <option>Weekly</option>
                                                    <option>Monthly</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Period</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" name="aplication_lperiod" id="aplication_lperiod" value="<?= $rowApplication['application_lperiod'] ?>"  placeholder="Week or Month" onkeyup ="loanPerioud();">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dob" class="col-sm-4 control-label">Interest Calculate</label>
                                            <div class="col-sm-5">
                                                <select class="form-control required" name="aplication_intCal" id="aplication_intCal">
                                                    <option>Monthly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control required" name="aplication_months" id="aplication_months" onkeyup ="loanCalculations();"  value="<?= $rowApplication['application_month'] ?>"  placeholder="months" value="3">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Loan Amount with INT</label>
                                            <div class="col-sm-5">
                                                <input style="font-size: 1.3em;font-weight: bold" type="text" class="form-control required" name="aplication_lamountWithInt" value="<?= $rowApplication['application_lamountWithInt'] ?>" id="aplication_lamountWithInt">
                                                <span id="msglamountWithInt"  style="color: #ff0000"></span>
                                            </div>
                                            <div class="col-sm-2" >
                                                <input  type="text" class="form-control required" name="aplication_irate" id="aplication_irate" onkeyup ="loanCalculations();" value="<?= $rowApplication['application_irate'] ?>" placeholder="INT rate" value="10">
                                            </div>
                                            <div class="col-sm-1" style="margin-left:  -10px;padding: 0px">                                               
                                                <label  for="surname" class="col-sm-4 control-label">%</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Weekly or Monthly Due</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" id="aplication_ldue" name="aplication_ldue" value="<?= $rowApplication['application_ldue'] ?>" placeholder="Week or Month">
                                                <span id="msgaplication_ldue"  style="color: #ff0000"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname" class="col-sm-4 control-label">Loan Term</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control required" id="aplication_lterm" name="aplication_lterm" value="<?= $rowApplication['application_lterm'] ?>" placeholder="Week or Month">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Main Gurantor details</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label">Guranter Name:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_name" name="guranter_name" value="<?= $rowApplication['guranter_initial'] . " " . $rowApplication['guranter_surName'] ?>" placeholder="Initial">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Contacts:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="guranter_contact" name="guranter_contact" value="<?= $rowApplication['guranter_contact'] ?>" placeholder="Initial">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="initial" class="col-sm-3 control-label"> Address:</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" cols="35" rows="4" name="guranter_address"  id="guranter_address"><?= $rowApplication['guranter_AddressLine1'] . "\n" . $rowApplication['guranter_AddressLine2'] . "\n" . $rowApplication['guranter_AddressLine3'] . "\n" . $rowApplication['guranter_AddressLine4'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Other Guranters</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="box-body">
                                        <table width="100%" border="2" cellpadding="0" cellspacing="0" id="table1">
                                            <tr >
                                                <th ><strong >Select</strong></th>
                                                <th ><strong >Member Number</strong></th>
                                                <th  ><strong>NIC number</strong> </th>
                                                <th ><strong>Member name</strong> </th>
                                                <th ><strong>id</strong> </th>
                                            </tr>
                                            <tr hidden>
                                                <td><input name="check_0" type="text" id="name_0" size="25" maxlength="25" /></td>
                                                <td><input name="name_0" type="text" id="name_0" size="25" maxlength="25" /></td>
                                                <td><input name="address_0" type="text" id="address_0" size="25" maxlength="25" /></td>
                                                <td><input name="contactNum_0" type="text" id="contactNum_0" size="25" maxlength="15" /></td>
                                                <td><input name="memberID_0" type="text" id="contactNum_0" size="25" maxlength="15" /></td>
                                            </tr>
                                        </table>
<!--                                        <input type="button" value="Add" onclick="addRow();" />
                                        <input name="Submit" type="submit" value="Submit" />-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 15px;">
                            <div class="form-group">
                                <input type="submit" class="btn btn-warning" value="Update Application" name="UpdateAddApplication"/>
                                <!-- <button type="submit" name="submit" class="btn btn-info">
                                     <i class="glyphicon glyphicon-save"></i>
                                     Submit</button>-->
                                <button type="reset" name="reset" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Clear</button>
                            </div>
                        </div>
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
