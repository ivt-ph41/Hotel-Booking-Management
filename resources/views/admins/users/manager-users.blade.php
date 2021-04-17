@extends('layouts.dashboard')
@section('title', 'Manager User')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{__('Manager user table')}}</h3>
          <div class="card-tools">

            <form action="{{route('admins.user.manager')}}" method="get">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="search" value="{{ old('search') }}" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{__('Username')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Address')}}</th>
                <th>{{__('Phone')}}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @isset($users)

              @foreach($users as $user)
              <tr>
                <td>{{$user->profile->name}}</td>
                <td class="text-danger">{{$user->email}}</td>
                <td>{{$user->profile->address}}</td>
                <td>{{{$user->profile->phone}}}</td>
                <td>
                  <!-- Split dropright button -->
                  <div class="btn-group dropright">
                    <button type="button" class="btn btn-secondary">
                      Action
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="sr-only">Toggle Dropright</span>
                    </button>
                    <div class="dropdown-menu">
                      <a href="{{route('admins.user.edit', $user->id)}}" class="btn">Edit</a>
                      <div class="dropdown-divider"></div>
                      <form action="{{route('admins.user.destroy', $user->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Delete" class="btn">
                      </form>
                    </div>
                  </div>

                </td>
              </tr>
              @endforeach
              @endisset
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            {{$users->links()}}
          </ul>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
@endsection
@section('js')
<!-- if update information of user success -->
@if(session()->has('update success'))
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
    toastr.success('Update user success!');
  });
</script>
@endif
<!-- If delete user success -->
@if(session()->has('delete success'))
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
    toastr.success('Delete user success!');
  });
</script>
@endif

<!-- If delete user fail -->
@if(session()->has('delete fail'))
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
    toastr.success('Delete user fail!');
  });
</script>
@endif
<!-- If no result found for search -->
@if(session()->has('no result found'))
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
    toastr.info('No result found!', 'Notification');
  });
</script>
@endif

<!-- If search no result found -->
@if(isset($noResultFound))
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
    toastr.info('No result found!', 'Searching');
  });
</script>
@endif
<!-- Search success -->
@if(isset($totalResult))
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
    toastr.success("{{$totalResult}} result has found!", 'Searching');
  });
</script>
@endif
@endsection