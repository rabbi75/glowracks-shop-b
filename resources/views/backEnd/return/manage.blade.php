@extends('backEnd.layouts.master')
@section('title','return-policy Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage return-policy information</h3>
      			<div class="short_button">
              <a href="{{url('editor/return-policy/add')}}"><i class="fa fa-plus"></i>Add</a>
      			</div>
          </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
              <table id="example1" class="table table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Text</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($show_datas as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{!! substr($value->text,0,100) !!}</td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>

                  <td>
                    <ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                        <li>
                        @if($value->status==1)
                        <form action="{{url('editor/return-policy/unpublished')}}" method="POST">
                          @csrf
                          <input type="hidden" name="hidden_id" value="{{$value->id}}">
                          <button type="submit" class="thumbs_up"><i class="fa fa-thumbs-up"></i> Active</button>
                        </form>
                        @else
                          <form action="{{url('editor/return-policy/published')}}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$value->id}}">
                            <button type="submit" class="thumbs_down"><i class="fa fa-thumbs-down"></i> Inactive</button>
                          </form>
                        @endif
                      </li>
                      <li>
                        <a class="edit_icon" href="{{url('editor/return-policy/edit/'.$value->id)}}"><i class="fa fa-edit"></i> Edit</a>
                      </li>
                      <li>
                        <form action="{{url('editor/return-policy/delete')}}" method="POST">
                          @csrf
                          <input type="hidden" name="hidden_id" value="{{$value->id}}">
                          <button type="submit" onclick="return confirm('Are you delete this manufacture')" class="trash_icon"><i class="fa fa-trash"></i> Delete</button>
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