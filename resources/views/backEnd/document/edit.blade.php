@extends('backEnd.layouts.master') 
@section('title','Document Edit') 
@section('main_content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Edit Document Information</h3>
                <div class="short_button">
                    <a href="{{url('/editor/document/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
                </div>
            </div>
            <!--card-header -->
            <div id="form_body" class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="custom-bg">
                            <form action="{{url('/editor/document/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" value="{{$edit_data->id}}" name="hidden_id" />
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea name="content" class="summernote form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ $edit_data->content }}</textarea>
                                            @if ($errors->has('content'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- form-group end -->
                                    <div class="col-sm-12">
                                        <!-- image note -->
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <input type="file" name="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" value="{{ old('file') }}" accept="pdf/*" />
                                            <a href="{{ asset($edit_data->file) }}"><i class="fa fa-download"></i> Download</a>
                                            @if ($errors->has('file'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- form-group end -->
                                   
                                    <!-- form-group end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mrt-30">
                                            <button type="submit" class="btn submit-button">submit</button>
                                            <button type="reset" class="btn btn-default">clear</button>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <div class="custom-bg">
                                        <div class="custom-cart-title">
                                            <strong>Publication Status</strong>
                                        </div>

                                        <div class="box-body pub-stat display-inline">
                                            <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" id="active" name="status" value="1" title="published" />
                                            <label for="active">Active</label>
                                            @if ($errors->has('status'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="box-body pub-stat display-inline">
                                            <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" name="status" value="0" id="inactive" title="unpublished" />
                                            <label for="inactive">Inactive</label>
                                            @if ($errors->has('status'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                            @endif
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
                <!-- /.content -->
                <script type="text/javascript">
                    document.forms['editForm'].elements['status'].value={{$edit_data->status}}
                </script>
            </div>
        </div>
    </div>
</section>
@endsection
