@extends('backEnd.layouts.master')
@section('title','Subscription')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Subscription</h3>
            <div class="short_button">
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="example" class="table table-bordered table-striped table-responsive-sm">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Email</th>
                  <th>Subscription</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{date('F d, Y', strtotime($value->updated_at))}},{{date('h:i:s a', strtotime($value->updated_at))}}
                  </td>
                  <td>
                  	<ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li>
                              <form action="{{url('editor/subscription/delete')}}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{$value->id}}">
                                <button type="submit" class="trash_icon" title="inactive"><i class="fa fa-trash"></i> Delete</button>
                              </form>
                         </li>
                          <li><a href="{{url('editor/subscription/mail/'.$value->id)}}" class="edit_icon"><i class="fa fa-envelope"></i> Mail</a></li>
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