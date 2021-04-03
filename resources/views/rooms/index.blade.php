@extends('layouts.master')
@section('title', 'Rooms')

@section('css')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" rel="stylesheet"/>
@endsection

@section('our-room-ui')
<div class="breadcrumb-option set-bg" data-setbg="{{ asset('hiroto-master/img/breadcrumb-bg.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h1>Our Room</h1>
          <div class="breadcrumb__links">
            <a href="{{route('/')}}">Home</a>
            <span>Rooms</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

<div class="row mt-3">
  <div class="col-lg-12">
    <form action="{{ route('rooms.filter') }}" class="filter__form" method="get">
      <div class="filter__form__item">
        <p>Check In</p>
        <div class="filter__form__datepicker">
          <span class="icon_calendar"></span>
          <input type="text" name="date_start" class="datepicker_pop check__in">
          <i class="arrow_carrot-down"></i>
        </div>
      </div>
      <div class="filter__form__item">
        <p>Check Out</p>
        <div class="filter__form__datepicker">
          <span class="icon_calendar"></span>
          <input type="text" name="date_end" class="datepicker_pop check__out">
          <i class="arrow_carrot-down"></i>
        </div>
      </div>
      <div class="filter__form__item filter__form__item--select">
        <p>Person</p>
        <div class="filter__form__select">
          <span class="icon_group"></span>
          <select name="person_room">
            @isset($person_room_list)
            @foreach ($person_room_list as $item)
            <option value="{{ $item->id }}">
              {{ $item->name }}
            </option>
            @endforeach
            @endisset
          </select>
        </div>
      </div>
      <button type="submit">Check Available</button>
    </form>

    {{-- Form search room by name --}}
    <div class="footer__newslatter" style="width: 50%">
      <input id="search-text" type="text" name="search" placeholder="Search room by name"
        style="border: black solid 1px; padding:20px;">
      <div style="height:150px; overflow-y: scroll;" id="result"></div>
    </div>


  </div>
</div>

@isset($rooms)
<!-- Rooms Section Begin -->
<section class="rooms spad">
  <div class="container">
    @foreach ($rooms as $room)

    <div class="row">
      <div class="col-lg-6 p-0 order-lg-3 order-md-3 col-md-6">
        <div class="room__pic__slider owl-carousel">
          @if (!empty($room->images))
          @foreach ($room->images as $image)
          <div class="room__pic__item set-bg" data-setbg="{{ asset('images/rooms/' . $image->path) }}"></div>
          @endforeach
          @endif
        </div>
      </div>
      <div class="col-lg-6 p-0 order-lg-4 order-md-4 col-md-6">
        <div class="room__text right__text">
          <h3>{{ $room->type->name }}</h3>
          <p style="font-weight:bold;">{{__('Room name: ' . $room->name)}}</p>
          <h2><sup>$</sup>{{ $room->price }}<span>/day</span></h2>
          <ul>
            <li><span>Size:</span>{{ $room->size }} ft</li>
            <li><span>Bed:</span>{{ $room->bed->name }}</li>
            <li><span>Available for:</span>{{ $room->personRoom->name }}</li>
          </ul>
          <a href="{{ route('rooms.show', ['id' => $room->id]) }}">View Details</a>
        </div>
      </div>
    </div>

    @endforeach

  </div>
</section>
<!-- Rooms Section End -->

{{-- Paginate --}}
<div class="row">
  <div class="col-lg-12">
    {{-- <div class="pagination__number">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">Next <span class="arrow_right"></span></a>
                </div> --}}
    {{ $rooms->links() }}
  </div>
</div>
@endisset


{{-- Filter Room start --}}
@isset($roomFilter)
<!-- Rooms Section Begin -->
<section class="rooms spad">
  <div class="container">
    @foreach ($roomFilter as $room)

    <div class="row">
      <div class="col-lg-6 p-0 order-lg-3 order-md-3 col-md-6">
        <div class="room__pic__slider owl-carousel">
          @if (!empty($room->images))
          @foreach ($room->images as $image)

          <div class="room__pic__item set-bg" data-setbg="{{ asset('images/rooms/' . $image->path) }}"></div>

          @endforeach
          @endif

        </div>
      </div>
      <div class="col-lg-6 p-0 order-lg-4 order-md-4 col-md-6">
        <div class="room__text right__text">
          <h3>{{ $room->type->name }}</h3>
          <p style="font-weight:bold;">{{__('Room name: ' . $room->name)}}</p>
          <h2><sup>$</sup>{{ $room->price }}<span>/day</span></h2>
          <ul>
            <li><span>Size:</span>{{ $room->size }} ft</li>
            <li><span>Bed:</span>{{ $room->bed->name }}</li>
            <li><span>Available for:</span>{{ $room->personRoom->name }}</li>
          </ul>
          <a href="{{ route('rooms.show', ['id' => $room->id]) }}">View Details</a>
        </div>
      </div>
    </div>

    @endforeach

  </div>
</section>
<!-- Rooms Section End -->

{{-- Paginate --}}
<div class="row">
  <div class="col-lg-12">
    {{-- <div class="pagination__number">
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">Next <span class="arrow_right"></span></a>
                </div> --}}
  </div>
</div>
@endisset
{{-- Filter Room End --}}
@endsection