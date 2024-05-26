@extends('backEnd.layouts.master')
@section('title','New Comments')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage New comments</h3>
          </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Customer</th>
                  <th>Message</th>
                  <th>Product</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($comments as $key=>$value)
                <tr class="{{$value->answer==1?'unseen':'seen'}}">
                  <td>{{$loop->iteration}}</td>
                  <td> {{$value->fullName}}</td>
                  <td> {{$value->comment}}</td>
                  <td><a href="{{url('product-details/'.$value->product_id.'/'.$value->slug)}}" target="_blank">see product</a></td>
                  <td>  {{date('H:i:s a', strtotime($value->updated_at))}}<br>{{date('F d, Y', strtotime($value->updated_at))}}</td>
                  <td><a href="{{url('editor/comment/answer/'.$value->id)}}" class="send-message">send message</a></td>
                </tr>
                @endforeach
                </tfoot>
              </table>
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