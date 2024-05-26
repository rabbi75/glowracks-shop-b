@extends('backEnd.layouts.master') 
@section('title','Slider Manage') 
@section('main_content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manage Slider information</h3>
                    <div class="short_button">
                        <a href="{{url('editor/slider/add')}}"><i class="fa fa-plus"></i>Add</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body user-border">
                    <table id="example" class="table table-responsive-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Link</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($show_data as $key=>$value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><img src="{{asset($value->image)}}" style=" height: 75px; width: auto; display: block; margin: 0 auto; " alt="" /></td>
                                <td><a href="{{$value->burl}}" target="_blank">{{$value->burl}}</a></td>
                                <td>
                                    @if($value->type == 1)
                                    <button class="btn btn-primary">Desktop Slider</button>
                                    @else 
                                    <button class="btn btn-secondary">Mobile Slider</button>
                                    @endif
                                </td>
                                <td>{{$value->status==1?'Active':'Inactive'}}</td>
                                <td>
                                    <ul class="action_buttons dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                @if($value->status==1)
                                                <form action="{{url('editor/slider/inactive')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="hidden_id" value="{{$value->id}}" />
                                                    <button type="submit" class="thumbs_up" title="unpublished"><i class="fa fa-thumbs-up"></i> Active</button>
                                                </form>
                                                @else
                                                <form action="{{url('editor/slider/active')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="hidden_id" value="{{$value->id}}" />
                                                    <button type="submit" class="thumbs_down" title="published"><i class="fa fa-thumbs-down"></i> Inactive</button>
                                                </form>
                                                @endif
                                            </li>
                                            <li>
                                                <a class="edit_icon" href="{{url('editor/slider/edit/'.$value->id)}}" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                            </li>
                                            <li>
                                                <form action="{{url('editor/slider/delete')}}" method="POST">
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
