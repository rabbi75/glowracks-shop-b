@extends('backEnd.layouts.master')
@section('title','Deliveryman')
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

          <h3 class="profile-username text-center">{{$profileInfo->name}}</h3>
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
           {{$profileInfo->phonenumber}}
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
          <strong><i class="fa fa-map-marker mr-1"></i> Deliveryman</strong>
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
                <span class="info-box-text">Total Commission</span>
                <span class="info-box-number">50</span>
              </div>
            </div>
          </div>
         <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box cus-box bg-2">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"> Delivered Percel</span>
                <span class="info-box-number">{{$deliverdpercel}}</span>
              </div>
            </div>
          </div>
         <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box cus-box bg-5">
              <span class="info-box-icon"><i class="fa fa-truck"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Percel</span>
                <span class="info-box-number">{{$allpercel}}</span>
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
              <form class="form-horizontal" action="{{url('/superadmin/deliveryman/update')}}" method="POST">
                @csrf
                <input type="hidden" name="hidden_id" value="{{$profileInfo->id}}">
                <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{$profileInfo->name}}" placeholder="Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="{{$profileInfo->email}}" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phonenumber" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="phonenumber" id="phonenumber" value="{{$profileInfo->phonenumber}}" placeholder="Phone">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="address" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" value="{{$profileInfo->address}}" placeholder="Address">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="commission" class="col-sm-2 col-form-label">Commission</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="commission" value="{{$profileInfo->commission}}" placeholder="Commission">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="commission" class="col-sm-2 col-form-label">Commission Type</label>
                  <div class="col-sm-10">
                    <select name="commissiontype" class="form-control select2 {{ $errors->has('commissiontype') ? ' is-invalid' : '' }}" value="{{$profileInfo->commissiontype}}">
                      <option value="">=====select  Commissiontype======</option>
                      <option value="1">flate</option>
                      <option value="2">flate</option>
                     </select>
                     @if ($errors->has('commissiontype'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('commissiontype') }}</strong>
                        </span>
                     @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label for="image" class="col-sm-2 col-form-label">Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" value="{{$profileInfo->image}}" placeholder="image">
                    <img src="{{asset($profileInfo->image)}}" alt="" style="width: 40px; height: 40px;" class="responsive_image">
                      @if ($errors->has('image'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('image') }}</strong>
                      </span>
                      @endif
                  </div>
                </div>
                <div class="col-sm-12">
                   <label for="">Publication Status <span>*</span></label>

                  <div class="box-body pub-stat display-inline">
                      
                      <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" id="active" name="status" value="1" title="published">
                      <label for="active">Active</label>
                      @if ($errors->has('status'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('status') }}</strong>
                      </span>
                      @endif
                  </div>

                        <div class="box-body pub-stat display-inline">
                            <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" name="status" value="0" id="inactive" title="unpublished">
                            <label for="inactive">Inactive</label>
                            @if ($errors->has('status'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif
                        </div>
                      </div>
                      </div>
                      <!-- /.form-group -->
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
<script type="text/javascript">
      document.forms['editForm'].elements['commissiontype'].value="{{$profileInfo->commissiontype}}"
      document.forms['editForm'].elements['status'].value="{{$profileInfo->status}}"
    </script>
@endsection