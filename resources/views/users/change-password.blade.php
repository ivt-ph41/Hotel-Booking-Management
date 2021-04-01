<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hiroto | Change Password</title>
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
        <form class="login100-form validate-form" action="{{ route('users.update-password') }}" method="POST">
          @csrf
          @method('PUT')
          <span class="login100-form-title p-b-49">
            Change Password
          </span>

          <div class="wrap-input100 validate-input m-b-23" data-validate="Current password required">
            <span class="label-input100">Current Password</span>
            <input class="input100" type="password" name="current_password" value="{{old('current_password')}}"
              placeholder="Type your current password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
          </div>
          @if (session()->has('error'))
          <div>
            <p style="color: rgb(194, 11, 11)">{{session()->get('error')}}</p>
          </div>
          @endif

          <div class="wrap-input100 validate-input m-b-23" data-validate="New password is required">
            <span class="label-input100">New Password</span>
            <input class="input100" type="password" value="{{old('new_password')}}" name="new_password"
              placeholder="Type your new password">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
          </div>
          @if ($errors->has('new_password'))
          <p style="color: rgb(194, 11, 11)">{{$errors->first('new_password')}}
          </p>
          @endif
          <div class="wrap-input100 validate-input m-b-23" data-validate="New password comfirm is required">
            <span class="label-input100">New Password Confirmation</span>
            <input class="input100" type="password" name="new_password_confirmation"
              value="{{old('new_password_confirmation')}}" placeholder="Type your new password again">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">
                Accept Change
              </button>
            </div>

            @if (session()->has('success'))
            <div>
              <p style="color: rgb(67, 255, 50)">{{session()->get('success')}}</p>
            </div>
            @endif
          </div>

          <div class="flex-col-c p-t-155">
            <a title="Click to return homepage" href="{{route('/')}}" class="txt2">
              Home page
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