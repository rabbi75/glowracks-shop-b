@extends('frontEnd.layouts.pages.deliveryman.master')
@section('title','Change Password')
@section('content')
  <section class="breadcrumb-section">
    <div class="col-sm-12">
      <div class="bread_inner">
        <div class="row">
          <div class="col-sm-6">
            <div class="admin-dashboard">
             <h5>Change Password</h5>
            </div>
          </div>
        <div class="col-sm-6">
          <div class="cust-breadcrumb">
          <ul>
              <li><a href="{{asset('/deliveryman/account')}}">Home</a></li>
              <li>
                  <i class="fa fa-angle-double-right" aria-hidden="true"></i>
              </li>
              <li>
                  <a href="" class="bread_last">Change Password</a>
              </li>
          </ul>
         </div>
        </div>
        </div>
      </div>
    </div>
 </section>

  <section class="result_list_area">
   <div class="row justify-content-center">
     <div class="col-md-8">
        <div class="pass_change_inner">
          <form action="{{url('deliveryman/change-password')}}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="row">
                  <div class="col-sm-12">
                  <div class="form-group">
                    <label for="old_password" class="col-form-label text-md-right">Old Password</label>
                      <input id="old_password" type="password" class="form-control" name="old_password">
                  </div>
                  </div>
                  <!-- form group end -->
                  <div class="col-sm-12">
                      <div class="form-group">
                         <label for="new_password" class="col-form-label text-md-right">New Password</label>
                          <input id="new_password" type="password" class="form-control" name="new_password">
                    </div>
                  </div>
                   <!-- form group end -->
                  <div class="col-sm-12">
                      <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                       </div>
                  </div>
                  <!-- form group end -->
                  <div class="col-sm-6">
                      <div class="form-group">
                          <button type="submit" class="btn btn-success submit-button">submit</button>
                          <button type="reset" class="btn btn-danger btn-default">clear</button>
                      </div>
                  </div>
                  <!-- /.form-group -->
              </div>
             </form>
           </div>
     </div>
   </div>
  </section>

  

@endsection