@extends('backEnd.layouts.master')
@section('title','Category Short')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Category Short information</h3>
          <div class="short_button">
            <a href="{{url('/editor/category/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                  <div class="custom-bg">
                    <form action="{{url('/editor/category/menu-sort-update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                      @csrf
                      <div class="row">
                        <input type="hidden" value="{{$change_level->id}}" name="hidden_id">
                        
                        <input type="hidden" value="{{$change_level->image}}" name="image">
                        <input type="hidden" value="{{$change_level->icon}}" name="icon">
                        <input type="hidden" value="{{$change_level->frontProduct}}" name="frontProduct">
                        <input type="hidden" value="{{$change_level->specialCat}}" name="specialCat">
                        <input type="hidden" value="{{$change_level->status}}" name="status">
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label>Name</label>
                              <input type="text" name="name" class="disabled form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$change_level->name}}">

                              @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                              <label>Level</label>
                              <input type="text" name="level" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" value="{{$change_level->level}}">

                              @if ($errors->has('level'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('level') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <div class="col-sm-12 mrt-15">
                          <div class="form-group">
                              <button type="submit" class="btn submit-button">Update</button>
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
        document.forms['editForm'].elements['status'].value="{{$change_level->status}}"
    </script>
  </section>
  <!-- /.content -->
@endsection