@extends('layouts.master')
@section('title','Booking')
@section('content')
<div style="margin-bottom: 2%">
    @if (session()->has('booking_success'))
    <div>
        <p style="color: lawngreen">{{session()->get('booking_success')}}</p>
    </div>
    @endif
    <h1>Room: {{$room->name}}</h1>
    <h2>Price: <sup>$</sup>{{$room->price}}<span>/day</span></h2>
</div>
@auth
<form action="{{ route('bookings.store', ['room_id' => $room->id]) }}" class="filter__form"
    style="border: solid #e9ad28; " method="post">
    @csrf
    <div class="filter__form__item">
        <p>Username</p>
        <div class="filter__form__datepicker">
            <input type="text" name="name" value="{{$profile->first()->name}}">
        </div>
    </div>
    <div class="filter__form__item">
        <p>Address</p>
        <div class="filter__form__datepicker">
            <input type="text" name="address" value="{{$profile->first()->address}}">
        </div>
    </div>
    <div class="filter__form__item">
        <p>Phone</p>
        <div class="filter__form__datepicker">
            <input type="text" name="phone" value="{{$profile->first()->phone}}">
        </div>
    </div>
    <div class="filter__form__item">
        <p>Date Start</p>
        <div class="filter__form__datepicker">
            <span class="icon_calendar"></span>
            <input type="text" name="date_start" class="datepicker_pop check__in">
            <i class="arrow_carrot-down"></i>
        </div>
    </div>
    <div class="filter__form__item">
        <p>Date End</p>
        <div class="filter__form__datepicker">
            <span class="icon_calendar"></span>
            <input type="text" name="date_end" class="datepicker_pop check__out">
            <i class="arrow_carrot-down"></i>
        </div>
    </div>
    <button style="right: -100px; outline: solid 3px #e9ad28;" type="submit">Booking</button>
</form>
@endauth
@guest

<form action="{{ route('bookings.store', ['room_id' => $room->id]) }}" class="filter__form"
    style="border: solid #e9ad28; " method="post">
    @csrf
    <div class="filter__form__item">
        <p>Username</p>
        <div class="filter__form__datepicker">
            <input type="text" name="name">
        </div>
    </div>
    <div class="filter__form__item">
        <p>Address</p>
        <div class="filter__form__datepicker">
            <input type="text" name="address">
        </div>
    </div>
    <div class="filter__form__item">
        <p>Phone</p>
        <div class="filter__form__datepicker">
            <input type="text" name="phone">
        </div>
    </div>
    <div class="filter__form__item">
        <p>Date Start</p>
        <div class="filter__form__datepicker">
            <span class="icon_calendar"></span>
            <input type="text" name="date_start" class="datepicker_pop check__in">
            <i class="arrow_carrot-down"></i>
        </div>
    </div>
    <div class="filter__form__item">
        <p>Date End</p>
        <div class="filter__form__datepicker">
            <span class="icon_calendar"></span>
            <input type="text" name="date_end" class="datepicker_pop check__out">
            <i class="arrow_carrot-down"></i>
        </div>
    </div>
    <button style="right: -100px; outline: solid 3px #e9ad28;" type="submit">Booking</button>
</form>
@endguest
@endsection
