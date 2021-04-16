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
                <th>Date start</th>
                <th>Date end</th>
                <th>Details</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @isset($bookings)
              @foreach($bookings as $booking)
              @foreach($booking->bookingDetails as $bookingDetail)
              <tr>
                <td class="text-bold text-success">{{ $booking->email }}</td>
                <td>{{ $bookingDetail->date_start }}</td>
                <td>{{ $bookingDetail->date_end }}</td>
                <!-- Detail -->
                <td>
                  <a class="btn btn-info" href="{{ route('admins.bookings.detail', $booking->id) }}">View</a>
                </td>
                <!-- Cofirm change status -->
                <td>
                  <form class="form-inline" method="POST" action="{{route('admins.update.status-booking', ['booking_id' => $booking->id])}}">
                    @csrf
                    @method('PUT')
                    <!-- Select option status -->
                    <div class="form-check mr-1">
                      <select name="status" class="form-control" {{-- if current status is cancel then disble form --}} {{\App\Entities\Booking::CANCEL_STATUS == $booking->status? 'disabled' : null}}>
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
                    <!-- Message -->
                    <div class="form-check {{\App\Entities\Booking::CANCEL_STATUS == $booking->status? 'd-none' : null}}">
                      <input type="text" class="form-control" name="messager" placeholder="Messager">
                    </div>
                    <div class="form-check ml-5">
                      <!-- If current booking status is cancel then display none -->
                      <button class="btn btn-success {{\App\Entities\Booking::CANCEL_STATUS == $booking->status? 'd-none' : null}}">Confirm</button>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
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
    toastr.success('Update status sucess, mail sent to the user!', 'Notification');
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
    toastr.info('No result found!', 'Notification');
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
    toastr.success("{{$totalResult}} result has found!", 'Search success');
  });
</script>
@endif
@endsection