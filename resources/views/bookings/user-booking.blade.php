@extends('layouts.master')
@section('title', 'Your Booking')
@section('content')
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

                    <div class="room__pic__item set-bg" data-setbg="{{ $image->path }}"></div>

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
@endsection