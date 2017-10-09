<?php
/**
 * Created by PhpStorm.
 * User: gregory
 * Date: 10/4/17
 * Time: 6:56 PM
 */
?>

@extends('layouts.layout')

@section('title', 'Settings')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {{ Form::model($user, array('route' => array('updateUser', $user->id))) }}
            {{ Form::token()}}
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', $user->username, ['placeholder' => 'Username','class' => 'form-control'])}}
                </div>
                <div class="col-md-6">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', $user->email, ['placeholder' => 'Email','class' => 'form-control'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('first_name', 'First Name') }}
                    {{ Form::text('first_name', $user->first_name, ['placeholder' => 'First Name','class' => 'form-control'])}}
                </div>
                <div class="col-md-6">
                    {{ Form::label('last_name', 'Last Name') }}
                    {{ Form::text('last_name', $user->last_name, ['placeholder' => 'Last Name','class' => 'form-control'])}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('address_line1', 'Address Line 1') }}
                    {{ Form::text('address_line1', $user->address_line1, ['placeholder' => 'Address Line 1','class' => 'form-control'])}}
                </div>
                <div class="col-md-6">
                    {{ Form::label('address_line2', 'Address Line 2') }}
                    {{ Form::text('address_line2', $user->address_line1, ['placeholder' => 'Address Line 2','class' => 'form-control'])}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('city', 'City') }}
                    {{ Form::text('city', $user->city, ['placeholder' => 'City','class' => 'form-control'])}}
                </div>
                <div class="col-md-4">
                    {{ Form::label('state', 'State') }}
                    {{ Form::text('state', $user->state, ['placeholder' => 'State','class' => 'form-control'])}}
                </div>
                <div class="col-md-4">
                    {{ Form::label('zip', 'Zip') }}
                    {{ Form::text('zip', $user->zip, ['placeholder' => 'Zip','class' => 'form-control'])}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    {{ Form::submit('Save', ['class' => 'form-control btn btn-primary']) }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12" align="center">
                    <a href="/password/reset" class="btn btn-link">Reset Your Password</a>
                </div>
            </div>


            {{ Form::close() }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Settings</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12" align="center">
            <h3>TODO - will add settings here</h3>
        </div>
    </div>
@endsection
