@extends('layouts.master')
@section('title', 'Room-Detail')

@section('content')

<!-- Room Details Slider Begin -->
<div class="room-details-slider">
  <div class="container">
    <div class="room__details__pic__slider owl-carousel">
      @if (!empty($room->images))
      @foreach ($room->images as $image)

      <div class="room__details__pic__slider__item set-bg" data-setbg="{{asset('images/rooms/' . $image->path)}}"></div>

      @endforeach
      @endif
    </div>
  </div>
</div>
<!-- Room Details Slider End -->

<!-- Rooms Details Section Begin -->
<section class="room-details spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="room__details__content">
          <div class="room__details__rating">
            <div class="room__details__hotel">
              <span>Hotel</span>
              <div class="room__details__hotel__rating">
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star-half_alt"></span>
              </div>
            </div>
            <div class="room__details__advisor">
              <img src="{{asset('hiroto-master/img/rooms/details/tripadvisor.png')}}" alt="">
              <div class="room__details__advisor__rating">
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star-half_alt"></span>
              </div>
              <span class="review">(1000 Reviews)</span>
            </div>
          </div>
          <div class="room__details__title">
            <h2>Name:{{$room->name}} <small>(Type:{{$room->type->name}})</small></h2>

            <!-- If user in system is user then show booking now -->
            @auth
            @if (\Auth::user()->role_id == \App\Entities\Role::USER_ROLE)
            <a href="{{ route('bookings.create', ['room_id' => $room->id ]) }}" class="primary-btn">Booking
              Now</a>
            @endif
            @endauth
            <!-- End -->

            <!-- Show Booking Now button if guest -->
            @guest
            <a href="{{ route('bookings.create', ['room_id' => $room->id ]) }}" class="primary-btn">Booking
              Now</a>
            @endguest
            <!-- End -->

          </div>
          <div class="room__details__desc">
            <h2>Description:</h2>
            <p>{{ $room->description }}</p>
            <p style="color:#e9ad28;">
              <strong> Available for: {{ $room->personRoom->name }}</strong>
            </p>
            <h2>{{__('Bed Type: ')}} <span>{{ $room->bed->name}}</span></h2>
          </div>

          <div class="row">
            <div class="col-lg-6">
              @auth
              @if ($errors->has('content'))
              <p style="color: red">{{$errors->first('content')}}</p>
              @endif
              <form id="frm-commnent" action="{{route('comments.store', ['id' => $room->id])}}" method="post" style="margin-bottom: 2%">
                @csrf
                <div class="form-group">
                  <!-- <textarea class="rounded" name="content" id="" cols="50" rows="5"></textarea> -->
                  <label for="comment">Comment:</label>
                  <textarea class="form-control" name="content" rows="5" id="comment"></textarea>
                </div>
                <button type=" submit" class="btn btn-danger">Send your comment</button>
              </form>
              @endauth
              @foreach ($comments as $comment)
              @if ($comment->user->role_id == 1 )
              <p style="color: rgba(144, 9, 9, 0.644)">
                Admin <small style="color: black">({{$comment->user->email}})</small>
              </p>
              @else
              <p style="color: #e9ad28">
                User <small style="color: black">({{ $comment->user->email }})</small>
              </p>
              @endif
              <p>{{$comment->content}}</p>

              <!-- IF curent user id == user id of comment -->
              @if(\Auth::id() == $comment->user->id)
              <form action="{{ route('comments.destroy' , ['id' => $room->id, 'commentId' => $comment->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn" style="margin-left: 90%;" type="submit"><img src="{{ asset('images/utilities/remove.png') }}" alt="" width="30px"></button>
              </form>
              @endif()
              <!-- END -->

              <div>
                .............................................................................................................................................................................
              </div>
              @endforeach
            </div>
          </div>

          <!-- Paginate -->
          <div class="col">
            {{ $comments->links() }}
          </div>

          <div class="row mt-5">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="room__details__facilities">
                <h2>Others facilities:</h2>
                <div class="row">
                  <div class="col-lg-6">
                    <ul>
                      <li><span class="icon_check"></span> Takami Bridal Attire</li>
                      <li><span class="icon_check"></span> Esthetic Salon</li>
                      <li><span class="icon_check"></span> Multilingual staff</li>
                      <li><span class="icon_check"></span> Dry cleaning and laundry</li>
                      <li><span class="icon_check"></span> Credit cards accepted</li>
                    </ul>
                  </div>
                  <div class="col-lg-6">
                    <ul>
                      <li><span class="icon_check"></span> Rent-a-car</li>
                      <li><span class="icon_check"></span> Reservation & confirmation</li>
                      <li><span class="icon_check"></span> Babysitter upon request</li>
                      <li><span class="icon_check"></span> 24-hour currency exchange</li>
                      <li><span class="icon_check"></span> 24-hour Manager on Duty</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="room__details__more__facilities">
                <h2>Most popular facilities:</h2>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{ asset('hiroto-master/img/rooms/details/facilities/fac-1.png')}}" alt="">
                      </div>
                      <h6>Air Conditioning</h6>
                    </div>
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{ asset('hiroto-master/img/rooms/details/facilities/fac-2.png') }}" alt="">
                      </div>
                      <h6>Cable TV</h6>
                    </div>
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{ asset('hiroto-master/img/rooms/details/facilities/fac-3.png') }}" alt="">
                      </div>
                      <h6>Free drinks</h6>
                    </div>
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{asset('hiroto-master/img/rooms/details/facilities/fac-4.png')}}" alt="">
                      </div>
                      <h6>Unlimited Wifi</h6>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{asset('hiroto-master/img/rooms/details/facilities/fac-5.png')}}" alt="">
                      </div>
                      <h6>Restaurant quality</h6>
                    </div>
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{asset('hiroto-master/img/rooms/details/facilities/fac-6.png')}}" alt="">
                      </div>
                      <h6>Service 24/24</h6>
                    </div>
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{asset('hiroto-master/img/rooms/details/facilities/fac-7.png')}}" alt="">
                      </div>
                      <h6>Gym Centre</h6>
                    </div>
                    <div class="room__details__more__facilities__item">
                      <div class="icon"><img src="{{asset('hiroto-master/img/rooms/details/facilities/fac-8.png')}}" alt="">
                      </div>
                      <h6>Spa & Wellness</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- <script>
            $(document).ready(() => {
                $('#frm-commnent').on('submit', () => {
                    return false;
                });
            });
            $('#frm-commnent').keypress((e) => {
                if (e.which === 13) {
                    $('#frm-commnent').submit();
                }
            })
        </script> --}}
</section>
@endsection

<!-- JS -->
@section('js')

<!-- IF DELETE COMMENT SUCESS -->
@if(session()->has('delete comment success'))
<script>
  $(function() {
    toastr.options = {
      "closeButton": true,
      "debug": true,
      "newestOnTop": true,
      "progressBar": false,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "1000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success('Your comment delete success!', 'Notification');
  });
</script>
@endif

@endsection