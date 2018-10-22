<?php
$application_id = $_GET['application_id'];

error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/ApplicationModel.php';

$application = new Application();
$result = $application->dailyCollectionByApplicationID($application_id);
?>
<div class="row" style="margin: 0px;padding: 0px;">
    <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
    <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
    <!--<form  role="form"  action="controller/ArticleController.php" method="POST">-->
    <div class="col-md-12" style="margin: 0px;padding: 0px;">

        <div class="box-body" style="margin: 0px;padding: 0px">

            <div class="col-md-12 " >
                <table class="table table-striped" id="usermanagement" width="70%">
                    <tr>
                        <th>&nbsp;No&nbsp;</th>
                        <th>Date &nbsp;</th>
                        <th style="text-align: right;">Weekly due&nbsp;</th>
                        <th style="text-align: right;">Total due&nbsp;</th>
                       
                       
                    </tr>
                    <?php
                    $amount=0;
                    while ($row = mysqli_fetch_array($result)) {
                        $dailycollection_id = $row['dailycollection_id'];
                        $dailycollection_date  = $row['dailycollection_date'];
                        $dailycollection_amount_paid = $row['dailycollection_amount_paid'];
                     $amount+=$dailycollection_amount_paid;
                       
                        ?>
                        <tr>
                            <td style="text-align: left;"><?php echo $dailycollection_id; ?></td>
                            <td style="text-align: left;"><?php echo $dailycollection_date; ?></td>
                            <td style="text-align: right;"><?php echo $dailycollection_amount_paid ?></td>
                            <td style="text-align: right;"><?php echo $amount ?></td>
                            
                           
                            
                         
                        </tr>

                        <?php
                    }
                    ?>
                </table>
            </div>
       
        </div>
    </div>
    <!--</form>-->
</div>

