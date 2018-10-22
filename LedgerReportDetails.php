<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require './database/connection.php';
$application_id = $_GET['application_id'];
$member_AnyNumber= $_GET['member_AnyNumber'];

include './Module/model/LedgerReportModel.php';
include './Module/model/DailyCollectionModel.php';

$ledger = new LedgerReport();
$dailyCollection = new DailyCollection();
$result = $ledger->viewApplicationByApplication_ID($application_id);
$row = mysqli_fetch_assoc($result);

$date2 = strtotime($row['application_activateDate']);
$date2 = strtotime("+1 day", $date2);
$lastPaymentDatePlusOne = date('Y-m-d', $date2);
$next_day = date('Y-m-d', strtotime($row['center_date'], strtotime($lastPaymentDatePlusOne)));

$loanPerioud = $row['application_lperiod'];
?>
<div class="row" style="margin: 0px;padding: 0px;">
    <div id="ss" class="alert-boxs  response-content " style="margin: 0px 15px 10px 15px"></div> 
    <div class="alert alert-box success " style="margin: 0px 15px 10px 15px">Successfully added record</div>
    <!--<form  role="form"  action="controller/ArticleController.php" method="POST">-->
    <div class="col-md-12" style="margin: 0px;padding: 0px;">

        <div class="box-body" style="margin: 0px;padding: 0px">

            <div class="col-md-12 " >
                <form class="form-horizontal" action="/action_page.php">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Loan amount:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control inputColor" style="border:hidden"  value="<?= $row['application_lamount'] ?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Loan with interest  :</label>
                        <div class="col-sm-6">          
                            <input type="text" class="form-control inputColor" style="border:hidden"  value="<?= $row['application_lamountWithInt'] ?>">
                        </div>
                        <div class="col-sm-3 ">
                            <a href="Module/controller/LedgerReportController.php?application_id=<?php echo $row['application_id']; ?>&member_AnyNumber=<?=$member_AnyNumber?>&action=excel"  style="color: white">  <button type="button" class="btn btn-warning pull-right">
                                    <i class="fa fa-file-excel-o" style="padding-right: 5px;"></i> Download Excel File</button>
                            </a> 
                        </div>
                    </div>
                  


                    <div class="row">
                        <table class="table table-striped" width="100%" id="customer_data">

                            <thead>
                                <tr>
                                    <th>&nbsp;No Of Installment&nbsp;</th>
                                    <th>Due date&nbsp;</th>
                                    <th>Due amount&nbsp;</th>
                                    <th> Collection date&nbsp;</th>
                                    <th>Collection amount&nbsp;</th>
                                    <th class="pull-right">Balance&nbsp;</th>
                                </tr>
                            </thead>


                            <tbody>

                                <?php
                                $newDate = $next_day;
                                $lastPaymentss = "";
                                $tempdate = "1970-01-01";
                                $total = 0;
                                for ($i = 1; $i < $loanPerioud; $i++) {
                                    $dailycollectionDate = "not paid";
                                    if ($lastPaymentss == "") {
                                        $lastPaymentss = $next_day;
                                    }
                                    $dailyCollection = new DailyCollection();
                                    $rowDaily = $dailyCollection->viewAllByApplicationID($row['application_id']);
                                    $increment = 0;
                                    $val = 0;
                                    $amountToBePaid = 0;

                                    while ($rows = mysqli_fetch_assoc($rowDaily)) {
                                        $dailycollectionDate = $rows["dailycollection_date"];
                                        $amountToBePaid = $rows["dailycollection_amount_paid"];
                                        $loanWithInt = $rows["application_lamountWithInt"];


                                        if ($tempdate < $dailycollectionDate && $lastPaymentss >= $dailycollectionDate) {
                                            $total = $total + $amountToBePaid;
                                            $balance = $loanWithInt - $total;
                                            ?>
                                            <tr>
                                                <td style="text-align: left;"><?php echo $i; ?></td>
                                                <td style="text-align: left;"><?php echo $lastPaymentss; ?></td>
                                                <td style="text-align: left;"><?php echo $row['application_ldue']; ?></td>
                                                <td style="text-align: left;"><?php echo $dailycollectionDate; ?></td>
                                                <td style="text-align: left;"><?php echo $amountToBePaid; ?></td>

                                                <td style="text-align: left;"><?php echo $balance; ?></td>
                                            </tr>
                                            <?php
                                            $val = 1;
                                        }
                                        $amountToBePaid = 0;
                                        $increment++;
                                    }

                                    if ($val == 0) {
                                        $dailycollectionDate = 0;
                                        ?>
                                        <tr>
                                            <td style="text-align: left;"><?php echo $i; ?></td>
                                            <td style="text-align: left;"><?php echo $lastPaymentss; ?></td>
                                            <td style="text-align: left;"><?php echo $row['application_ldue']; ?></td>
                                            <td style="text-align: left;"><?php echo $dailycollectionDate; ?></td>
                                            <td style="text-align: left;"><?php echo $amountToBePaid; ?></td>

                                            <td style="text-align: left;"><?php echo $balance; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    $tempdate = $lastPaymentss;

                                    $date2 = strtotime($newDate);
                                    $date2 = strtotime("+7 day", $date2);
                                    $lastPaymentss = date('Y-m-d', $date2);
                                    $newDate = $lastPaymentss;
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <!--</form>-->
</div>