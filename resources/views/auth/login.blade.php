<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Beverages Admin | Login/Register</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/dash/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/dash/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/dash/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('assets/dash/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/dash/build/css/custom.min.css') }}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{ route('login') }}" method="post" id="loginform" name="loginform">
                @csrf
              <h1>{{ __('Login Form') }}</h1>
              <div>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required="" />
                @error('username')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required="" />
                @error('password')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <div>
              <a class="btn btn-default submit" href="#" onclick="document.getElementById('loginform').submit();">{{ __('Login') }}</a>
              <input type="hidden" value="login" name="Login"/>
              @if (Route::has('password.request'))
                <a class="reset_pass" href="{{ route('password.request') }}">{{ __('Lost your password?') }}</a>
              @endif
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i></i> Beverages Admin</h1>
                  <p>©2016 All Rights Reserved. Beverages Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="{{ route('register') }}" method="post" id="registerform" name="registerform">      
                @csrf        
                <h1>{{ __('Create Account') }}</h1>
              <div>
                <input id="name" type="text" class="form-control @error('register.name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Fullname" required="" />
                @error('name', 'register')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <input id="username" type="text" class="form-control @error('username', 'register') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required="" />
                @error('username', 'register')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <input id="email" type="email" class="form-control @error('email', 'register') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required="" />
                @error('email', 'register')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <input type="password" class="form-control @error('password', 'register') is-invalid @enderror" name="password" placeholder="Password" required="" />
                @error('password', 'register')
                  <p style="color:red">{{ $message }}</p>
                @enderror
              </div>
              <div>
              <a class="btn btn-default submit" href="#" onclick="document.getElementById('registerform').submit();">{{ __('Submit') }}</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-graduation-cap"></i></i> Beverages Admin</h1>
                  <p>©2016 All Rights Reserved. Beverages Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
