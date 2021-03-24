@extends('layouts.master')
@section('title', 'Profile')

@section('css')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
@endsection

@section('content')
@isset($user)
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #e9ad28">
            <h4>My Profile</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                <img alt="User Pic"
                    src="https://sothis.es/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png"
                    id="profile-image1" class="img-circle img-responsive">
            </div>
            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                <div class="container">
                    <h2>{{$user->profile->name}}</h2>
                    <p><a href="{{route('users.edit')}}">{{__('Change Profile')}}</a></p>
                    <p><a href="">{{__('Change Password')}}</a></p>
                </div>
                <hr>
                <ul class="container details">
                    <li>
                        <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>Phone number:
                            {{$user->profile->phone}}</p>
                    </li>
                    <li>
                        <p><span class="glyphicon glyphicon-user one" style="width:50px;"></span>Address:
                            {{$user->profile->address}}</p>
                    </li>
                    <li>
                        <p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{$user->email}}
                        </p>
                    </li>
                </ul>
                <hr>
                <div class="col-sm-5 col-xs-6 tital ">
                    Date Of Joining:
                    @php
                    echo date("l jS \of F Y h:i:s A", strtotime($user->created_at));
                    @endphp
                </div>
            </div>
        </div>
    </div>
    @endisset

    @endsection