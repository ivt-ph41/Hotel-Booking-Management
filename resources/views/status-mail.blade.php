<h1>Hiroto hotel</h1>
<p>Hi {{$email}}!</p>
<p>Thank you for choose our service.</p>
<h3>Your current booking status</h3>
<h4>
@if($status == 0)
<b style="color: yellow;">Pending</b>
@elseif($status == 1)
<b style="color: green;">Approve</b>
@elseif($status == 2)
<b style="color: red;">Cancel</b>
@endif
</h4>

<h4><b>View here: http://hotelmanagement.test/rooms/{{$room['id']}}</b></h4>
<p>Your booking is pending, please wait our feedback.</p>

<small>Have a good day!</small>