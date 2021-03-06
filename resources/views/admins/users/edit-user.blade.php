@extends('layouts.dashboard')
@section('title', 'Edit room')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- general form elements -->
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title">Change information of user</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admins.user.update', $user->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{__('User name')}}</label>
                            <input type="text" name="name" value="{{$user->profile->name}}" class="form-control" id="name">
                        </div>
                        @if($errors->has('name'))
                        <p class="text-bold text-danger">{{$errors->first('name')}}</p>
                        @endif
                        <div class="form-group">
                            <label for="description">{{__('Address')}}</label>
                            <input type="text" name="address" value="{{$user->profile->address}}" class="form-control" id="description" placeholder="Address">
                        </div>
                        @if($errors->has('address'))
                        <p class="text-bold text-danger">{{$errors->first('description')}}</p>
                        @endif
                        <div class="form-group">
                            <label for="size">{{__('Phone number')}}</label>
                            <input type="text" name="phone" value="{{$user->profile->phone}}" class="form-control" id="size" placeholder="Phone number">
                        </div>
                        @if($errors->has('phone'))
                        <p class="text-bold text-danger">{{$errors->first('phone')}}</p>
                        @endif
                        <!-- /.card-body -->

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

    </div>
</div>
</div>

@endsection
@section('js')
<!-- If update user fail -->
@if(session()->has('error'))
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
        toastr.success('Update user fail!');
    });
</script>
@endif
@endsection