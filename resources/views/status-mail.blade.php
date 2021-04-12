<h1>Hiroto hotel</h1>
<p>Hi {{$email}}!</p>
<p>Thank you for choose our service.</p>
<h3>Your current booking status</h3>
<h4>
@if($status == 0)
<b style="color: #ffc107;">Pending</b>
@elseif($status == 1)
<b style="color: #28a745;">Approve</b>
@elseif($status == 2)
<b style="color: #dc3545;">Cancel</b>
@endif
</h4>

<small>Have a good day!</small>