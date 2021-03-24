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
                <a href="{{route('rooms.show', $bookingDetail->room->id)}}"
                    style="color: #e9ad28; text-decoration: underline;">
                    {{$bookingDetail->room->name}}
                </a>
            </td>
            <td>{{$bookingDetail->date_start}}</td>
            <td>{{$bookingDetail->date_end}}</td>
            <td>
                @if ($booking->status == \App\Entities\Booking::PENDING_STATUS)
                <b class="text-warning">Pending</b>

                @elseif ($booking->status == \App\Entities\Booking::APPROVE_STATUS)
                <b class="text-success">Approve</b>

                @elseif ($booking->status == \App\Entities\Booking::CANCEL_STATUS)
                <b class="text-danger">Cancel</b>

                @endif

            </td>
        </tr>

        @endforeach

        @endforeach

    </tbody>
</table>
@endsection