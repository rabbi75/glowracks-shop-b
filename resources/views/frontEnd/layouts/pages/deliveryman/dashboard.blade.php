@extends('frontEnd.layouts.pages.deliveryman.master')
@section('title','Dashboard')
@section('content')
<section class="breadcrumb-section">
    <div class="col-sm-12">
      <div class="bread_inner">
        <div class="row">
          <div class="col-sm-6 col-6">
            <div class="admin-dashboard">
             <h5>{{Auth::guard('deliveryman')->user()->name}} !! Dashboard</h5>
            </div>
          </div>
        <div class="col-sm-6 col-6">
          <div class="cust-breadcrumb">
          <ul>
              <li><a href="{{asset('/deliveryman/account')}}">Home</a></li>
              <li>
                  <i class="fa fa-angle-double-right" aria-hidden="true"></i>
              </li>
              <li>
                  <a href="{{asset('/deliveryman/account')}}" class="bread_last"> Dashboard</a>
              </li>
          </ul>
         </div>
        </div>
        </div>
      </div>
    </div>
</section>
  <section>
     <div class="row">
      <div class="col-sm-12">
        <div class="content-deshboard">
        <div class="row">
        <div class="col-sm-3 col-6">
          <div class="counter-item bg-1">
            <div class="counter-item-left">
              <p><i class="fa fa-check-square"></i></p>
            </div>
            <div class="counter-item-right">
              <p>Order Accepted</p>
              <h5>{{$order_accepted}}</h5>
            </div>
          </div>
        </div>
        <!-- counter end -->
        <div class="col-sm-3 col-6">
          <div class="counter-item bg-2">
            <div class="counter-item-left">
              <p><i class="fa fa-thumbs-down"></i></p>
            </div>
            <div class="counter-item-right">
              <p>Order Picked</p>
              <h5>{{ $order_picked }}</h5>
            </div>
          </div>
        </div>
        <!-- counter end -->
        <div class="col-sm-3 col-6">
          <div class="counter-item bg-3">
            <div class="counter-item-left">
              <p><i class="fa fa-edit"></i></p>
            </div>
            <div class="counter-item-right">
              <p>Order Delivered</p>
              <h5>{{ $order_delivered }}</h5>
            </div>
          </div>
        </div>
        <!-- counter end -->
        <div class="col-sm-3 col-6">
          <div class="counter-item bg-4">
            <div class="counter-item-left">
              <p><i class="fa fa-bell-o"></i></p>
            </div>
            <div class="counter-item-right">
              <p>Order Returned</p>
              <h5>{{ $order_returned }}</h5>
            </div>
          </div>
        </div>
        <!-- counter end -->
        </div>
      </div>
      </div>
      </div>
  </section>
  <section class="result_list_area">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="result_list table-responsive">
            <h3>Last 7 Order</h3>
            <table class="table table-bordered table-striped">
              <thead class="bg-success">
                <th>SL.</th>
                <th>Track ID</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Status</th>
                <th>Action Button</th>
              </thead>
              <tbody>
                @foreach($order_list as $key=>$value)
                <tr>
                  <td>{{ $loop->iteration}}</td>
                  <td>{{ $value->trackingId }}</td>
                  <td>{{date('F d, Y', strtotime($value->created_at))}}</td>
                  <td>{{ $value->customer->fullName }}</td>
                  <td>{{ $value->customer->phoneNumber }}</td>
                  <td>
                    @foreach($ordertypes as $orderstatus)
                        @if($orderstatus->id == $value->orderStatus)
                          {{$orderstatus->name}} 
                        @endif 
                      @endforeach
                  </td>
                  <td>
                    <div class="dropdown show">
                      <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action Button
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @foreach($ordertypes as $orderstatus)
                        <a class="dropdown-item rbox-{{$orderstatus->id}}" href="{{url('editor/order/status/'.$value->orderIdPrimary.'/'.$orderstatus->id)}}">
                          @if($orderstatus->id == $value->orderStatus)
                          <i class="fa fa-check"></i> 
                          @endif {{$orderstatus->name}}
                        </a>
                        @endforeach
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>
      
@endsection