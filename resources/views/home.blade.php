<?php
/**
 * Created by PhpStorm.
 * User: gregory
 * Date: 10/4/17
 * Time: 6:21 PM
 */
?>

@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-map-marker fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{sizeof($homenodes)}}</div>
                        <div>Active Homenodes</div>
                    </div>
                </div>
            </div>
            <a href="{{route('homeNodes')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{sizeof($leafnodes)}}</div>
                        <div>Active Leafnodes</div>
                    </div>
                </div>
            </div>
            <a href="{{route('homeNodes')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-sitemap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{sizeof($readings)}}</div>
                        <div>New Data Readings</div>
                    </div>
                </div>
            </div>
            <a href="{{route('leafNodes')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-warning fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">0</div>
                        <div>New Notifications</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                First Home Node Moisture
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-line-chart-multi"></div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Average Moisture
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-bar-chart"></div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                First Home Node Moisture
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="chart_div"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>

@endsection

@section("includes")
    <script>
        $(window).on('load', function(){
            var moistureReadings = [
                @foreach($firstNodeReadings as $reading)
                    [new Date(  getDate("{{$reading->created_at}}")[0],
                    getDate("{{$reading->created_at}}")[1]-1,
                    getDate("{{$reading->created_at}}")[2],
                    getDate("{{$reading->created_at}}")[3],
                    getDate("{{$reading->created_at}}")[4],
                    getDate("{{$reading->created_at}}")[5]),{{$reading->value}}],
                @endforeach
            ];

            function euroFormatter(v, axis) {
                return v.toFixed(axis.tickDecimals) + "€";
            }

            function doPlot(position) {
                $.plot($("#flot-line-chart-multi"), [{
                    data: moistureReadings,
                    label: "Moisture Level"
                }], {
                    xaxes: [{
                        mode: 'time'
                    }],
                    yaxes: [{
                        min: 0
                    }, {
                        // align if we are to the right
                        alignTicksWithAxis: position == "right" ? 1 : null,
                        position: position,
                        tickFormatter: euroFormatter
                    }],
                    legend: {
                        position: 'sw'
                    },
                    grid: {
                        hoverable: true //IMPORTANT! this is needed for tooltip to work
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "%s for %x was %y",
                        xDateFormat: "%y-%0m-%0d",

                        onHover: function(flotItem, $tooltipEl) {
                            // console.log(flotItem, $tooltipEl);
                        }
                    }

                });
            }
            //Flot Bar Chart

            $(function() {

                var barOptions = {
                    series: {
                        bars: {
                            show: true,
                            barWidth: 1,
                            align: "center"
                        }
                    },
                    xaxis: {
                        ticks: [
                            <?php $count = 0; ?>
                            @foreach($homenodes as $homenode)
                            [{{$count}}, "{{$homenode->pivot->nickname}}"],
                            <?php $count++ ?>
                            @endforeach

                        ]
                    },
                    grid: {
                        hoverable: true
                    },
                    legend: {
                        show: false
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "x: %x, y: %y"
                    }
                };
                var barData = {
                    label: "bar",
                    data: [
                        <?php  $count = 0; ?>
                        @foreach($homenodes as $homenode)
                            <?php
                                $readings = $homenode->readings();
                                $total = 0.00;
                                foreach($readings as $reading){
                                    $total += $reading->value;
                                }
                                $average = $total/sizeof($readings);
                            ?>
                            [{{$count}}, {{$average}}],
                            <?php $count++; ?>
                        @endforeach

                    ]
                };
                $.plot($("#flot-bar-chart"), [barData], barOptions);

            });

            doPlot("right");
        });
    </script>
    <script src="/js/vendor/flot/excanvas.min.js"></script>
    <script src="/js/vendor/flot/jquery.flot.js"></script>
    <script src="/js/vendor/flot/jquery.flot.pie.js"></script>
    <script src="/js/vendor/flot/jquery.flot.resize.js"></script>
    <script src="/js/vendor/flot/jquery.flot.categories.js"></script>
    <script src="/js/vendor/flot/jquery.flot.time.js"></script>
    <script src="/js/vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            var moistureReadings = [
                    @foreach($firstNodeReadings as $reading)
                [{{strtotime($reading->created_at) * 1000}},{{$reading->value}}],
                @endforeach
            ];
            data.addColumn('date', 'X');
            data.addColumn('number', 'Units');

            data.addRows([
                @foreach($firstNodeReadings as $reading)
                    [new Date(  getDate("{{$reading->created_at}}")[0],
                                getDate("{{$reading->created_at}}")[1]-1,
                                getDate("{{$reading->created_at}}")[2],
                                getDate("{{$reading->created_at}}")[3],
                                getDate("{{$reading->created_at}}")[4],
                                getDate("{{$reading->created_at}}")[5])
                    ,{{$reading->value}}],
                @endforeach
            ]);

            var options = {
                hAxis: {
                    title: 'Time'
                },
                vAxis: {
                    title: 'Moisture Level'
                },
                height: 500,
                title: "Homenode Moisture Readings",
                is3D: true
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }

        function getDate(date){
            return date.split(/[- :]/);
        }
    </script>
@endsection