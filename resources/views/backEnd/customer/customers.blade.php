@extends('backEnd.layouts.master')
@section('title','Customer')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Customer</h3>
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
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->fullName}}</td>
                  <td>{{$value->phoneNumber}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->address}}</td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>
                  <td>
                  	<ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li>
                            @if($value->status==0)
                            <form action="{{url('editor/customer/active')}}" method="POST">
                              @csrf
                              <input type="hidden" name="hidden_id" value="{{$value->id}}">
                              <button type="submit" class="thumbs_up" title="active"><i class="fa fa-thumbs-up"></i> Active</button> 
                            </form>
                            @else
                              <form action="{{url('editor/customer/inactive')}}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{$value->id}}">
                                <button type="submit" class="thumbs_down" title="inactive"><i class="fa fa-thumbs-down"></i> Inactive</button>
                              </form>
                           @endif
                         </li>
                          <li><a href="{{url('editor/customer/profile/'.$value->id)}}" class="edit_icon"><i class="fa fa-eye"></i> View</a></li>
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