<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/MemberModel.php';
include './includes/session_handling.php';

$getValue = $_GET['searhValue'];
$searchCombo = $_GET['searchCombo'];

$member = new Member();

//if ($getValue == "") {
//    $result = $member->viewAllMembersWithMemberCode();
//} else {
    if ($searchCombo == "Search by Center") {
        $result = $member->serchByCenter($getValue);
    } else if ($searchCombo == "Search by membr number") {
        $result = $member->serchByMemberNum($getValue);
    } else if ($searchCombo == "Search by NIC number") {
        $result = $member->serchByNicNum($getValue);
    } else if ($searchCombo == "Search by Application ID") {
        $result = $member->serchByAppID($getValue);
    }
//}
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
        <!--<script src="dist/js/jquery.dataTables.js" type="text/javascript"></script>-->
        <!--<script src="dist/js/dataTables.bootstrap.min.js" type="text/javascript"></script>-->

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


                function setValuesToModal(val) {
                    var applicationid = val;
                    $.ajax({
                        type: 'POST',
                        url: "SetValuesToModal.php?application_id=" + applicationid
                    }).done(function (data) {
                        // alert(data);
                        var pro = JSON.parse(data);
                        //  alert(data);
                        for (var i in pro) {
                            member_id = pro[i].member_id;
                            member_number = pro[i].member_number;
                            member_surNmae = pro[i].member_surNmae;
                            application_ldue = pro[i].application_ldue;
                            application_id = pro[i].application_id;

                            document.getElementById('m_id').value = member_id
                            document.getElementById('m_number').value = member_number;
                            document.getElementById('m_surname').value = member_surNmae;
                            document.getElementById('m_weeklyDue').value = application_ldue;
                            document.getElementById('payAnount').value = application_ldue;
                            document.getElementById('application_id').value = application_id;

                        }
                    });

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
                        Daily Collection
                        <small>Create daily collection</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Add daily collection</li>
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
                                        <div class="col-md-6 col-md-offset-6 pull-right">

                                            <div class="col-md-5" style="width: 230px">
                                                <select class=" form-control " name="serchCombo" id="serchCombo" onchange="changeColor()">
                                                    <option >Search by membr number</option>
                                                    <option >Search by NIC number</option>
                                                    <option >Search by Center</option>
                                                    <option >Search by Application ID</option>
                                                </select>
                                            </div> 

                                            <div class="col-md-5" style="margin-left: -10px">
                                                <input type="text" name="serchBox" id="serchBox" class=" form-control " /> 
                                            </div>
                                            <div class="col-md-2" style="margin-left: -10px">
                                                <button type="submit" class="btn btn-primary" name="searchPayment">
                                                    <span class="glyphicon glyphicon-search"></span> Search
                                                </button>
                                            </div>



                                        </div>

                                        <table class="table table-striped" width="100%" id="example">

                                            <thead>
                                                <tr>
                                                    <th>&nbsp;Id</th>
                                                    <th>Member Number&nbsp;</th>
                                                    <th>Member Name</th>
                                                    <th> Code</th>
                                                    <th> NIC Number</th>
                                                    <th>Center</th>
                                                    <th>Group</th>
                                                    <th>Loan Amount</th>
                                                    <th>Loan Outstanding</th>
                                                    <th>Weekly Due</th>
                                                    <th >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paid amount</th>

                                                <!--<th>Action&nbsp;</th>-->
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                $increment = 0;
                                                if (isset($_SESSION["BRANCH_CODE"])) {

                                                    while ($row = mysqli_fetch_array($result)) {
                                                        if ($_SESSION["BRANCH_CODE"] == $row['member_branchNumber']) {
                                                            $availableAmt = $member->availableAmount($row['application_id']);
                                                            $rows = mysqli_fetch_array($availableAmt);

                                                            $member_id = $row['member_id'];
                                                            $member_code = $row['member_code'];
                                                            $application_id = $row['application_id'];
                                                            $member_number = $row['member_number'];
                                                            $member_inital = $row['member_inital'];
                                                            $member_surNmae = $row['member_surNmae'];
                                                            $member_NIC = $row['member_NIC'];


                                                            $center = $row['center_name'];
                                                            $application_lamount = $row['application_lamount'];
                                                            $application_lamountWithInt = $row['application_lamountWithInt'];
                                                            $application_payAmount = $rows['amt'];
                                                            $availableAmount = $application_lamountWithInt - $application_payAmount;
                                                            $application_ldue = $row['application_ldue'];

                                                            $group = $row['member_group'];
                                                            $status = $row['member_status'];
                                                            ?>

                                                            <?php
                                                            if ($tem == $group) {
                                                                
                                                            } else {
                                                                $tem = $group;
                                                                ?>
                                                                <tr style="background-color: #e6f8ff;color: #adadad" ><td colspan="11" >Group number is :   <?= $group ?></td></tr>
                                                                <?php
                                                            }
                                                            ?>

                                                            <tr>
                                                        <input type="hidden" id="m_id<?= $increment ?>" name="m_id<?= $increment ?>" value="<?= $member_id ?>"/>
                                                        <td style="text-align: left;"><input type="text" id="app_id<?= $increment ?>" name="app_id<?= $increment ?>" style="width: 50px;border: hidden" value="<?php echo $application_id; ?>"/></td>
                                                        <td style="text-align: left;"><?php echo $member_number; ?></td>
                                                        <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                        <td style="text-align: left;"><?php echo $member_code ?></td>
                                                        <td style="text-align: left;"><?php echo $member_NIC; ?></td>

                                                        <td style="text-align: left;"><?php echo $center; ?></td>
                                                        <td style="text-align: left;"><?php echo $group; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_lamount; ?></td>

                                                        <?php
                                                        if ($availableAmount > 0) {
                                                            ?>
                                                            <td style="text-align: left;font-weight: bold;color: #0000ff;font-size: 1.2em;"><?php echo $availableAmount; ?></td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td style="text-align: left;font-weight: bold;color: #cc0000;font-size: 1.2em;"><?php echo $availableAmount; ?></td>
                                                            <?php
                                                        }
                                                        ?>
                                                        <td style="text-align: left;font-weight: bold"><?php echo $application_ldue; ?></td>        
                                                      <td style="text-align: left;"><input type="text"  id="pay<?= $increment ?>" name="pay<?= $increment ?>"class="form-control pull-right" style="width:90px" value="<?php echo $application_ldue; ?>"/></td>                                                                                                                  <!--<td style="text-align: left;"><input type="text" class="form-control" name="pay<?= $rowcount ?>"></td>-->


                                                        </tr>
                                                        <?php
                                                    }
                                                    $increment++;
                                                }
                                            } else {
                                                while ($row = mysqli_fetch_array($result)) {
                                                             $availableAmt = $member->availableAmount($row['application_id']);
                                                            $rows = mysqli_fetch_array($availableAmt);

                                                            $member_id = $row['member_id'];
                                                            $member_code = $row['member_code'];
                                                            $application_id = $row['application_id'];
                                                            $member_number = $row['member_number'];
                                                            $member_inital = $row['member_inital'];
                                                            $member_surNmae = $row['member_surNmae'];
                                                            $member_NIC = $row['member_NIC'];


                                                            $center = $row['center_name'];
                                                            $application_lamount = $row['application_lamount'];
                                                            $application_lamountWithInt = $row['application_lamountWithInt'];
                                                            $application_payAmount = $rows['amt'];
                                                            $availableAmount = $application_lamountWithInt - $application_payAmount;
                                                            $application_ldue = $row['application_ldue'];

                                                            $group = $row['member_group'];
                                                            $status = $row['member_status'];
                                                            ?>

                                                            <?php
                                                            if ($tem == $group) {
                                                                
                                                            } else {
                                                                $tem = $group;
                                                                ?>
                                                                <tr style="background-color: #e6f8ff;color: #adadad" ><td colspan="11" >Group number is :   <?= $group ?></td></tr>
                                                                <?php
                                                            }
                                                            ?>

                                                            <tr>
                                                        <input type="hidden" id="m_id<?= $increment ?>" name="m_id<?= $increment ?>" value="<?= $member_id ?>"/>
                                                        <td style="text-align: left;"><input type="text" id="app_id<?= $increment ?>" name="app_id<?= $increment ?>" style="width: 50px;border: hidden" value="<?php echo $application_id; ?>"/></td>
                                                        <td style="text-align: left;"><?php echo $member_number; ?></td>
                                                        <td style="text-align: left;"><?php echo $member_inital . " " . $member_surNmae ?></td>
                                                        <td style="text-align: left;"><?php echo $member_code ?></td>
                                                        <td style="text-align: left;"><?php echo $member_NIC; ?></td>

                                                        <td style="text-align: left;"><?php echo $center; ?></td>
                                                        <td style="text-align: left;"><?php echo $group; ?></td>
                                                        <td style="text-align: left;"><?php echo $application_lamount; ?></td>

                                                        <?php
                                                        if ($availableAmount > 0) {
                                                            ?>
                                                            <td style="text-align: left;font-weight: bold;color: #0000ff;font-size: 1.2em;"><?php echo $availableAmount; ?></td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td style="text-align: left;font-weight: bold;color: #cc0000;font-size: 1.2em;"><?php echo $availableAmount; ?></td>
                                                            <?php
                                                        }
                                                        ?>
                                                        <td style="text-align: left;font-weight: bold"><?php echo $application_ldue; ?></td>        
                                                      <td style="text-align: left;"><input type="text"  id="pay<?= $increment ?>" name="pay<?= $increment ?>"class="form-control pull-right" style="width:90px" value="<?php echo $application_ldue; ?>"/></td>                                                                                                                  <!--<td style="text-align: left;"><input type="text" class="form-control" name="pay<?= $rowcount ?>"></td>-->


                                                        </tr>
                                                        <?php
                                                    $increment++;
                                                }
                                            }
                                            ?>
                                            <input type="hidden" id="rowcount" name="rowcount" value="<?= $increment ?>" />
                                            </tbody>

                                        </table>
                                         <!--<input type="submit" class="btn btn-primary" value="Add Application" />-->
                                        <input type="submit"  value="Paid" class="btn btn-danger pull-right" style="margin-right: 8px;width: 90px" name="dailyCollection" >

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </section>
            </div>

            <!--             Modal 
                        <div class="modal fade position" id="myModal" role="dialog" style="padding-top:  150px;">
                            <div class="modal-dialog" style="width: 40%">
                                <form class="form-horizontal" action="Module/controller/DailyCollectionController.php" method="POST" >
                                     Modal content
                                    <div class="modal-content">
                                        <div class="modal-header" style="padding: 10px">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Modal Header</h4>
                                        </div>
                                        <div class="modal-body">
            
                                            <div id="" style="font-size: 13px;align-content: flex-start;padding: 10px">
                                                <div class="form-group" style="margin-bottom: 0px">
            
                                                    <div class="col-sm-3" style="margin-bottom: -15px">          
                                                        <div class="form-group">
                                                            <label >Member Number</label>
                                                            <input type="hidden"  id="m_id"  name="m_id" >
                                                            <input type="hidden"  id="application_id"  name="application_id" >
                                                            <input type="text" style="border-color: #ffffff;"readonly  class="form-control" id="m_number"  name="m_number" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3" style="margin-bottom: -15px">          
                                                        <div class="form-group">
                                                            <label >Name</label>
                                                            <input type="text" style="border-color: #ffffff"readonly  class="form-control" id="m_surname"  name="m_surname" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3" style="margin-bottom: -15px">          
                                                        <div class="form-group">
                                                            <label >Weekly due</label>
                                                            <input type="text" style="border-color: #ffffff"readonly   class="form-control" id="m_weeklyDue"  name="m_weeklyDue">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3" style="margin-bottom: -15px">          
                                                        <div class="form-group">
                                                            <label >Pay amount</label>
                                                            <input type="text" id="payAnount" name="payAnount" autofocus class="form-control" >
                                                        </div>
                                                    </div>
            
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="modal-footer" style="padding: 10px">
                                            <input type="submit" class="btn btn-primary" value="pay " name="AddPayment" />
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
            
                            </div>
                        </div>-->
            <?php include 'includes/footer.php'; ?>
        </div>

    </body>

</html>
