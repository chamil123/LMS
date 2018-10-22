<?php
$user_id = $_GET['user_id'];

error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/UserModel.php';

$user = new User();
$result = $user->viewUserDetailsByID($user_id);
$row = mysqli_fetch_assoc($result);

$resultModule = $user->getModule();
?>
<div class="row" style="margin: 0px;padding: 0px;">
    <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
    <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
    <!--<form  role="form"  action="controller/ArticleController.php" method="POST">-->
    <div class="col-md-12" style="margin: 0px;padding: 0px;">

        <div class="box-body" style="margin: 0px;padding: 0px">
            <div class="col-md-2 " >
                <center>
                    <img src="Sourse Files/uploads/<?php echo $row['user_image']; ?>" style="width: 120px"/>
                </center>       

            </div> 
            <div class="col-md-10 " >
                <form class="form-horizontal" action="/action_page.php">


                    <div class="col-md-6"> 
                        <h4 style="margin-bottom: -10px; margin-top: -5px">User details</h4>
                        <hr/>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="email">First name:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_firstName']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Last name::</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_lastName']; ?>">
                            </div>
                        </div>


                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="email">NIC number:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_NIC_number']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Date Of birth:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_DOB']; ?>">
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Gender :</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_gender']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">User role:</label>
                            <div class="col-sm-7">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['role_name']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <h4 style="margin-bottom: -10px; margin-top: -5px">Contact details</h4>
                        <hr/>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Email:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_email']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Phone Number:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_phoneNumber']; ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -15px">
                            <label class="control-label col-sm-5" for="pwd">Address:</label>
                            <div class="col-sm-7" style="margin-bottom: -15px">          
                                <input type="text" style="border: hidden" class="form-control" value="<?php echo $row['user_address']; ?>">
                            </div>

                        </div>


                    </div>

                </form>
            </div>
            <div class="col-md-12 " >
                <form class="form-horizontal" action="/action_page.php">
                    <h4 style="margin-bottom: -10px; margin-top: -5px">Permission details</h4>
                    <hr/>
                    <div class="row">

                        <?php while ($row = mysqli_fetch_array($resultModule)) { ?>
                            <div class="col-md-3">
                                <b>
                                    <label class="control-label" for=""><?= $row['module_name'] ?> </label>
                                </b>
                                <br/>
                                <div class="col-lg-12 col-sm-12 col-md-12">&nbsp;</div>
                                <?php
                                $m = $row['module_id'];
                                $resultRights = $user->viewModuleRights($m);
                                ?>
                                <?php
                                while ($rowrights = mysqli_fetch_array($resultRights)) {
                                    $number = 0;
                                    $resultRightsByuser = $user->viewAllRightsByUser($user_id);
                                    while ($rowrightsUser = mysqli_fetch_array($resultRightsByuser)) {
                                        if ($rowrights['rights_id'] == $rowrightsUser['rights_id']) {
                                            $r_id = $rowrights['rights_id'];
                                            echo "<input type='checkbox' name='user_rights[]' checked=checked value='$r_id'/>&nbsp;&nbsp;&nbsp;";
                                            echo '' . $rowrights['rights_name'] . "<br/>";
                                            $number = 1;
                                        }
                                    }
                                    if ($number == 0) {
                                        $r_id = $rowrights['rights_id'];
                                        echo "<input type='checkbox' name='user_rights[]'  value='$r_id'/>&nbsp;&nbsp;&nbsp;";
                                        echo '' . $rowrights['rights_name'] . "<br/>";
                                    }
                                    $number = 0;
                                }
                                ?>
                                <div class="col-lg-12 col-sm-12 col-md-12">&nbsp;</div>
                            </div>
                        <?php } ?>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <!--</form>-->
</div>

