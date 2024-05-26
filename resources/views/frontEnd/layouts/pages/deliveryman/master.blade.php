<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Grocery One:: @yield('title','Dashboard')</title>
    <meta property="og:image" content="thumbnile.png">
    <meta name="description" content="Your gorgeous description"> 
    <meta name="og:title" property="og:title" content="BIO-Knowledge Center"> 
    <meta name="robots" content="index, follow"> 
    <!--======css start========-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/frontEnd/images/favicon.png')}}"/>
    <!-- fabeicon css -->
    <link rel="stylesheet" href="{{asset('/public/frontEnd/')}}/css/bootstrap.min.css">
     <!-- fontawesome css -->
     <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('public/backEnd')}}/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('/public/frontEnd/')}}/css/meanmenu.min.css">
    <link rel="stylesheet" href="{{asset('/public/frontEnd/')}}/css/font-awesome.min.css">
     <!-- meanmenu css -->
    <link rel="stylesheet" href="{{asset('/public/frontEnd/')}}/css/member.css">
   <!-- style css -->
   
    <!--======css end========-->
</head>
<body>
<!-- Start Header Area -->
  <section id="mobile-menu">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="mobile-menu">
                    <div class="mobile-header-top">
                    @foreach($mainlogo as $key=>$value)
                    <a href="{{url('/')}}">
                        <img src="{{asset($value->image)}}" alt="natural vantage">
                    </a>
                    @endforeach
                </div>
                    <ul>
                    <li>
                       <a href="{{asset('deliveryman/account')}}"> Dashboard 
                       </a>
                    </li>

                    <li>
                       <a href="{{asset('deliveryman/profile')}}"> Profile 
                       </a>
                    </li>
                    <li>
                       <a href="{{url('deliveryman/myorder')}}"> My Order </a>
                    </li>
                    <li>
                       <a href="{{url('deliveryman/change/password')}}">
                         Change Password 
                      </a>
                    </li>
                    <li>
                       <a  href="{{url('deliveryman/logout')}}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout
                       </a>
                    </li>
                    </ul>
                </div>
            </div>
            <!--col end-->
        </div>
        <!--row end-->
    </div>
    <!--container end-->
</section>
 <div class="wrapper">
      <div class="sidebar">
        <div class="sidebar-logo">
            @foreach($mainlogo as $key=>$value)
            <a href="{{url('/')}}">
                <img src="{{asset($value->image)}}" alt="natural vantage">
            </a>
            @endforeach
        </div>
        <div class="sidebar-menu">
          <ul>
            <li class="control-sidebar @if(Request::is('deliveryman/account')) active @endif" >
               <a href="{{asset('deliveryman/account')}}">
             <i class="fa fa-home"></i> Dashboard <span><i class="fa fa-angle-right"></i></span>
               </a>
            </li>

            <li class="control-sidebar">
               <a href="{{asset('deliveryman/profile')}}">
                <i class="fa fa-user icon"></i> Profile <span><i class="fa fa-angle-right"></i></span>
               </a>
            </li>
            <li class="control-sidebar">
               <a href="{{url('deliveryman/myorder')}}"><i class="fa fa-list-alt icon"></i> My Order <span><i class="fa fa-angle-right"></i></span></a>
            </li>
            <li class="control-sidebar">
               <a href="{{url('deliveryman/change/password')}}">
                <i class="fa fa-unlock" aria-hidden="true"></i>
                 Change Password 
                 <span><i class="fa fa-angle-right"></i>
                 </span>
              </a>
            </li>
            <li class="control-sidebar">
               <a  href="{{url('deliveryman/logout')}}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Logout <span><i class="fa fa-angle-right"></i></span>
               </a>
            </li>
          </ul>
        </div>
      </div>
        <div class="content">
        <div class="cust_header">  
            <div class="row"> 
                <div class="col-sm-3">  
                   <ul class="snav-left">
                     <li>
                        <a href="{{url('/')}}" class="custom-btn"><i class="fa fa-clock-o"></i> <span id="digital-clock"></span></a>
                      </li>
                   </ul>
                </div>
                <div class="col-sm-5">  
                   <div class="marque">
                      <a href="{{url('/')}}"><i class="fa fa-bell-o"></i> <marquee behavior="" direction=""> <p><span></span> Welcome to GroceryOne</p></marquee></a>
                    </div>
                </div>
                <div class="col-sm-4"> 
                    <div class="menu-list">
                      <ul>
                        <li>
                          <a class="nav-link" data-toggle="dropdown" href="#">
                          <img src="{{asset('/public/uploads/')}}/avatar/avatar.png" style="width: 30px; height: 30px;" alt="image">
                          <span class="badge badge-danger navbar-badge"></span>
                        </a>
                        </li>
                        <li>
                          <div class="dropdown">
                            <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fa fa-th-large"></i></a>
                            </button>
                            <div class="dropdown-menu dropdown-custom" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{url('deliveryman/account')}}"><i class="fa fa-home"></i> Dashboard</a>
                              <a class="dropdown-item" href="{{url('deliveryman/change/password')}}"><i class="fa fa-key"></i> Change Password</a>
                              <a class="dropdown-item" href="{{url('deliveryman/logout')}}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Logout</a>
                              <form id="logout-form" action="{{ url('deliveryman/logout') }}" method="POST" style="display: none;">
                                @csrf
                             </form>
                            </div>
                          </div>
                        </li>
                      </ul>

                  </div>
                </div>
            </div>  
        </div>
         @yield('content')

      </div>
  </div>

    <!-- ======script js start======= -->
 
   <!-- scrollUp js -->

   <script src="{{asset('/public/frontEnd/')}}/js/jquery-3.3.1.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="{{asset('/public/frontEnd/')}}/js/popper.min.js"></script>
   <script src="{{asset('/public/frontEnd/')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/backEnd')}}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
  <script src="{{asset('/public/frontEnd/')}}/js/jquery.meanmenu.min.js"></script>
  <!-- meanmenu js -->
  <script>
    $('.dropdown-toggle').dropdown()
  </script>
    
    <script>
  function getDateTime() {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
         return dateTime;
    }

    // example usage: realtime clock
    setInterval(function(){
        currentTime = getDateTime();
        document.getElementById("digital-clock").innerHTML = currentTime;
    }, 1000);
</script>
<script>jQuery('.mobile-menu').meanmenu();</script>
</body>
</html>