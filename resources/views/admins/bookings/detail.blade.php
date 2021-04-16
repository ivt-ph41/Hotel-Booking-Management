@extends('layouts.dashboard')

<!-- Title -->
@section('title', 'Booking deail')

<!-- Content -->
@section('content')
@isset($booking)
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card text-center">
      <div class="card-header">
        {{__('Booking Detail')}}
      </div>
      <div class="card-body">
        @foreach($booking->bookingDetails as $value)
        <h5 class="card-title">{{ __('Description') }}</h5>
        <h3 class="card-text">{{ $value->room->name }}</h3>
        <h4 class="card-text text-pink">{{__('From: ') .  $value->date_start . __(' to: ') . $value->date_end }}</h4>
        @endforeach
        <h4></h4>
      </div>
      <div class="card-footer text-muted">
        <a href="{{route('admins.dashboards.booking')}}" class="btn btn-primary">Go back</a>
      </div>
    </div>
  </div>
</div>
@endisset
@endsection