@extends('layouts.dashboard')
@section('title', 'Edit room')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-gray-dark">
        <div class="card-header">
          <h3 class="card-title">Form Edit User</h3>
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
              <input type="text" name="address" value="{{$user->profile->address}}" class="form-control"
                id="description" placeholder="Address">
            </div>
            @if($errors->has('address'))
            <p class="text-bold text-danger">{{$errors->first('description')}}</p>
            @endif
            <div class="form-group">
              <label for="size">{{__('Phone number')}}</label>
              <input type="text" name="phone" value="{{$user->profile->phone}}" class="form-control" id="size"
                placeholder="Phone number">
            </div>
            @if($errors->has('phone'))
            <p class="text-bold text-danger">{{$errors->first('phone')}}</p>
            @endif
            <!-- /.card-body -->

            <div class="card-footer text-center">
              <button type="submit" class="btn btn-outline-success">Submit</button>

              {{--Show result--}}
              @if(session()->has('success'))
              <div class="alert alert-success mt-2" role="alert">
                {{session()->get('success')}}
              </div>
              @elseif(session()->has('error'))
              <div class="alert alert-danger mt-2" role="alert">
                {{session()->get('error')}}
              </div>
              @endif
            </div>
        </form>
      </div>
      <!-- /.card -->
    </div>

  </div>
</div>
</div>

@endsection