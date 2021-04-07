<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hiroto | Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  {{-- favicon --}}
  <link rel="shortcut icon" href="https://img.icons8.com/dusk/64/000000/3-star-hotel.png" type="image/x-icon">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/vendor/bootstrap/css/bootstrap.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/vendor/animate/animate.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/vendor/css-hamburgers/hamburgers.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/vendor/animsition/css/animsition.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/vendor/select2/select2.min.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/vendor/daterangepicker/daterangepicker.css')}}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('Login/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('Login/css/main.css')}}">
  <!--===============================================================================================-->
</head>

<body>

  <div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('Login/images/bg-01.jpg')}}');">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
        <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
          @csrf
          <span class="login100-form-title p-b-49">
            Login
          </span>

          <div class="wrap-input100 validate-input m-b-23" data-validate="Email is reauired">
            <span class="label-input100">Email</span>
            <input class="input100" type="text" value="{{old('email')}}" name="email" placeholder="Type your email">
            <span class="focus-input100" data-symbol="&#xf206;"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" name="password" placeholder="Type your password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
          </div>

          <div class="text-right p-t-8 p-b-31">
            <a href="#">
              Forgot password?
            </a>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">
                Login
              </button>
            </div>
            @if (session()->has('error'))
            <div>
              <p style="color: rgb(194, 11, 11)">{{session()->get('error')}}</p>
            </div>
            @endif
          </div>

          <div class="flex-col-c p-t-155">
            <a href="{{route('register')}}" class="txt2">
              Register
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>

  <!--===============================================================================================-->
  <script src="{{asset('Login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('Login/vendor/animsition/js/animsition.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('Login/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('Login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('Login/vendor/select2/select2.min.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('Login/vendor/daterangepicker/moment.min.js')}}"></script>
  <script src="{{asset('Login/vendor/daterangepicker/daterangepicker.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('Login/vendor/countdowntime/countdowntime.js')}}"></script>
  <!--===============================================================================================-->
  <script src="{{asset('Login/js/main.js')}}"></script>

</body>

</html>