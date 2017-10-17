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
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Home Nodes
                <button class="pull-right btn btn-success"  data-toggle="modal" data-target="#addHomeNodeModal"><i class="fa fa-plus" ></i></button>
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
                    Home Nodes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped cell-border" id="data-tables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nickname</th>
                                <th>Coordinates</th>
                                <th>Last Transmission</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php

                                    foreach($homenodes as $homenode){

                                        ?>
                                <tr>

                                <td>{{$homenode->id}}</td>
                                    <td align="center">{{$homenode->pivot->nickname != "" ? $homenode->pivot->nickname : "<No Nickname>"}}</td>
                                    <td align="center">{{$homenode->latitude}}{{$homenode->longitude}}</td>
                                    <td align="center">TODO</td>
                                    <td align="center">
                                        <a href="{{route('editHomenode', ['id' => $homenode->id])}}" style="text-decoration: none;" title="Edit Home Node"><i class="fa fa-edit fa-2x"></i> </a>
                                        <a href="{{route('getHomenode', ['id' => $homenode->id])}}" style="text-decoration: none;" title="View Leaf Nodes"><i class="fa fa-leaf fa-2x"></i> </a>
                                        <a href="#" style="text-decoration: none;" title="Remove Home Node" data-toggle="modal" data-target="#deleteModal" onclick="deleteId('{{ route('removeHomeNode', $homenode->id) }}')"><i class="fa fa-trash fa-2x"></i> </a>
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
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- Modal -->
    <div id="addHomeNodeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <form class="form-horizontal" method="POST" action="{{ route('addHomeNode') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Home Node</h4>
                    </div>
                    <div class="modal-body">
                        <p>To add a home node, you must know the unique ID of the node.</p>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="unique_id" class="col-md-4 control-label">Unique Id</label>

                                <div class="col-md-6">
                                    <input id="unique_id" type="text" class="form-control" name="unique_id" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nickname" class="col-md-4 control-label">Nickname</label>

                                <div class="col-md-6">
                                    <input id="nickname" type="text" class="form-control" name="nickname" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
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
            console.log(route);
            document.getElementById('deleteForm').action = route;
        }
    </script>
@endsection

@section('includes')
    <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/nodes.js"></script>
    <script src="/vendor/datatables/js/dataTables.bootstrap.min.js"></script>
    <script src="/vendor/datatables-responsive/dataTables.responsive.js"></script>
@endsection