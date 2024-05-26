@extends('backEnd.layouts.master') 
@section('title','Document Add') 
@section('main_content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Add Document information</h3>
                <div class="short_button">
                    <a href="{{url('/editor/document/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
                </div>
            </div>
            <!--card-header -->
            <div id="form_body" class="card-body">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-md-8">
                        <div class="custom-bg">
                            <form action="{{url('/editor/document/save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea name="content" class="summernote form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" value="{{ old('content') }}"></textarea>
            
                                            @if ($errors->has('content'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--col form-group ends-->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="file" class="mrt-30">File</label>
                                            <input type="file" name="file" id="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" value="{{ old('file') }}" accept="pdf/*" />

                                            @if ($errors->has('file'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- col form-group end -->
                                    <!-- col form-group end -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>

                                            <div class="box-body pub-stat display-inline">
                                                <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" id="active" name="status" value="1" />
                                                <label for="active">Active</label>
                                                @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="box-body pub-stat display-inline">
                                                <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" name="status" value="0" id="inactive" />
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
                                <!-- /.col -->
                            </form>
                        </div>
                        <!--card-body-->
                    </div>
                    <!--card-->
                </div>
                <!--container-fluid-->
                <!-- /.content -->
            </div>
        </div>
    </div>
</section>
@endsection
