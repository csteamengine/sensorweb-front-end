<?php
/**
 * Created by PhpStorm.
 * User: gregory
 * Date: 10/4/17
 * Time: 6:56 PM
 */
?>

@extends('layouts.layout')

@section('title', 'Home Nodes')

@section('cssincludes')
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/vendor/datatables-responsive/dataTables.responsive.css">
    <link rel="stylesheet" href="/css/nodes.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Leaf Node Data
                <a href="{{route('getHomenode', ['id' => $leafnode->homenode_id])}}" class="pull-right btn btn-success"><i class="fa fa-home fa-2x" ></i></a>
            </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
       foreach($errors as $error){
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> {{$error}}
    </div>

    <?php

      }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Leaf Node Data
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped cell-border" id="data-tables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Data Type</th>
                                <th>Value</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach($readings as $reading){

                            ?>
                            <tr>

                                <td align="center">{{$reading->id}}</td align="center">
                                <td align="center">{{$reading->datatype->title}} ({{$reading->datatype->abbreviation}})</td>
                                <td align="center">{{$reading->value}}</td>
                                <td align="center">{{$reading->created_at}}</td>
                                <td align="center">
                                    <a href="#" title="Delete Data" data-toggle="modal" data-target="#deleteModal" onclick="deleteId('{{ route('removeReading', $reading->id) }}')"><i class="fa fa-trash fa-2x" ></i></a>
                                </td>
                            </tr>

                            <?php
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Readings
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
    <!-- Delete Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Home Node?</h4>
                </div>
                <div class="modal-body" align="center">
                    <form class="form-horizontal" method="GET" id="deleteForm" action="">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </div>
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            </div>

        </div>
    </div>

    <script>
        function deleteId(route){
            document.getElementById('deleteForm').action = route;
        }
    </script>
@endsection

@section('includes')
    <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/nodes.js"></script>
    <script src="/vendor/datatables/js/dataTables.bootstrap.min.js"></script>
    <script src="/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'X');
            data.addColumn('number', 'Units');

            data.addRows([
                    @foreach($readings as $reading)
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