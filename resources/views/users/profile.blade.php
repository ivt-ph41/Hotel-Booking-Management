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
  <div class="card">
    <h1 class="card-header text-center text-white bg-secondary">{{__('Profile')}}</h1>
    <div class="card-body">
      <address  class="cart-title">
      {{__('Name: ') . $user->profile->name }}<br>
      {{__('Phone: ') . $user->profile->phone }}<br>
      {{__('Address: ') . $user->profile->address }}</address>
      <p class="card-text text-info">
      @php
          echo 'Join at: ' . date("l jS \of F Y", strtotime($user->created_at));
          @endphp
      </p>
      <a href="{{route('users.edit')}}" class="btn btn-primary">Change profile</a>
      <a href="{{route('users.change-password')}}" class="btn btn-primary">Change password</a>
    </div>
  </div>
  @endisset




  @endsection

  <!-- Js toast notification -->
  @section('js')
  <!-- password update success -->
  @if(session()->has('password-success'))
  <script>
    $(function() {
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Your current password is update!', 'Notification');
    });
  </script>
  @endif

  <!-- change profile user success -->
  @if(session()->has('profile-success'))
  <script>
    $(function() {
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr.success('Your current profile update success!', 'Notification');
    });
  </script>
  @endif
  @endsection