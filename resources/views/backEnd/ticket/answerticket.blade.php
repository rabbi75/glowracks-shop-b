@extends('backEnd.layouts.master')
@section('title','Answered Ticket')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Answered Ticket</h3>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="example" class="table table-bordered table-striped table-responsive-sm">
              <thead>
              <tr>
                <th>Sl</th>
                <th>Ticket</th>
                <th>C.Name</th>
                <th>C.Phone</th>
                <th>Start</th>
                <th>Status</th>
                <th>Replay</th>
              </tr>
              </thead>
              <tbody>
              @foreach($show_data as $key=>$value)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$value->subject}}</td>
                <td>{{$value->fullName}}</td>
                <td>{{$value->phoneNumber}}</td>
                <td> {{date('F d', strtotime($value->created_at))}},{{date('h:i:s a', strtotime($value->created_at))}}</td>
                 <td>@if($value->status==1) <span class="bg-dark text-white p-1">Pending</span> @elseif($value->status==0)  <span class="bg-success text-white p-1">Closed</span>  @else  <span class="bg-primary text-white p-1">Ongoing</span>  @endif</td>
                <td>
                  <a class="btn btn-primary" href="{{url('editor/ticket/view/'.$value->id)}}"><i class="fa fa-desktop"></i></a>
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