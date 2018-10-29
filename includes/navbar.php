<?php
if (!isset($_SESSION)) {
    session_start();
}
$branch_Id = $_SESSION["BRANCH_ID"];
?>
<!--<script src="../dist/js/jquery-1.8.3.min.js" type="text/javascript"></script>-->
                <!--<script src="../dist/js/app.min.js"></script>-->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left info">
                <p style="font-weight: normal;color: #cccccc"> <small> </small></p>
            </div>
        </div>
        <ul class="sidebar-menu">

            <!-- admin dashboard-->

            <li class="header" style="text-align: center">MAIN NAVIGATION </li>
            <li class="treeview">
                <a href="Dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>

                    <span>Dashboard</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <!--                <ul class="treeview-menu">
                                    <li><a href="CreateCenter.php"><i class="fa fa-circle-o"></i> Create Center</a></li>
                                    <li><a href="ViewCenters.php"><i class="fa fa-circle-o"></i>View Centers</a></li>
                                </ul>-->
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fas fa-building"></i>

                    <span>Center Management</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <?php
                    if ($branch_Id != "") {
                        ?>

                        <li><a href="CreateCenter.php"><i class="far fa-circle"></i> Create Center</a></li>
                    <?php } ?>
                    <li><a href="ViewCenters.php"><i class="far fa-circle"></i> View Centers</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fas fa-address-book"></i>
                    <span>Member management</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <?php
                    if ($branch_Id != "") {
                        ?>
                        <li><a href="AddMember.php"><i class="far fa-circle"></i> Add member</a></li>
                    <?php } ?>
                    <li><a href="ViewMembers.php"><i class="far fa-circle"></i> View Members</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fas fa-file-alt"></i>
                    <span >Application Management</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="CreateApplication.php"><i class="far fa-circle"></i> Create Application</a></li>

                    <li><a href="ViewApplication.php"><i class="far fa-circle"></i> Active Application</a></li>
                    <li><a href="CloseApplications.php"><i class="far fa-circle"></i> Close Application</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="ContractInquiry.php">
                    <i class="fas fa-handshake"></i>
                    <span>Contract Inquiry</span>
                    <span class="label label-primary pull-right"></span>
                </a>

            </li>
            <li class="treeview">
                <a href="#">
                    <i class="far fa-calendar-alt"></i>

                    <span >Daily Collection</span>
                    <span class="label label-primary pull-right"></span>
                </a>
                <ul class="treeview-menu">

                    <li><a href="DailyCollection.php"><i class="far fa-circle"></i> Create Collection</a></li>

                    <li><a href="DailyCollectionHistory.php"><i class="far fa-circle"></i> View Collection</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fas fa-user"></i>
                    <span>User Management</span>
                    <span class="label label-primary pull-right"></span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="AddUser.php"><i class="far fa-circle"></i> Add User</a></li>
                    <li><a href="ViewUsers.php"><i class="far fa-circle"></i> View User</a></li>
                </ul>

            </li>
            <li class="treeview">
                <a href="">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span><label class="badge info" style="height: 17px;background-color: #009999;margin-left: 10px">5</label>
                    <span class="label label-primary pull-right"></span>


                </a>

                <ul class="treeview-menu">
                    <li><a href="ArreasReport.php"><i class="far fa-circle"></i> Arreas report</a></li>
                    <li><a href="LoanIssuedReport.php"><i class="far fa-circle"></i> Detail of loan issued</a></li>
                    <li><a href="LoanOutstanding.php"><i class="far fa-circle"></i>  Loan Outstanding report</a></li>
                    <li><a href="LedgerReport.php"><i class="far fa-circle"></i>  Ledger Report</a></li>
                    <li><a href="RepaymentSheet.php"><i class="far fa-circle"></i>  Repayment sheet</a></li>
                </ul>

            </li>
            <li class="treeview">
                <a href="">
                    <i class="fas fa-database"></i>
                    <span>Data Management</span>
                    <span class="label label-primary pull-right"></span>
                </a>

            </li>
            <li class="treeview">
                <a href="">
                    <i class="far fa-address-book"></i>
                    <span>Logs management</span>
                    <span class="label label-primary pull-right"></span>
                </a>

            </li>

        </ul>
    </section>
</aside>
