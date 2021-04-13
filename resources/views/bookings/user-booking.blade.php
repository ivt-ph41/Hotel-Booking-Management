@extends('layouts.master')
@section('title', 'My Booking')


@section('content')


<table class="table table-bordered">
    <caption>My bookings</caption>
    <thead>
        <tr>
            <th scope="col">Room</th>
            <th scope="col">Date start</th>
            <th scope="col">Date end</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($user->bookings as $booking)

        @foreach ($booking->bookingDetails as $bookingDetail)

        <tr>
            <td>
                <a href="{{route('rooms.show', $bookingDetail->room->id)}}" style="color: #e9ad28; text-decoration: underline;">
                    {{$bookingDetail->room->name}}
                </a>
            </td>
            <td>{{$bookingDetail->date_start}}</td>
            <td>{{$bookingDetail->date_end}}</td>
            <td>
                <!-- Pending -->
                @if ($booking->status == \App\Entities\Booking::PENDING_STATUS)
                <div class="d-inline"><b class="text-warning mr-3">{{__('Pending')}}</b></div>
                <div class="d-inline">
                {{-- if current day < date_start two day, user can Cancel booking --}}
                @if ($flag = \Carbon\Carbon::now()->addDay(2)->toDateString() < $bookingDetail->date_start ? true : false)
                <form class="form-inline" action="{{ route('bookings.cancel', $booking->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Cancel</button>
                    </div>
                </form>
                @endif
                </div>

            {{--Appprove--}}
            @elseif ($booking->status == \App\Entities\Booking::APPROVE_STATUS)
            <b class="text-success">Approve</b>

            {{-- Cancel--}}
            @elseif ($booking->status == \App\Entities\Booking::CANCEL_STATUS)
            <b class="text-danger">Cancel</b>

            {{-- Finish --}}
            @elseif ($booking->status == \App\Entities\Booking::FINISH_STATUS)
            <b class="text-dark">{{__('Finish')}}</b>
            @endif

            </td>
        </tr>

        @endforeach

        @endforeach

    </tbody>
</table>
@endsection

<!-- Js toast notification -->
@section('js')

@if(session()->has('status'))
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
    toastr.success('You have cancel booking success!', 'Notification');
  });
</script>
@endif

@endsection