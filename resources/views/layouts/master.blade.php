<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Hiroto Template">
    <meta name="keywords" content="Hiroto, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hiroto | @yield('title', 'HomePage')</title>

    {{-- favicon --}}
    <link rel="shortcut icon" href="https://img.icons8.com/dusk/64/000000/3-star-hotel.png" type="image/x-icon">

    @yield('css')
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('hiroto-master/css/style.css')}}" type="text/css">



</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="header__top__widget">
                            <li><span class="icon_pin_alt"></span> Viet Nam</li>
                            <li><span class="icon_phone"></span> (84) 984-641-362</li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <div class="header__top__right">
                            <div class="header__top__auth">
                                @auth

                                <form action="{{ route('logout') }}" method="post">
                                    <a href="{{route('users.profile')}}" title="Click to view your profile"
                                        style="font-size: 100%; color:black">
                                        {{\Auth::user()->email}}
                                    </a>
                                    @csrf
                                    <button style="border: solid #e9ad28; background-color: #e9ad28;"
                                        type="submit">Logout</button>
                                </form>


                                @endauth
                                @guest
                                <ul>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register')}}">Register</a></li>
                                </ul>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__nav__option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="header__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="header__nav">
                            <nav class="header__menu">
                                <ul class="menu__class">
                                    <li @if (\Route::current()->getName() == '/' )
                                        class="active"
                                        @endif>
                                        <a href="{{ route('/')}}">Home</a></li>
                                    <li @if (\Route::current()->getName() == 'rooms.index')
                                        class="active"
                                        @endif>
                                        <a href="{{ route('rooms.index') }}">Rooms</a>
                                    </li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">News</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </nav>
                            @auth
                            <div class="header__nav__widget">
                                <a href="{{ route('users.booking') }}">My Booking <span class="arrow_right"></span></a>
                            </div>
                            @endauth
                            @guest
                            <div class="header__nav__widget">
                                <a href="{{ route('rooms.index') }}">Book Now <span class="arrow_right"></span></a>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
                <div class="canvas__open">
                    <span class="fa fa-bars"></span>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->

    @yield('our-room-ui')

    <!-- Breadcrumb End -->

    <!-- Hero Section Begin -->
    <section class="hero spad set-bg" data-setbg="img/hero.jpg">


        <div class="container">
            @yield('content')
        </div>
    </section>
    <!-- Hero Section End -->





    <!-- Footer Section Begin -->
    <footer class="footer set-bg" data-setbg="{{ asset('hiroto-master/img/footer-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo__carousel owl-carousel">
                        <div class="logo__carousel__item">
                            <a href="#"><img src="{{asset('hiroto-master/img/logo/logo-1.png')}}" alt=""></a>
                        </div>
                        <div class="logo__carousel__item">
                            <a href="#"><img src="{{asset('hiroto-master/img/logo/logo-2.png')}}" alt=""></a>
                        </div>
                        <div class="logo__carousel__item">
                            <a href="#"><img src="{{asset('hiroto-master/img/logo/logo-3.png')}}" alt=""></a>
                        </div>
                        <div class="logo__carousel__item">
                            <a href="#"><img src="{{asset('hiroto-master/img/logo/logo-4.png')}}" alt=""></a>
                        </div>
                        <div class="logo__carousel__item">
                            <a href="#"><img src="{{asset('hiroto-master/img/logo/logo-5.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer__content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer__about">
                            <div class="footer__logo">
                                <a href="#"><img src="{{ asset('horoto-master/img/logo.png')}}" alt=""></a>
                            </div>
                            <h4>(84) 984-641-362</h4>
                            <ul>
                                <li>Viet Nam</li>
                                <li>phuoc04012000@gmail.com</li>
                            </ul>
                            <div class="footer__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1 col-md-5 offset-md-1 col-sm-6">
                        <div class="footer__widget">
                            <h4>Quick Link</h4>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Booking</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Review</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">Services</a></li>
                                <li><a href="{{ route('rooms.index' )}}">Our Room</a></li>
                                <li><a href="#">Restaurants</a></li>
                                <li><a href="#">Payments</a></li>
                                <li><a href="#">Events</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <div class="footer__newslatter">
                            <h4>Subscribe our newlatester</h4>
                            <form action="#">
                                <input type="text" placeholder="Your E-mail Address">
                                <button type="submit">Subscribe</button>
                            </form>
                            <div class="footer__newslatter__find">
                                <h5>Find Us:</h5>
                                <div class="footer__newslatter__find__links">
                                    <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                    <a href="#"><i class="fa fa-map-o"></i></a>
                                    <a href="#"><i class="fa fa-dribbble"></i></a>
                                    <a href="#"><i class="fa fa-forumbee"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__copyright">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <div class="footer__copyright__text">
                            <p>Copyright &copy; <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="fa fa-heart"
                                    aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a></p>
                        </div>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <ul class="footer__copyright__links">
                            <li><a href="#">Terms Of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    @yield('js')
    <!-- Js Plugins -->
    <script src="{{ asset('hiroto-master/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('hiroto-master/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('hiroto-master/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('hiroto-master/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('hiroto-master/js/jquery.slicknav.js')}}"></script>
    <script src="{{ asset('hiroto-master/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('hiroto-master/js/main.js')}}"></script>

</body>

</html>