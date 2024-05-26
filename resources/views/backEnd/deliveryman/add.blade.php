@extends('backEnd.layouts.master')
@section('title','Deliveryman Add')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Add Deliveryman information</h3>
          <div class="short_button">
            <a href="{{url('/superadmin/deliveryman/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="custom-bg">
                    <form action="{{url('/superadmin/deliveryman/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Nmae <span>*</span></label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                            
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                            
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phonenumber">PhoneNumber <span>*</span></label>
                                <input type="text" name="phonenumber" class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" value="{{ old('phonenumber') }}">
                            
                                @if ($errors->has('phonenumber'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phonenumber') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="commission">Commission <span>*</span></label>
                                <input type="text" name="commission" class="form-control{{ $errors->has('commission') ? ' is-invalid' : '' }}" value="{{ old('commission') }}">
                            
                                @if ($errors->has('commission'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('commission') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label>Commission Type</label>
                              <select name="commissiontype" class="form-control select2 {{ $errors->has('commissiontype') ? ' is-invalid' : '' }}" value="{{ old('commissiontype') }}">
                                <option value="">=====select commissin type ======</option>
                                <option value="1">Flate</option>
                                <option value="2">Flate</option>
                              </select>

                              @if ($errors->has('commissiontype'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('commissiontype') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password </label>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}">
                            
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Picture">Image</label>
                                <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image') }}" accept="image/*">
                            
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="address">Address <span>*</span></label>
                                <input type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" accept="address/*">
                            
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- form-group end -->

                       
                        <div class="col-sm-12">
                          <label for="">Publication Status <span>*</span></label>
                          <div class="box-body pub-stat display-inline">
                              
                              <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" id="active" name="status" value="1">
                              <label for="active">Active</label>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>

                          <div class="box-body pub-stat display-inline">
                              <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" name="status" value="0" id="inactive">
                              <label for="inactive">Inactive</label>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>
                       </div>
                        </div>
                      <div class="col-sm-6">
                          <div class="form-group mrt-30">
                              <button type="submit" class="btn submit-button">submit</button>
                              <button type="reset" class="btn btn-default">clear</button>
                          </div>
                      </div>
                      <!-- /.form-group -->
                 </div>
                </div>
              </div>
            <!-- /.col -->
              </form>
          </div>
        <!--card-body-->
      </div>
      <!--card-->
    </div>
  <!--container-fluid-->
  </section>
  <!-- /.content -->
@endsection