@extends('backEnd.layouts.master')
@section('title','Customer')
@section('main_content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{asset($profileInfo->image)}}" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{$profileInfo->fullName}}</h3>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">About Me</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fa fa-phone mr-1"></i> Phone</strong>
          <p class="text-muted">
           {{$profileInfo->phoneNumber}}
          </p>
          <hr>
          <strong><i class="fa fa-envelope-o mr-1"></i> Email</strong>
          <p class="text-muted">
           {{$profileInfo->email}}
          </p>
          <hr>
          <strong><i class="fa fa-map-marker mr-1"></i> Address</strong>
          <p class="text-muted">
           {{$profileInfo->address}}
          </p>
          <hr>
          <strong><i class="fa fa-check-circle mr-1"></i> Status</strong>
          @if($profileInfo->status==1)
          <p class="text-success">
           Active
          </p>
          @else
          <p class="text-danger">
           Active
          </p>
          @endif
          <hr>
          <strong><i class="fa fa-map-marker mr-1"></i> Customer Since</strong>
          <p class="text-muted">
          {{date('F d, Y', strtotime($profileInfo->updated_at))}}
          </p>
          <hr>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="row">
         <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box cus-box bg-3">
              <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Shipping</span>
                <span class="info-box-number">{{$totalshipping}}</span>
              </div>
            </div>
          </div>
         <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box cus-box bg-2">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Transection</span>
                <span class="info-box-number">{{$totaltransection}}</span>
              </div>
            </div>
          </div>
         <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box cus-box bg-5">
              <span class="info-box-icon"><i class="fa fa-truck"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Order</span>
                <span class="info-box-number">{{$totalorder}}</span>
              </div>
            </div>
          </div>
       </div>
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="settings">
              <form class="form-horizontal" action="{{url('editor/customer/profile/update')}}" method="POST">
                @csrf
                <input type="hidden" name="hidden_id" value="{{$profileInfo->id}}">
                <div class="form-group row">
                  <label for="fullName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="fullName" name="fullName" value="{{$profileInfo->fullName}}" placeholder="Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="{{$profileInfo->email}}" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phoneNumber" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="phoneNumber" id="phoneNumber" value="{{$profileInfo->phoneNumber}}" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="address" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" value="{{$profileInfo->address}}" placeholder="Address">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" @if($profileInfo->status=1) checked @endif> Active
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="verify"  @if($profileInfo->verify=1) checked @endif > Vefiry
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Update</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection