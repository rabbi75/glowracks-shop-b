@extends('backEnd.layouts.master')
@section('title','General Setting')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">General Setting </h3>
          
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="custom-bg">
                    <form action="{{url('/editor/general/setting/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                      @csrf
                      <div class="row">
                        <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label for="sitename">Site Name<span>*</span></label>
                              <input type="text" name="sitename" class="form-control{{ $errors->has('sitename') ? ' is-invalid' : '' }}" value="{{ old('sitename') }}{{$edit_data->sitename}}">

                              @if ($errors->has('sitename'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sitename') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-12">
                          <div class="form-group">
                              <label for="text">Meta Description</label>
                                <textarea name="metadescrp" class=" form-control{{ $errors->has('metadescrp') ? ' is-invalid' : '' }}" value="" placeholder="Any kind of Description you had in mind">{{ old('metadescrp') }}{{$edit_data->metadescrp}}</textarea>

                                @if ($errors->has('metadescrp'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('metadescrp') }}</strong>
                               </span>
                               @endif
                            </div>
                      </div>
                      <!-- /.form-group -->
                     <div class="col-sm-12">
                          <div class="form-group">
                              <label for="text">Meta Tag</label>
                                <textarea name="metatag" class=" form-control{{ $errors->has('metatag') ? ' is-invalid' : '' }}" value="" placeholder="Apple, Mango, Orange">{{ old('metatag') }}{{$edit_data->metatag}}</textarea>

                                @if ($errors->has('metatag'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('metatag') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Google Analytics (Head)</label>
                                <textarea name="googleanyh" class=" form-control{{ $errors->has('googleanyh') ? ' is-invalid' : '' }}" value="" placeholder="please avoid the <script> tag">{{ old('googleanyh') }}{{$edit_data->googleanyh}}</textarea>

                                @if ($errors->has('googleanyh'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('googleanyh') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                      <!-- /.form-group --> 
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Google Analytics (Body)</label>
                                <textarea name="googleanybo" class=" form-control{{ $errors->has('googleanybo') ? ' is-invalid' : '' }}" value="" placeholder="please avoid the <script> tag">{{ old('googleanybo') }}{{$edit_data->googleanybo}}</textarea>

                                @if ($errors->has('googleanybo'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('googleanybo') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Google Console (Head)</label>
                                <textarea name="googleconh" class=" form-control{{ $errors->has('googleconh') ? ' is-invalid' : '' }}" value="">{{ old('googleconh') }}{{$edit_data->googleconh}}</textarea>

                                @if ($errors->has('googleconh'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('googleconh') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Google Console (Body)</label>
                                <textarea name="googleconbo" class=" form-control{{ $errors->has('googleconbo') ? ' is-invalid' : '' }}" value="">{{ old('googleconbo') }}{{$edit_data->googleconbo}}</textarea>

                                @if ($errors->has('googleconbo'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('googleconbo') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Facebook Pixel (Head)</label>
                                <textarea name="facebookpixh" class=" form-control{{ $errors->has('facebookpixh') ? ' is-invalid' : '' }}" value="">{{ old('facebookpixh') }}{{$edit_data->facebookpixh}}</textarea>

                                @if ($errors->has('facebookpixh'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('facebookpixh') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Facebook Pixel (Body)</label>
                                <textarea name="facebookpixbo" class=" form-control{{ $errors->has('facebookpixbo') ? ' is-invalid' : '' }}" value="">{{ old('facebookpixbo')}}{{$edit_data->facebookpixbo}}</textarea>

                                @if ($errors->has('facebookpixbo'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('facebookpixbo') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Facebook Messneger (Head)</label>
                                <textarea name="facebookmessh" class=" form-control{{ $errors->has('facebookmessh') ? ' is-invalid' : '' }}" value="">{{ old('facebookmessh')}}{{$edit_data->facebookmessh}}</textarea>

                                @if ($errors->has('facebookmessh'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('facebookmessh') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                       <div class="col-sm-6">
                          <div class="form-group">
                              <label for="text">Facebook Messneger (Body)</label>
                                <textarea name="facebookmessbo" class=" form-control{{ $errors->has('facebookmessbo') ? ' is-invalid' : '' }}" value="">{{ old('facebookmessbo') }}{{$edit_data->facebookmessbo}}</textarea>

                                @if ($errors->has('facebookmessbo'))
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('facebookmessbo') }}</strong>
                               </span>
                               @endif
                            </div>
                        </div>
                  <!-- /.form-group -->
                     
                      
                        <div class="col-sm-12">
                          <div class="form-group">
                            <div class="custom-cart-title">
                                <label>Activation Status <span>*</span></label>
                              </div>
                               <ul>
                                  <li><input type="radio" id="active" class="{{ $errors->has('status') ? ' is-invalid' : '' }}" value="1" name="status">
                                    <label for="active">Active</label>
                                  </li>
                  
                                  <li><input type="radio" id="inactive" class="{{ $errors->has('status') ? ' is-invalid' : '' }}" value="2" name="status">
                                    <label for="inactive">Inactive</label>
                                  </li>
                              </ul>
                                @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- form group -->
                        </div>

                            <div class="col-sm-6 mrt-15">
                                <div class="form-group">
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
      <script type="text/javascript">
          document.forms['editForm'].elements['status'].value="{{$edit_data->status}}"
       </script>
  </section>
  <!-- /.content -->
@endsection