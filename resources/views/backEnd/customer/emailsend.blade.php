@extends('backEnd.layouts.master')
@section('title','Email Send')
@section('main_content')
 <!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{url('editor/customer/email/post')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <input class="form-control" name="subject" required="" placeholder="Subject:">
                  </div>
                  <div class="form-group">
                    <textarea name="text" id="" class="summernote form-control" required=""></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Send</button>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection