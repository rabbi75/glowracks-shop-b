@extends('backEnd.layouts.master')
@section('title','Comment answer')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Comment answer</h3>
          <div class="short_button">
            <a href="{{url('/editor/comment/unread')}}"><i class="fa fa-cogs"></i>See All</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                  <div class="custom-bg">
                    <form action="{{url('/editor/answer/comment')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <input type="hidden" value="{{$acomments->id}}" name="hidden_id">
                        <input type="hidden" value="{{Auth::user()->id}}" name="admin_id">
                        <div class="col-sm-12">
                            <div class="form-group custom-textarea">
                                <label for="image">Message</label>
                                 <textarea name="answer" class="textarea form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" value="{{ old('answer') }}" rows="5"></textarea>
                            
                                @if ($errors->has('answer'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('answer') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- col form-group end -->
                      <div class="col-sm-6">
                          <div class="form-group mrt-30">
                              <button type="submit" class="btn submit-button">submit</button>
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