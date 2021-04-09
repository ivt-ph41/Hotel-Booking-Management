<h1>Hiroto hotel</h1>
<h4>Admin:PhuocTran</h4>
<p>Hi {{$email}}!</p>
<p>Thank you for choose our service.</p>
<h3>Detail</h3>
<small>{{__('Date start: ')}}. {{$date_start}}</small>
<small>{{__('Date end: ')}}. {{$date_end}}</small>
@foreach($room as $val)
<small>$val->name</small>
<small>View here: http://hotelmanagement.test/rooms/$val->id</small>
@endforeach
<p>Your booking is pending, please wait our feedback.</p>

<small>Have a good day!</small>