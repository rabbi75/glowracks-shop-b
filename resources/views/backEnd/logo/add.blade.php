@extends('backEnd.layouts.master')
@section('title','Logo Add')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Add logo information</h3>
          <div class="short_button">
            <a href="{{url('/editor/logo/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-md-8">
                  <div class="custom-bg">
                    <form action="{{url('/editor/logo/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                              <div class="note">
                                <div class="row">
                                  <div class="col-sm-2">
                                    <div class="note-icon">
                                      <i class="fa fa-info"></i>
                                    </div>
                                  </div>
                                  <div class="col-sm-10">
                                    <div class="note-text">
                                      <p>Please Upload Your Image Follow The Insctruction</p>
                                      <p>1.For main logo: Width=297x,Height=80px,Size=Max 2MB,Type=png,gif </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- image note -->
                                <label for="image" class="mrt-30">Logo</label>
                                <input type="file" name="image" id="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image') }}" accept="image/*">
                            
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- col form-group end -->
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="favicon" class="mrt-30">Favicon</label>
                                <input type="file" name="favicon" id="favicon" class="form-control{{ $errors->has('favicon') ? ' is-invalid' : '' }}" value="{{ old('favicon') }}" accept="image/*">
                            
                                @if ($errors->has('favicon'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('favicon') }}</strong>
                                </span>
                                @endif
                          </div>
                        </div>
                        <!-- col form-group end -->
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="invoice" class="mrt-30">Invoice</label>
                                <input type="file" name="invoice" id="invoice" class="form-control{{ $errors->has('invoice') ? ' is-invalid' : '' }}" value="{{ old('invoice') }}" accept="image/*">
                            
                                @if ($errors->has('invoice'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('invoice') }}</strong>
                                </span>
                                @endif
                          </div>
                        </div>
                        <!-- col form-group end -->
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="status">Status</label>

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
                </div>
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