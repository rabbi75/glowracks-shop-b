<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Login :: Grocery One</title>
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/bootstrap.min.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/frontEnd/images/favicon.png')}}"/>
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/style.css">
  </head>

  <body>
      <section class="section-padding login_area" style="background:url('{{asset('public/frontEnd')}}/images/rider-login.jpg');">
           <div class="container">
             <div class="row justify-content-center">
               <div class="col-lg-5 col-md-6 col-sm-8">
                    <div class="login-content">
                        <h2 class="login-title">Rider Login</h2>
                        <p>Sign In with A Phone Number</p>
                        <form action="{{url('/deliveryman/login')}}" method="POST" autocomplete="off">
                        @csrf
                          <label for="phone">Phone Number</label>
                          <input type="number" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Phone Number" autocomplete="off" required="required" >
                          
                          <label for="password">Password</label>
                          <input type="password" name="password" class="form-control"  placeholder="Password" autocomplete="off" required="required">

                          <input class="login-sub" type="submit" value="Login">
                        </form>
                        <div class="forget_pass">
                            <a href="{{url('deliveryman/forgetpassword')}}">Forget Your Password?</a>
                        </div>

                    </div>
                    <!--login content end-->
                </div>
                <!-- col end -->
             </div>
           </div>
        </section>

       <script src="{{asset('./public/frontEnd/')}}/js/jquery-3.3.1.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
       <script src="{{asset('./public/frontEnd/')}}/js/bootstrap.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}


  </body>
  </html>  
        