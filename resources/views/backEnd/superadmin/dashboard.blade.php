@extends('backEnd.layouts.master')
@section('title','Dashboard')
@section('main_content')
<section class="content">
  <div class="container-fluid">
         <div class="row">
           <div class="col-sm-12">
              <div class="dashboard-filter">
              <form class="form-row">
                    <div class="col-sm-2">
                        <select class="form-control" name="filter">
                            <option value="1" {{ $query== 1 ? 'selected' : '' }}>All</option>
                            <option value="2" {{ $query == 2 ? 'selected' : '' }}>Today</option>
                            <option value="3" {{ $query == 3 ? 'selected' : '' }}>Yesterday</option>
                            <option value="4" {{ $query == 4 ? 'selected' : '' }}>Current Month</option>
                            <option value="5" {{ $query == 5 ? 'selected' : '' }}>Last Month</option>
                            <option value="6" {{ $query == 6 ? 'selected' : '' }}>Current Year</option>
                            <option value="7" {{ $query == 7 ? 'selected' : '' }}>Last Year</option>
                        </select>
                   </div>
                    <div class="col-sm-2">
                        <input value="{{$start}}" class="form-control mydate" name="start" placeholder="From" type="date">
                   </div>
                    <div class="col-sm-2">
                        <input value="{{$end}}" class="form-control mydate"name="end" placeholder="To" type="date">
                   </div>
                    <div class="col-sm-2">
                        <input class="btn btn-success" value="Apply" type="submit">
                   </div>
              </form>
          </div>
          <div class="row">
              @foreach($ordertypes as $key=>$value)
                @if($start==NULL)
                <div class="col-md-3 ">
                    <div class="card m-b-30 shadow-sm">
                      @if($query==1)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                              
                          </div>
                        </div>
                       @elseif($query==2)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::today())->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                              
                          </div>
                        </div>
                       @elseif($query==3)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::yesterday())->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                             <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                       @elseif($query==4)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @elseif($query==5)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereDate('created_at',Carbon\Carbon::now()->subMonth())->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @elseif($query==6)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->year)->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @else
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->subYear())->whereBetween('created_at', [$start, $end])->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @endif
                    </div>
                </div>
              @else
              <div class="col-md-3 ">
                    <div class="card m-b-30 shadow-sm">
                      @if($query==1)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                              
                          </div>
                        </div>
                       @elseif($query==2)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::today())->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                              
                          </div>
                        </div>
                       @elseif($query==3)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::yesterday())->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                             <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                       @elseif($query==4)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @elseif($query==5)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereDate('created_at',Carbon\Carbon::now()->subMonth())->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @elseif($query==6)
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->year)->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @else
                        <div class="card-body">
                          <div class="row">
                            <div class="col-8">
                              <h4>{{App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->subYear())->whereBetween('created_at', [$start, $end])->count()}}</h4>
                              <p class="font-12 mb-0 ">{{$value->name}}</p>
                            </div>
                            <div class="col-4">
                              <a href="{{url('editor/order/manage/'.$value->slug)}}"> <i data-feather="{{$value->icon}}" class="{{$value->color}} iconsize"></i>
                              </a>
                              </div>
                          </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
              @endforeach
          </div>
          <!--row end-->
          <div class="row mrt-30">
            <div class="col-sm-8">
               <div class="card">
                 <div class="card-header">
                   <h3>Order Statistics</h3>
                 </div>
                 <div class="card-body">
                   <canvas id="myChart"></canvas>
                 </div>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="card">
                 <div class="card-header">
                   <h3>Today Reports</h3>
                 </div>
                 <div class="card-body dashboard-today-reports">
                   <div class="info-box">
                      <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-bag"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Today Sell</span>
                        <span class="info-box-number">
                          {{$todaysalesamount}}
                          <small>Tk</small>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- info box end -->
                   <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-cart-plus"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Stock</span>
                        <span class="info-box-number">
                          {{$totalstock}}
                          <small>Pcs</small>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- info box end -->
                   <div class="info-box">
                      <span class="info-box-icon bg-dark elevation-1"><i class="fa fa-list"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Today Expence</span>
                        <span class="info-box-number">
                          {{$todayexpence}}
                          <small>Tk</small>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- info box end -->
                 </div>
               </div>
            </div>
            </div>
           </div>
         </div>
         <div class="row">
          <div class="col-md-12">
            <div class="shadow-sm h-100 card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">
                                Latest Orders
                            </h5>
                        </div>
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="btn btn-link p-0 font-18 float-right" type="button" id="upcomingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="upcomingTask">
                                    <a class="dropdown-item font-13" href="{{url('/editor/order/manage/pending')}}">
                                        View All Orders
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-borderd">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
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
                                    <td>{{date('d-Y-m', strtotime($value->updated_at))}} </td>
                                </tr>
                              @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
          <div class="card-body dailysale">
             <div id="dailysale"></div>
          </div>
        </div>
        @foreach($monthlysale as $sale) <p> {{$sale->date}}</p> @endforeach
      </div>
  </div>
 </section>
 <script>
   var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: [@foreach($ordertypes as $ordertype)'{{$ordertype->name}}',@endforeach],
        datasets: [{
            label: 'Order Statistics',
            backgroundColor:['#1D2941','#55A25A','#431753','#8E2FC4','#345491','#488E74','#2094A0','#BB2757','#663E3E'],
            borderColor:['#1D2941','#55A25A','#431753','#8E2FC4','#345491','#488E74','#2094A0','#BB2757','#663E3E'],
             data: [@foreach($ordertypes as $ordertype)
             @php
             $parcelcount = App\Order::where('orderStatus',$ordertype->id)->count();
             @endphp {{$parcelcount}}, @endforeach]
        }]
    },

    // Configuration options go here
    options: {}
});
 </script>
 <script>
 var options = {
          series: [{
          name: 'Mothly Sale',
          data: [@foreach($monthlysale as $sale) {{$sale->orderTotal}}, @endforeach]
        }],
          annotations: {
          points: [{
            x: 'Bananas',
            seriesIndex: 0,
            label: {
              borderColor: '#775DD0',
              offsetY: 0,
              style: {
                color: '#fff',
                background: '#775DD0',
              },
              text: 'Bananas are good',
            }
          }]
        },
        chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            columnWidth: '50%',
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          categories: [@foreach($monthlysale as $sale) {{date('d', strtotime($sale->date))}}, @endforeach],
        },
        yaxis: {
          title: {
            text: 'Monthly Sale',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#dailysale"), options);
        chart.render();
</script>
@endsection