<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ERROR || E_WARNING);
require_once './database/connection.php';
include 'Module/model/MemberModel.php';
include './includes/session_handling.php';

$member = new Member();

$result = $member->viewAllMembers();
$user_id = $_SESSION['user_id'];

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
        <script src="dist/js/jquery.dataTables.js" type="text/javascript"></script>
        <script src="dist/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

        <script src="dist/js/app.min.js"></script>
       <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

        <script src="plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script>
            var chart;

            var chartData = [
                {
                    "year": 1995,
                    "cars": 1567,
                    "motorcycles": 683,
                    "bicycles": 146
                },
                {
                    "year": 1996,
                    "cars": 1617,
                    "motorcycles": 691,
                    "bicycles": 138
                },
                {
                    "year": 1997,
                    "cars": 1630,
                    "motorcycles": 642,
                    "bicycles": 127
                },
                {
                    "year": 1998,
                    "cars": 1660,
                    "motorcycles": 699,
                    "bicycles": 105
                },
                {
                    "year": 1999,
                    "cars": 1683,
                    "motorcycles": 721,
                    "bicycles": 109
                },
                {
                    "year": 2000,
                    "cars": 1691,
                    "motorcycles": 737,
                    "bicycles": 112
                },
                {
                    "year": 2001,
                    "cars": 1298,
                    "motorcycles": 680,
                    "bicycles": 101
                },
                {
                    "year": 2002,
                    "cars": 1275,
                    "motorcycles": 664,
                    "bicycles": 97
                },
                {
                    "year": 2003,
                    "cars": 1246,
                    "motorcycles": 648,
                    "bicycles": 93
                },
                {
                    "year": 2004,
                    "cars": 1218,
                    "motorcycles": 637,
                    "bicycles": 101
                },
                {
                    "year": 2005,
                    "cars": 1213,
                    "motorcycles": 633,
                    "bicycles": 87
                },
                {
                    "year": 2006,
                    "cars": 1199,
                    "motorcycles": 621,
                    "bicycles": 79
                },
                {
                    "year": 2007,
                    "cars": 1110,
                    "motorcycles": 210,
                    "bicycles": 81
                },
                {
                    "year": 2008,
                    "cars": 1165,
                    "motorcycles": 232,
                    "bicycles": 75
                },
                {
                    "year": 2009,
                    "cars": 1145,
                    "motorcycles": 219,
                    "bicycles": 88
                },
                {
                    "year": 2010,
                    "cars": 1163,
                    "motorcycles": 201,
                    "bicycles": 82
                },
                {
                    "year": 2011,
                    "cars": 1180,
                    "motorcycles": 285,
                    "bicycles": 87
                },
                {
                    "year": 2012,
                    "cars": 1159,
                    "motorcycles": 277,
                    "bicycles": 71
                }
            ];

            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();

                chart.dataProvider = chartData;
                chart.marginTop = 10;
                chart.categoryField = "year";

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridAlpha = 0.07;
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.startOnAxis = true;

                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "regular"; // this line makes the chart "stacked"
                valueAxis.gridAlpha = 0.07;
                valueAxis.title = "sample";
                chart.addValueAxis(valueAxis);

                // GUIDES are vertical (can also be horizontal) lines (or areas) marking some event.
                // first guide
                var guide1 = new AmCharts.Guide();
                guide1.category = "2001";
                guide1.lineColor = "#CC0000";
                guide1.lineAlpha = 1;
                guide1.dashLength = 2;
                guide1.inside = true;
                guide1.labelRotation = 90;
                guide1.label = "sample";
                categoryAxis.addGuide(guide1);

                // second guide
                var guide2 = new AmCharts.Guide();
                guide2.category = "2007";
                guide2.lineColor = "#CC0000";
                guide2.lineAlpha = 1;
                guide2.dashLength = 2;
                guide2.inside = true;
                guide2.labelRotation = 90;
                guide2.label = "sample";
                categoryAxis.addGuide(guide2);


                // GRAPHS
                // first graph
                var graph = new AmCharts.AmGraph();
                graph.type = "line"; // it's simple line graph
                graph.title = "sample";
                graph.valueField = "cars";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.6; // setting fillAlphas to > 0 value makes it area graph
                graph.balloonText = "<img src='images/car.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>";
                graph.hidden = true;
                chart.addGraph(graph);

                // second graph
                graph = new AmCharts.AmGraph();
                graph.type = "line";
                graph.title = "sample";
                graph.valueField = "motorcycles";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.6;
                graph.balloonText = "<img src='images/motorcycle.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>";
                chart.addGraph(graph);

                // third graph
                graph = new AmCharts.AmGraph();
                graph.type = "line";
                graph.title = "sample";
                graph.valueField = "bicycles";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.6;
                graph.balloonText = "<img src='images/bicycle.png' style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'><b>[[value]]</b></span>";
                chart.addGraph(graph);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.position = "top";
                legend.valueText = "[[value]]";
                legend.valueWidth = 100;
                legend.valueAlign = "left";
                legend.equalWidths = false;
                legend.periodValueText = "total: [[value.sum]]"; // this is displayed when mouse is not over the chart.
                chart.addLegend(legend);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chartScrollbar.color = "#FFFFFF";
                chart.addChartScrollbar(chartScrollbar);

                // WRITE
                chart.write("chartdiv");
            });
        </script>
        <script>
            var chart;

            var chartDatas = [
                {
                    "year": 2005,
                    "income": 23.5,
                    "expenses": 18.1
                },
                {
                    "year": 2006,
                    "income": 26.2,
                    "expenses": 22.8
                },
                {
                    "year": 2007,
                    "income": 30.1,
                    "expenses": 23.9
                },
                {
                    "year": 2008,
                    "income": 29.5,
                    "expenses": 25.1
                },
                {
                    "year": 2009,
                    "income": 24.6,
                    "expenses": 25
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                charts = new AmCharts.AmSerialChart();
                charts.dataProvider = chartDatas;
                charts.categoryField = "year";
                charts.startDuration = 1;
                charts.rotate = true;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.dashLength = 3;

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.dashLength = 3;
                valueAxis.axisAlpha = 0.2;
                valueAxis.position = "top";
                valueAxis.title = "Million RS";
                valueAxis.minorGridEnabled = true;
                valueAxis.minorGridAlpha = 0.08;
                valueAxis.gridAlpha = 0.15;
                charts.addValueAxis(valueAxis);

                // GRAPHS
                // column graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Income";
                graph1.valueField = "income";
                graph1.lineAlpha = 0;
                graph1.fillColors = "#ADD981";
                graph1.fillAlphas = 0.8;
                graph1.balloonText = "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>";
                charts.addGraph(graph1);

                // line graph
                var graph2 = new AmCharts.AmGraph();
                graph2.type = "line";
                graph2.lineColor = "#27c5ff";
                graph2.bulletColor = "#FFFFFF";
                graph2.bulletBorderColor = "#27c5ff";
                graph2.bulletBorderThickness = 2;
                graph2.bulletBorderAlpha = 1;
                graph2.title = "Expenses";
                graph2.valueField = "expenses";
                graph2.lineThickness = 2;
                graph2.bullet = "round";
                graph2.fillAlphas = 0;
                graph2.balloonText = "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>";
                charts.addGraph(graph2);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.useGraphSettings = true;
                charts.addLegend(legend);

                charts.creditsPosition = "top-right";

                // WRITE
                charts.write("chartdivs");
            });
        </script>


        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });

        </script> 

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
            }

            function alertFunction(val) {
                var memberid = val;
                var request = createXMLHttpRequest();
                var url = "ViewMemberDetails.php";
                request.open("GET", url + "?member_id=" + memberid, true);
                request.send();
                request.onreadystatechange = function () {
                    // alert("sdasdasdasda");
                    if (request.readyState == 4) {
                        if (request.status == 200) {
                            var data = request.responseText;
                            document.getElementById("div").innerHTML = data;
                        }
                    }
                }
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
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fas fa-tachometer-alt"></i> Home</a></li>

                    </ol>
                </section>
                <input type="hidden"  id="dates" name="dates">
                <div class="row" style="padding: 16px 16px 0px 16px">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-green" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-usd"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Daily Collection</span>
                                <span class="info-box-number" id="totFC">45000</span>

                                <div class="progress">
                                    <div id="FC" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="spfc" style="font-size: 11px" ></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-yellow" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-paperclip"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Past Due</span>
                                <span class="info-box-number" id="totCash">45000</span>

                                <div class="progress">
                                    <div id="CASH" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="spcash" tyle="font-size: 11px"></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-pushpin"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Expenses</span>
                                <span class="info-box-number" id="totPay">45000</span>

                                <div class="progress">
                                    <div id="PAY" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="sppay" tyle="font-size: 11px"></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-aqua" style="border-radius: 3px">
                            <span class="info-box-icon"><i class="glyphicon glyphicon-repeat"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">sample</span>
                                <span class="info-box-number" id="totPD">45000</span>

                                <div class="progress">
                                    <div id="PD" class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    <spam  id="sppd" tyle="font-size: 11px"></spam>% Increase in month
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <section class="col-lg-8 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>

                            <li class="pull-left header"><i class="fa fa-inbox"></i> Sample chart</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->

                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 390px">
                                <div id="chartdiv" style="width:100%; height:380px;;margin-bottom:  20px"></div>
                            </div>

                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>

                            <li class="pull-left header" style="font-size: 18px"><i class="fa fa-inbox"></i>Sample chart</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->

                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 390px">
                                <div id="chartdivs" style="width:100%; height:390px;"></div>
                            </div>

                        </div>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content" style="height: 500px">
                    <!--    <div class="col-md-8" style="margin-left: -15px">
                           <div class="box box-primary" style="margin-top: -15px;">
   
                               <div id="chartdiv" style="width:70%; height:400px;"></div>
                           </div>
                       </div>-->
                </section>

            </div>

            <!-- Modal -->
            <div class="modal fade " id="myModal" role="dialog" >
                <div class="modal-dialog" style="width: 60%">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Modal Header</h4>
                        </div>
                        <div class="modal-body">
                            <div id="chartdivs" style="font-size: 13px;align-content: flex-start"></div> <!--Here Will show the Data-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>

    </body>

</html>
