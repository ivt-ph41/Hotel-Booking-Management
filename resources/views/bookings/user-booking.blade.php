@extends('layouts.master')
@section('title', 'My Booking')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
  integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
  integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
</script>

@section('content')
@if (session()->has('status'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>{{session()->get('status')}}</strong>
</div>

<script>
  $(".alert").alert();
</script>
@endif

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
        {{--Pending--}}
        @if ($booking->status == \App\Entities\Booking::PENDING_STATUS)
        <b class="text-warning mr-3">Pending</b>
          {{-- if current day < date_start two day, user can Cancel booking --}}
          @if ($flag = \Carbon\Carbon::now()->addDay(2)->toDateString() < $bookingDetail->date_start ? true : false)
              <td>
                <form class="form-inline" action="{{ route('bookings.cancel', $booking->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <div class="form-group">
                    <button type="submit" class="btn btn-info">Cancel</button>
                  </div>
                </form>
              </td>
          @endif

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