@extends('backEnd.layouts.master')
@section('title','Stock')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Stock Reports</h3>
            </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
              <table id="example" class="table  table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Basic Info</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  @php
                    $total = 0;
                  @endphp
                	@foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{substr($value->proName,0,50)}}</td>
                  <td><strong>Category =</strong> {{$value->name}}
                  </td>
                  <td>{{$value->proNewprice}}</td>
                  <td> {{$value->proQuantity}}</td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>
                 
                  @php
                    $total +=$value->proQuantity;
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
                    <td><strong>{{$total}} Pcs</strong></td>
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