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
            <form action="{{ route('signin') }}" method="post" id="loginform" name="loginform">
                @csrf
              <h1>Login Form</h1>
              <div>
                <p style="color:red">
                    @if($errors->has('login_error'))
                        {{ $errors->first('login_error') }}
                    @endif
                </p>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="" />
              </div>
              <div>
                <p style="color:red">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
              <a class="btn btn-default submit" href="#" onclick="document.getElementById('loginform').submit();">Log in</a>
              <input type="hidden" value="login" name="Login"/>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register" onclick="clearErrors()"> Create Account </a>
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
            <form action="{{ route('signup') }}" method="post" id="registerform" name="registerform">      
                @csrf        
                <h1>Create Account</h1>
              <div>
                <p style="color:red">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Fullname" required="" />
              </div>
              <div>
                <p style="color:red">
                    @error('username')
                        {{ $message }}
                    @enderror
                </p>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="" />
              </div>
              <div>
                <p style="color:red">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required="" />
              </div>
              <div>
                <p style="color:red">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
              <a class="btn btn-default submit" href="#" onclick="document.getElementById('registerform').submit();">Submit</a>
              <input type="hidden" name="Registration" value="submit"/>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register" onclick="clearErrors()"> Log in </a>
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
    <!-- <script>
        function clearErrors() {
            @if(session()->has('errors'))
                {{ session()->forget('errors') }}
            @endif
        }
    </script> -->
  </body>
</html>
