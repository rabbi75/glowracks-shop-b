<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Foreget Password Vefiry</title>
       <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/bootstrap.min.css">
     <!-- bootstrap css -->
     <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/frontEnd/images/favicon.png')}}"/>
     <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/style.css">
  </head>

  <body>
      <section class="section-padding login_area" style="background:url('{{asset('public/frontEnd')}}/images/loginbanner.jpg');">
           <div class="container">
             <div class="row justify-content-center">
               <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="login-content">
                        <h2 class="login-title">Forget Password Verify</h2>
                        <p>Sign In with A Phone Number</p>
                        <form action="{{url('/deliveryman/forget/savepassword')}}" method="POST">
                        @csrf
                        <label for="verifyToken">Verify Token</label>
                        <input type="text" name="verifyToken" class="form-control " value="" placeholder="****" required="required">
                        <label for="newpassword">New Password</label>
                        <input type="password" name="newpassword" class="form-control" value="" placeholder="Password" required="required">

                        <input class="login-sub" type="submit" value="Submit">
                        </form>
                        <div class="forget_pass">
                          <form action="{{url('deliveryman/forget-code/resend')}}">
                            <button> <i class="fa fa-refresh"></i> Resend</button>
                          </form>
                        </div>

                    </div>
                    <!--login content end-->
                </div>
                <!-- col end -->
             </div>
           </div>
        </section>
  </body>
  </html>  
        