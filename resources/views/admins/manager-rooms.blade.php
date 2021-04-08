@extends('layouts.dashboard')
@section('title', 'Manager rooms')

@section('content')
<div class="container">
  @if (session()->has('success'))
  <p class="text-success">{{session()->get('success')}}</p>
  @endif
  <div class="row">
    <div class="col-9"></div>
    <div class="col-3">
      @if(session()->has('status'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{session()->get('status')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{__('Manager room table')}}</h3>
          <div class="card-tools">

            <form action="{{route('admins.room.manager')}}" method="get">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Search">

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
                <th>{{{__('Room')}}}</th>
                <th>{{__('Size')}}</th>
                <th>{{__('Price')}}</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @isset($rooms)
              @foreach($rooms as $room)
              <tr>
                <td><a href="{{route('rooms.show', $room->id)}}" class="text-bold text-maroon hover" style="text-decoration: underline">{{$room->name}}</a></td>
                <td>{{$room->size . ' feet'}}</td>
                <td>{{$room->price . '$'}}</td>
                <td>
                  <!-- Split dropright button -->
                  <div class=" btn-group dropright">
                    <button type="button" class="btn btn-secondary">
                      Action
                    </button>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="sr-only">Toggle Dropright</span>
                    </button>
                    <div class="dropdown-menu">
                      <a href="{{route('admins.room.edit', $room->id)}}" class="btn">Edit</a>
                      <div class="dropdown-divider"></div>
                      <form action="{{route('admins.room.destroy', $room->id)}}" method="post">
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
            {{$rooms->links()}}
          </ul>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
@endsection

@section('js')
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
    toastr.success('Update room success!', 'Notification');
  });
</script>
@endif

@if(session()->has('create success'))
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
    toastr.success('Create room success!', 'Notification');
  });
</script>
@endif

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
    toastr.success('Delete room success!', 'Notification');
  });
</script>
@endif
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
    toastr.error('Current room has bookings, cannot delete!', 'Notification');
  });
</script>
@endif
@if(session()->has('something wrong'))
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
    toastr.warning('Something went wrong!', 'Notification');
  });
</script>
@endif
@endsection