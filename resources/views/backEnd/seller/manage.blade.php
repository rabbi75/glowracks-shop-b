@extends('backEnd.layouts.master') 
@section('title','Seller Manage') 
@section('main_content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Seller Information</h3>
          <div class="short_button">
            <a href="{{url('superadmin/seller/add')}}"><i class="fa fa-plus"></i>Add</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body user-border">
          <table id="example" class="table table-responsive-sm table-bordered table-striped">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Seller Name</th>
                <th>Owner Name</th>
                <th>Image</th>
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
                <td>{{$value->sellerName}}</td>
                <td>{{$value->ownerName}}</td>
                <td><img src="{{asset($value->image)}}" class="backend_image" /></td>
                <td>{{$value->phone}}</td>
                <td>{{$value->email}}</td>
                <td>{!! $value->address !!}</td>
                <td>{{$value->status==1?'Active':'Inactive'}}</td>
                <td>
                  <ul class="action_buttons dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li>
                        @if($value->status==1)
                        <form action="{{url('superadmin/seller/inactive')}}" method="POST">
                          @csrf
                          <input type="hidden" name="hidden_id" value="{{$value->id}}" />
                          <button type="submit" class="thumbs_up" title="unpublished"><i class="fa fa-thumbs-up"></i> Active</button>
                        </form>
                        @else
                        <form action="{{url('superadmin/seller/active')}}" method="POST">
                          @csrf
                          <input type="hidden" name="hidden_id" value="{{$value->id}}" />
                          <button type="submit" class="thumbs_down" title="published"><i class="fa fa-thumbs-down"></i> Inactive</button>
                        </form>
                        @endif
                      </li>
                      <li>
                        <a class="edit_icon" href="{{url('superadmin/seller/edit/'.$value->id)}}" title="Edit"> <i class="fa fa-edit"></i> Edit </a>
                      </li>
                      <li>
                        <form action="{{url('superadmin/seller/delete')}}" method="POST">
                          @csrf
                          <input type="hidden" name="hidden_id" value="{{$value->id}}" />
                          <button type="submit" class="trash_icon" onclick="return confirm('Are you delete this?')" title="delete"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                      </li>
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
