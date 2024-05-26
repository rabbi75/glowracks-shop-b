@extends('backEnd.layouts.master')
@section('title','Highlight Edit')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Edit Highlight information</h3>
          <div class="short_button">
            <a href="{{url('/editor/highlight/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="custom-bg">
                    <form action="{{url('/editor/highlight/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                      @csrf
                      <div class="row">
                        <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">

                        <div class="col-sm-12">
                              <!-- image note -->
                            <div class="form-group">
                                <label for="Picture">Image</label>
                                <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image') }}" accept="image/*">
                                <img src="{{asset($edit_data->image)}}" alt="" class="responsive_image">
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
                            <label>Description <span>*</span></label>
                            <input type="text" name="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" value="{{ $edit_data->desc }}">
                            @if ($errors->has('desc'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('desc') }}</strong>
                            </span>
                            @endif
                          </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Serial</label>
                            <input type="text" name="serial" class="form-control{{ $errors->has('serial') ? ' is-invalid' : '' }}" value="{{ $edit_data->serial }}">
                            @if ($errors->has('serial'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('serial') }}</strong>
                            </span>
                            @endif
                          </div>
                        </div>
                        <!-- form-group end -->
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
                <div class="col-md-4">
                      <div class="custom-bg">
                        <div class="custom-cart-title">
                          <strong>Publication Status</strong>
                        </div>

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
  <script type="text/javascript">
      document.forms['editForm'].elements['area'].value={{$edit_data->area}}
      document.forms['editForm'].elements['status'].value={{$edit_data->status}}
    </script>
@endsection