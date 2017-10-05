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
                        <table class="table table-hover">
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
                                    <td>{{$homenode->nickname}}</td>
                                    <td>{{$homenode->latitude}}{{$homenode->longitude}}</td>
                                    <td>TODO</td>
                                    <td>
                                        TODO
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Home Node</h4>
                </div>
                <div class="modal-body">
                    <p>To add a home node, you must know the unique ID of the node.</p>
                    <form class="form-horizontal" method="POST" action="{{ route('addHomeNode') }}">
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

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
