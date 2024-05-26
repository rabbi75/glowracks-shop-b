@extends('backEnd.layouts.master')
@section('title','Order  Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Order information</h3>
            <div class="short_button">
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <div class="dashboard-filter">
              <form class="form-row">
                    <div class="col-sm-2">
                        <div class="from-group">
                             <label>Status</label>
                              <select name="status" class="form-control">
                                  <option value="">All</option>
                                  @foreach($ordertypes as $orderstatus)
                                  <option value="{{$orderstatus->id}}" {{ $status ==$orderstatus->id  ? 'selected' : '' }} class="form-control">{{$orderstatus->name}}</option>
                                  @endforeach
                             </select>
                         </div>
                     </div>
                    <div class="col-sm-2">
                        <label>Select Filter</label>
                        <select class="form-control" name="filter">
                            <option value="1" {{ $filter== 1 ? 'selected' : '' }}>All</option>
                            <option value="2" {{ $filter == 2 ? 'selected' : '' }}>Today</option>
                            <option value="3" {{ $filter == 3 ? 'selected' : '' }}>Yesterday</option>
                            <option value="4" {{ $filter == 4 ? 'selected' : '' }}>Current Month</option>
                            <option value="5" {{ $filter == 5 ? 'selected' : '' }}>Last Month</option>
                            <option value="6" {{ $filter == 6 ? 'selected' : '' }}>Current Year</option>
                            <option value="7" {{ $filter == 7 ? 'selected' : '' }}>Last Year</option>
                        </select>
                   </div>
                    <div class="col-sm-2">
                        <label>Start (optional)</label>
                        <input class="form-control mydate" name="start" type="date" value="{{old('mydate')}}">
                   </div>
                    <div class="col-sm-2">
                        <label>End (optional)</label>
                        <input class="form-control mydate"name="end" type="date" value="{{old('end')}}">
                   </div>
                    <div class="col-sm-2">
                        <label></label>
                        <input class="btn btn-success" value="Apply" type="submit">
                   </div>
              </form>
          </div>
          @php
            $total = 0;
          @endphp
              <table id="example" class="table  table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Order Id</th>
                  <th>Customer Name</th>
                  <th>Customer Phone</th>
                  <th>Total Price</th>
                  <th>Order Time</th>
                  <th>Cancel Request</th>
                  <th>Order Status</th>
                  <th>Deliveryman</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->trackingId}}</td>
                  <td>{{$value->fullName}}</td>
                  <td>{{$value->phoneNumber}}</td>
                  <td>BTD {{$value->orderTotal}}</td>
                  <td><p><strong>Date: </strong> {{date('F d, Y', strtotime($value->updated_at))}}</p>
                    <p><strong>Time: </strong> {{date('h:i:s a', strtotime($value->updated_at))}}</p></td>
                     <td>{{$value->cancelRequest==1?'Yes':'No'}}</td>
                  <td>
                    @foreach($ordertypes as $orderstatus)
                        @if($orderstatus->id == $value->orderStatus) {{$orderstatus->name}} @endif
                    @endforeach
                  </td>
                  <td>
                       
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default{{$key+1}}"> Deliveryman </button>
                    <div class="modal fade" id="modal-default{{$key+1}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Assign Deliveryman</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="{{url('/editor/order/delassign')}}" method="POST">
                            <div class="modal-body">
                              @csrf
                              <input type="hidden" value="{{$value->orderIdPrimary}}" name="hidden_id">
                              <div class="row">
                                <div class="col-12">
                                  <select name="deliveryman_id" id="deliveryman_id" class="form-control select2 {{ $errors->has('deliveryman_id') ? ' is-invalid' : '' }}" value="{{ old('deliveryman_id') }}">
                                    <option value="">=== Select Deliveryman ===</option>
                                    @foreach($deliveryman as $rider)
                                    <option value="{{$rider->id}}">{{$rider->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="col-12 my-2">
                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    </td>

                  <td>
                    <ul class="action_buttons dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a class="edit_icon" href="{{url('editor/order/details/'.$value->shippingId.'/'.$value->customerId.'/'.$value->orderIdPrimary)}}"><i class="fa fa-eye"></i> Details View </a></li>
                        @foreach($ordertypes as $orderstatus)
                          <li>
                              <a href="{{url('editor/order/status/'.$value->orderIdPrimary.'/'.$orderstatus->id)}}" class="rbox-{{$orderstatus->id}}"  onclick="return confirm('are you want change status?')"> @if($orderstatus->id == $value->orderStatus)<i class="fa fa-check"></i> @endif {{$orderstatus->name}}</a>
                          </li>
                          @endforeach
                        </ul>
                    </ul>
                    </ul>
                  </td>
                  @php
                   $total +=$value->orderTotal; 
                  @endphp
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total</strong></td>
                    <td><strong>{{$total}} BDT</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
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