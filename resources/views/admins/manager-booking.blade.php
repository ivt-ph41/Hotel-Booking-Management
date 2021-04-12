@extends('layouts.dashboard')
@section('title', 'Manager booking')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-orange">
          <h3 class="card-title">Manager booking of users</h3>

          <div class="card-tools">
            <!-- Search box -->
            <form action="{{ route('admins.dashboards.booking') }}" method="get">
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
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @isset($bookings)
              @foreach($bookings as $booking)
              <tr>
                <td class="text-bold text-success">{{ $booking->email }}</td>
                <td>{{ $booking->address }}</td>
                <td>{{$booking->phone}}</td>
                <td>
                  <form class="form-inline" method="POST" action="{{route('admins.update.status-booking', ['booking_id' => $booking->id])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-check">
                      <select name="status" class="form-control">
                        <option {{-- if current status is pending  then selected --}} {{\App\Entities\Booking::PENDING_STATUS == $booking->status? 'selected' : null}} value="{{\App\Entities\Booking::PENDING_STATUS}}">
                          {{__('Pending')}}
                        </option>
                        <option {{-- if current status is appove then selected --}} {{\App\Entities\Booking::APPROVE_STATUS == $booking->status? 'selected' : null}} value="{{\App\Entities\Booking::APPROVE_STATUS}}">
                          {{__('Approve')}}
                        </option>
                        <option {{-- if current status is cancel then selected --}} {{\App\Entities\Booking::CANCEL_STATUS == $booking->status? 'selected' : null}} value="{{\App\Entities\Booking::CANCEL_STATUS}}">
                          {{__('Cancel')}}
                        </option>
                      </select>
                    </div>
                    <div class="form-check ml-5">
                      <button class="btn btn-success">Confirm</button>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
            @endisset
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          {{$bookings->links()}}
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
@endsection

@section('js')
@if(session()->has('success'))
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
    toastr.success('Update status sucess!', 'Notification');
  });
</script>
@endif
<!-- update fail -->
@if(session()->has('update fail'))
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
    toastr.error('Update status fail!', 'Notification');
  });
</script>
@endif
@endsection