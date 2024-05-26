@extends('backEnd.layouts.master')
@section('title','Deliveryman Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage Deliveryman information</h3>
      			<div class="short_button">
              <a href="{{url('superadmin/deliveryman/add')}}"><i class="fa fa-plus"></i>Add</a>
      			</div>
          </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Commission</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->phonenumber}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->commission}}</td>
                  <td><img src="{{asset($value->image)}}" class="backend_image " alt=""></td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>
                  superadmin/deliveryman
                  <td>
                    <ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li>
                              @if($value->status==1)
                              <form action="{{url('superadmin/deliveryman/inactive')}}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{$value->id}}">
                                <button type="submit" class="thumbs_up" title="unpublished"><i class="fa fa-thumbs-up"></i> Active</button> 
                              </form>
                              @else
                                <form action="{{url('superadmin/deliveryman/active')}}" method="POST">
                                  @csrf
                                  <input type="hidden" name="hidden_id" value="{{$value->id}}">
                                  <button type="submit" class="thumbs_down" title="published"><i class="fa fa-thumbs-down"></i> Inactive</button>
                                </form>
                              @endif
                             </li>
                            <li>
                          <li>
                        <a class="edit_icon" href="{{url('superadmin/deliveryman/edit/'.$value->id)}}" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                      </li>
                      <li><a href="{{url('superadmin/deliveryman/profile/'.$value->id)}}" class="edit_icon"><i class="fa fa-eye"></i> View</a>
                      </li>
                      <li>
                        <form action="{{url('superadmin/deliveryman/delete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$value->id}}">
                            <button class="trash_icon"  id="delete" title="delete"><i class="fa fa-trash"></i> Delete</button>
                          </form>
                        </li>
                        </ul>
                    </ul>
                  </td>
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