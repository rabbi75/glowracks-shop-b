@extends('frontEnd.layouts.pages.deliveryman.master') 
@section('title','My Order') 
@section('content')
<section class="breadcrumb-section">
  <div class="col-sm-12">
    <div class="bread_inner">
      <div class="row">
        <div class="col-sm-6 col-6">
          <div class="admin-dashboard">
            <h5>My Orders</h5>
          </div>
        </div>
        <div class="col-sm-6 col-6">
          <div class="cust-breadcrumb">
            <ul>
              <li><a href="{{asset('/student/account')}}">Home</a></li>
              <li>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
              </li>
              <li>
                <a href="" class="bread_last">My Orders</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="notce_area">
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-12">
        <div class="notice_item">
          <div id="accordion">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="result_list table-responsive">
                    <h3>Last 7 Payment</h3>
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
                                <a class="dropdown-item rbox-{{$orderstatus->id}}" href="{{url('deliveryman/order/status/'.$value->orderIdPrimary.'/'.$orderstatus->id)}}">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
