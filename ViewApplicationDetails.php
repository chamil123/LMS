<?php
$application_id = $_GET['application_id'];

error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/ApplicationModel.php';

$application = new Application();
$result = $application->viewApplicationDetailsByID($application_id);
$row = mysqli_fetch_assoc($result);

$resultMember = $application->viewMemberDetailsByApplicationId($application_id);
$rowMember = mysqli_fetch_assoc($resultMember);

$resultGuranter = $application->viewGuranterDetailsByApplicationId($application_id);

?>
<div class="row" style="margin: 0px;padding: 0px;">
    <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
    <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
    <!--<form  role="form"  action="controller/ArticleController.php" method="POST">-->
    <div class="col-md-12" style="margin: 0px;padding: 0px;">

        <div class="box-body" style="margin: 0px;padding: 0px">
            
            <div class="col-md-12 " >
                <form class="form-horizontal" action="/action_page.php">


                    <div class="col-md-6"> 
                        <h4 style="margin-bottom: -10px; margin-top: -5px">Member details</h4>
                        <hr/>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="email">Member Name:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowMember['member_inital'] . " " . $rowMember['member_surNmae']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">NIC:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowMember['member_NIC']; ?>">
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: -5px">
                            <label class="control-label col-sm-5" for="pwd"> Image:</label>
                            <div class=" col-sm-7" style="margin-bottom: -15px">          
                                <img src="images/blank_user_icon.png" style="width: 120px"/>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6"> 
                        <h4 style="margin-bottom: -10px; margin-top: -5px">Loan details</h4>
                        <hr/>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Date:</label>
                            <div class="col-sm-7">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_date']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Loan Amountr:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_lamount']; ?>">
                            </div>

                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Rental Frequance:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_rentalf']; ?>">
                            </div>

                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Loan Period:</label>
                            <div class="col-sm-7">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_lperiod']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Interest Calculate:</label>
                            <div class="col-sm-7">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_intCal']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Loan With Interest:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_lamountWithInt']; ?>">
                            </div>

                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd"> Due:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_ldue']; ?>">
                            </div>

                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd"> Loan Terms:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['application_lterm']; ?>">
                            </div>

                        </div>

                    </div>

                </form>
            </div>
            <div class="col-md-12 " >
                <form class="form-horizontal" action="/action_page.php">
                    <h4 style="margin-bottom: -10px; margin-top: -5px">Gurantor details</h4>
                    <hr/>

                    <div class="col-md-12"> 
                        <table class="table table-striped">
                            <tr>
                                <th>Member Number</th>
                                <th>NIC Number</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                            </tr>
                            <?php while ($row = mysqli_fetch_array($resultGuranter)) { ?>
                                <tr>
                                    <td><?= $row ['member_number']; ?></td>
                                    <td><?= $row ['member_NIC']; ?></td>
                                    <td><?= $row ['member_inital'] . " " . $row ['member_surNmae']; ?></td>
                                    <td><?= $row ['member_mobileNumber']; ?></td>
                                </tr>
                            <?php } ?>



                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--</form>-->
</div>

