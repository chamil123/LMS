<?php
$member_id = $_GET['member_id'];

error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/MemberModel.php';

$member = new Member();
$result = $member->viewMemberDetailsByID($member_id);
$row = mysqli_fetch_assoc($result);

$resultGuranter = $member->viewGuranterDetailsByID($member_id);
$rowGurantor = mysqli_fetch_assoc($resultGuranter);

//var_dump($row);
?>
<div class="row" style="margin: 0px;padding: 0px;">
    <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
    <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
    <!--<form  role="form"  action="controller/ArticleController.php" method="POST">-->
    <div class="col-md-12" style="margin: 0px;padding: 0px;">

        <div class="box-body" style="margin: 0px;padding: 0px">
            <div class="col-md-2 " >
                <center>
                    <img src="images/blank_user_icon.png" style="width: 120px"/>
                </center>       

            </div> 
            <div class="col-md-10 " >
                <form class="form-horizontal" action="/action_page.php">


                    <div class="col-md-6"> 
                        <h4 style="margin-bottom: -10px; margin-top: -5px">Member details</h4>
                        <hr/>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="email">Surname:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_surNmae']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">NIC:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_NIC']; ?>">
                            </div>
                        </div>
                     
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Initials:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_inital']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="email">Date of birth:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_dateOfBirth']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Maritial status:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_maritalStatus']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Gender:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_gender']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Nationality:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_nationality']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <h4 style="margin-bottom: -10px; margin-top: -5px">Contact details</h4>
                        <hr/>

                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Mobile Number:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_mobileNumber']; ?>">
                            </div>

                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Home Number:</label>
                            <div class="col-sm-7">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_homeNumber']; ?>">
                            </div>
                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Address line 1:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_AddressLine1']; ?>">
                            </div>

                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd"> line 2:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_AddressLine2']; ?>">
                            </div>

                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd"> line 3:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_AddressLine3']; ?>">
                            </div>

                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">line 4:</label>
                            <div class="col-sm-7">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['member_AddressLine4']; ?>">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-12 " >
                <form class="form-horizontal" action="/action_page.php">
                    <h4 style="margin-bottom: -10px; margin-top: -5px">Gurantor details</h4>
                    <hr/>

                    <div class="col-md-6"> 
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-6" for="email">Surname:</label>
                            <div class="col-sm-6" style="margin-bottom: -15px">
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_surName']; ?>">
                            </div>
                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-6" for="pwd">NIC:</label>
                            <div class="col-sm-6" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_NIC']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-6" for="pwd">Initials without surname::</label>
                            <div class="col-sm-6" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_initialInFulWithoutSurname']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-6" for="pwd">Initial:</label>
                            <div class="col-sm-6" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_initial']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-6" for="pwd">Date of birth</label>
                            <div class="col-sm-6" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_dateOfBirth']; ?>">
                            </div>
                        </div>
                       
                        
                    </div>
                   <div class="col-md-6"> 
                       
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Mobile Number:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_contact']; ?>">
                            </div>

                        </div>
                    
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Address line 1:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_AddressLine1']; ?>">
                            </div>

                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd"> line 2:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_AddressLine2']; ?>">
                            </div>

                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd"> line 3:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_AddressLine3']; ?>">
                            </div>

                        </div>
                         <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">line 4:</label>
                            <div class="col-sm-7">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $rowGurantor['guranter_AddressLine4']; ?>">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!--</form>-->
</div>

