{{-- @php
dd($rooms->toArray());
@endphp --}}
@extends('layouts.master')
@section('content')
<!-- Home About Section Begin -->
<section class="home-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="home__about__text">
                    <div class="section-title">
                        <h5>ABOUT US</h5>
                        <h2>Welcome Hiroto Hotel In Street L’Abreuvoir</h2>
                    </div>
                    <p class="first-para">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                        fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                    <p class="last-para">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque.</p>
                    <img src="{{asset('hiroto-master/img/home-about/sign.png')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="home__about__pic">
                    <img src="{{asset('hiroto-master/img/home-about/home-about.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home About Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="services__item">
                    <img src="{{asset('hiroto-master/img/services/services-1.png')}}" alt="">
                    <h4>Free Wi-Fi</h4>
                    <p>The massive investment in a hotel or resort requires constant reviews and control in order to
                        make it a successful investment.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="services__item">
                    <img src="{{asset('hiroto-master/img/services/services-2.png')}}" alt="">
                    <h4>Premium Pool</h4>
                    <p>Choose from 4 unique ready made concepts, let us help you create the concept perfect for you
                        or let HCA.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="services__item">
                    <img src="{{asset('hiroto-master/img/services/services-3.png')}}" alt="">
                    <h4>Coffee Maker</h4>
                    <p>HCA's Owner's Representation is taking care of just these important factors, may it be
                        through regular site visits and spot checks.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="services__item">
                    <img src="{{asset('hiroto-master/img/services/services-4.png')}}" alt="">
                    <h4>Bar Wine</h4>
                    <p>For properties with third party management companies, HCA Consultants will as well administer
                        the terms and conditions.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="services__item">
                    <img src="{{asset('hiroto-master/img/services/services-5.png')}}" alt="">
                    <h4>TV HD</h4>
                    <p>We provide a critical analysis of a hotel's marketing strategy, bench-marking it against
                        industry and competitive practices.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="services__item">
                    <img src="{{asset('hiroto-master/img/services/services-6.png')}}" alt="">
                    <h4>Restaurant</h4>
                    <p>A hotel and restaurant investment deserves careful and market oriented financial planning and
                        projections.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->


@endsection