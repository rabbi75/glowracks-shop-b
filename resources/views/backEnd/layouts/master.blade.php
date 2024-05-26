<!-- head section -->
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  @foreach($mainlogo as $key=>$value)
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset($value->image)}}">
  <link rel="icon" rel="apple-touch-icon" sizes="120x120" href="{{asset('public/frontEnd/images/')}}/apple-icon-120x120.png"/>
  @endforeach
  <title>@foreach($generalInfoes as $sitename) {{ $sitename->sitename }} @endforeach || @yield('title','Dashboard')</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/custom/css/custom.css">
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/custom/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/custom/css/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <!-- DataTables -->
   <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/plugins/select2/select2.min.css">
    <!-- datatable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
  <!-- toastr css -->
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/css/toastr.min.css">
  <!-- sweet alert2 -->
  <link rel="stylesheet" href="{{asset('public/backEnd')}}/css/sweetalert2.min.css">
  <!-- custom css -->
  <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/zoom.css">
    <!--news.css-->

  <link rel="stylesheet" href="{{asset('public/backEnd/')}}/plugins/summernote/summernote-lite.css">
    <!--news.css-->
 <link rel="stylesheet" href="{{asset('public/backEnd')}}/css/custom.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- jQuery -->
<script src="{{asset('public/backEnd')}}/plugins/jquery/jquery.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<!-- head section end-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="{{url('/')}}" class="nav-link" target="_blank"><i class="fa fa-globe"></i> Visit Site</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('editor/comment/unread')}}" class="nav-link notify"> <i class="fa fa-envelope"></i><span class="bg1">{{$unseencomments->count()}}</span> </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('editor/comment/all')}}" class="nav-link notify"> <i class="fa fa-comments"></i><span class="bg2">{{$allcomments->count()}}</span> </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="#">
        <i class="fa fa-shopping-bag"></i>
        <span class="badge badge-warning navbar-badge">15</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
          <img src="{{asset(auth::user()->image)}}" class="img-circle elevation-2" alt="User brand-imagee" style="width: 40px; height: 40px; margin-top: -8px; margin-right: 25px;" ><i class="fa fa-align-left"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <a href="{{url('/superadmin/dashboard')}}" class="dropdown-item">
            <i class="fa fa-home"></i> Dashboard
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('password/change')}}" class="nav-link dropdown-item" >
            <i class="fa fa-key"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
            <i class="fa fa-sign-out"></i>
              Logout
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
             </form>
            </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/superadmin/dashboard')}}" class="brand-link">
      <img src="{{asset('public/backEnd')}}/dist/img/AdminLTELogo.png" alt="Ecomfour Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>@foreach($generalInfoes as $sitename) {{ $sitename->sitename }} @endforeach</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="padding: 20px 0" >
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="{{url('superadmin/dashboard')}}" class="nav-link">
              <i class="fa fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if(Auth::user()->role_id==1)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-user"></i>
              <p>
                Users
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/superadmin/user/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Admin </p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
           @endif

          <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa fa-users"></i>
            <p>
              Customer
              <i class="right fa fa-angle-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/editor/customer/all')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>All Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/editor/customer/active')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Active Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/editor/customer/inactive')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Inactive Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/editor/customer/sms/unverified')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>SMS Unverified</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/editor/customer/email-send')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Send Email</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/editor/customer/sms-send')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Send SMS</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{url('/editor/clientfeedback/list')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Customer Feedback</p>
              </a>
            </li> --}}
          </ul>
        </li>
         <!-- nav item end -->
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-pie-chart"></i>
              <p>
               Inventory
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/product/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>All Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product/stock')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product/stock-warning')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Stok Warning</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product/stock-out')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Stock Out</p>
                </a>
              </li>
              @if(Auth::user()->role_id <= 2)
              <li class="nav-item">
                <a href="{{url('/admin/expence-category/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Expence Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/expence/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Expence</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/reports/summary')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Summary</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-shopping-bag"></i>
              <p>
               Product Manage
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{url('/editor/product/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/category/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/subcategory/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Subcategory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/childcategory/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Child Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product-size/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Product Size</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product-color/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Product Color</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/brand/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Brand</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-bar-chart"></i>
              <p>
               Order Manage
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach($ordertypes as $ordertype)
              <li class="nav-item">
                <a href="{{url('/editor/order/manage/'.$ordertype->slug)}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>{{$ordertype->name}} @php $products = App\Order::where('orderStatus',$ordertype->id)->count(); @endphp
                  </p><span>({{$products}})</span>
                </a>
              </li>
              @endforeach
              <li class="nav-item">
                <a href="{{url('/editor/order/cancel/request')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Cancel Request</p>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview"> 
            <a href="#" class="nav-link">
              <i class="fa fa-map-o"></i>
              <p>Location
              <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/admin/district/manage')}}" class="nav-link">
                    <i class="fa fa-minus"></i>
                    <p>District</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/admin/area/manage')}}" class="nav-link">
                    <i class="fa fa-minus"></i>
                    <p> Area/Upazila</p>
                  </a>
                </li>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fa fa-diamond"></i>
              <p>
                Marketing Tools
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/adcategory/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Ad Category </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/advertisment/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Ad Image </p>
                </a>
              </li>
              <li class="nav-item">
               <a href="{{url('/admin/couponcode/manage')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p> Coupon Code</p>
              </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
           <i class="fa fa-file"></i>
              <p>
                Page Settings
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/pagecategory/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Page Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/createpage/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>All Page </p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="fa fa-cog"></i>
              <p>
                Front Settings
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/editor/slider/manage')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Slider</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/editor/highlight/manage')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Highlighted Content</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/editor/clientfeedback/manage')}}" class="nav-link">
                <i class="fa fa-minus"></i>
                <p>Client Feedback</p>
              </a>
            </li>
            
              <li class="nav-item">
                <a href="{{url('/editor/blogcategory/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Blog Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/blog/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Blog</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/document/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Documents</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
           <i class="fa fa-th-large"></i>
              <p>
                Site Settings
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/logo/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Logo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/social-media/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Social Icon</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/contactinfo/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Contact Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/password/change')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/general/setting')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>General Setting</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
           <i class="fa fa-clipboard"></i>
              <p>
                Reports
                <i class="right fa fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <li class="nav-item">
                <a href="{{url('/editor/product/stock/report')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Stock Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product/order/report')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Order Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/expence/report/manage')}}" class="nav-link">
                  <i class="fa fa-minus"></i>
                  <p>Expence Report</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="{{url('superadmin/dashboard')}}" class="nav-link">
           <i class="fa fa-modx"></i>
              <p>
                Clear Cache
              </p>
            </a>
            
          </li>
          <!-- nav item end -->
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 t welcome-dash">Welcome !! {{Auth::user()->name}}</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('superadmin/dashboard')}}">Home</a></li>
            <?php $segments = ''; ?>
            @foreach(Request::segments() as $segment)
                <?php $segments .= '--'.$segment; ?>
                <li class="breadcrumb-item active">
                   {{$segment}}
                </li>
            @endforeach
        
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->
    <!-- Main content -->
    @yield('main_content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <strong> Developed By<a  href="https://glowracks.com" target="_blank" href="superadmin"> Glowracks IT</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark right-sidebar" style="background: url({{asset('public/backEnd/images/sidebar.jpg')}});background-size: cover;background-position: center;background-repeat: no-repeat;padding: 20px 0">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
             
              <img src="{{asset('public/backEnd/')}}/images/sign-out.png">
              <p>Logout</p>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
             </form>
            </a>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="{{url('password/change')}}" class="nav-link">
              <img src="{{asset('public/backEnd/')}}/images/key.png">
              <p>Change Password</p>
            </a>
          </li>
          <!-- nav item end -->
      </ul>
    </nav>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backEnd')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="{{asset('public/backEnd')}}/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('public/backEnd')}}/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr(".mydate", {
    dateFormat: "Y-m-d",
  });
  flatpickr(".flash", {
    dateFormat: "F j, Y",
  });

</script>

<script src="{{asset('public/backEnd')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{asset('public/backEnd')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('public/backEnd')}}/plugins/knob/jquery.knob.js"></script>
<script src="{{asset('public/frontEnd/')}}/js/zoomsl.min.js"></script>
<!--jqzoom.js js-->
<script>
    $(document).ready(function () {
        $(".block__pic").imagezoomsl({
            zoomrange: [3, 3]
        });
    });
</script>
<!-- daterangepicker -->
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('public/backEnd')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{asset('public/backEnd')}}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->

<!-- select -->
<script src="{{asset('public/backEnd')}}/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backEnd')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('public/backEnd')}}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- toastr js -->
<script src="{{asset('public/backEnd')}}/js/toastr.min.js"></script>
  {!! Toastr::message() !!}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Datatable -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://packenmove.com/public/backEnd/plugins/datatables/jquery.dataTables.js"></script>
  <script src="https://packenmove.com/public/backEnd/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>

 
 
 
<script>
$(document).ready(function() {
  $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'copy',
              text: 'Copy',
          },
          {
              extend: 'excel',
              text: 'Excel',
          },
          
          {
              extend: 'pdfHtml5',
              exportOptions: {
                 columns: [ 0, 1, 2, 3, 4, 5, 6,7,8]
              }
          },
          
          {
              extend: 'print',
              text: 'Print',
          },
          {
              extend: 'print',
              text: 'Print all',
              exportOptions: {
                  modifier: {
                      selected: null
                  }
              }
          },
         
          
      ],
      select: true
  } );
  
   table.buttons().container()
      .appendTo( '#example_wrapper .col-md-6:eq(11)' );
});
</script>
  <script src="{{asset('public/backEnd/')}}/plugins/summernote/summernote-lite.js"></script>
<!--camera js-->
<script>
      $('.summernote').summernote({
        callbacks: {
        // Clear all formatting of the pasted text
        onPaste: function (e) {
          var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
          e.preventDefault();
          setTimeout( function(){
            document.execCommand( 'insertText', false, bufferText );
          }, 300 );

        }
    }
      });
  </script>
<script src="{{asset('public/backEnd')}}/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
   $('.select2').select2()
       });
</script>
<script type="text/javascript">
        $('#proCategory').change(function(){
        var ajaxId = $(this).val();    
        if(ajaxId){
            $.ajax({
               type:"GET",
               url:"{{url('ajax-product-subcategory')}}?category_id="+ajaxId,
               success:function(res){               
                if(res){
                    $("#proSubcategory").empty();
                    $("#proSubcategory").append('<option value="0">Select..</option>');
                    $.each(res,function(key,value){
                        $("#proSubcategory").append('<option value="'+key+'">'+value+'</option>');
                    });
               
                }else{
                   $("#proSubcategory").empty();
                }
               }
            });
        }else{
            $("#proSubcategory").empty();
            $("#proSubcategory").empty();
        }      
       });
        $('#proSubcategory').on('change',function(){
        var ajaxId = $(this).val();    
        if(ajaxId){
            $.ajax({
               type:"GET",
               url:"{{url('ajax-product-childsubcategory')}}?category_id="+ajaxId,
               success:function(res){               
                if(res){
                    $("#proChildcategory").empty();
                     $("#proChildcategory").append('<option value="0">Select...</option>');
                    $.each(res,function(key,value){
                        $("#proChildcategory").append('<option value="'+key+'">'+value+'</option>');
                    });
               
                }else{
                   $("#proChildcategory").empty();
                }
               }
            });
        }else{
            $("#proChildcategory").empty();
        }
            
       });
    </script>

<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>
<script>
  feather.replace()
</script>
</body>
</html>

