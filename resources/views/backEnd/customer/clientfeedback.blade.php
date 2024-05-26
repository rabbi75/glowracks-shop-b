@extends('backEnd.layouts.master')
@section('title','Customer Feedback')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Customer Feedback</h3>
            <div class="short_button">
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="example" class="table table-bordered table-striped table-responsive-sm">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Ratting</th>
                  <th>Image</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->category}}</td>
                  <td>{{$value->ratting}}</td>
                  <td><img src="{{asset($value->image)}}" width="60" alt=""> </td>
                  <td>{!!$value->description!!}</td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>
                  <td>
                  	<ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li>
                            @if($value->status==0)
                            <form action="{{url('editor/clientfeedback/active')}}" method="POST">
                              @csrf
                              <input type="hidden" name="hidden_id" value="{{$value->id}}">
                              <button type="submit" class="thumbs_up" title="active"><i class="fa fa-thumbs-up"></i> Active</button> 
                            </form>
                            @else
                              <form action="{{url('editor/clientfeedback/inactive')}}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{$value->id}}">
                                <button type="submit" class="thumbs_down" title="inactive"><i class="fa fa-thumbs-down"></i> Inactive</button>
                              </form>
                         @endif
                        </ul>
                    </ul>
                  </td>
                </tr>
                @endforeach
                </tbody>
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