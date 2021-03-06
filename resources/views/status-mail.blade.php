
<h1>Hiroto hotel</h1>
<p>Dear {{$email}},</p>


@if($status == \App\Entities\Booking::PENDING_STATUS)
<h3>Your status booking is <b style="color: #ffc107;">pending</b> now.</h3>
@elseif($status == \App\Entities\Booking::APPROVE_STATUS)
<h3>Congratulations, your booking now is <b style="color: #28a745;">approve</b></h3>
@elseif($status == \App\Entities\Booking::CANCEL_STATUS)
<h3>Sorry, your status booking now is  <b style="color: #dc3545;">cancel</b></h3>
@endif

<!-- if not empty messager -->
@if(!empty($messager))
<h4 style="color:hotpink">{{$messager}}</h4>
@endif
<h2>Detail</h2>

@foreach($booking_details as $value)
<p>Date booking from {{$value['date_start']}} to {{$value['date_end']}}</p>
<p>At {{$value['room']['name']}}</p>
@endforeach
<p>Thank you for choose our service.</p>
<h1>Have a good day &#128155;</h1>
