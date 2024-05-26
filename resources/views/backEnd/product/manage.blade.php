@extends('backEnd.layouts.master')
@section('title','product Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage product information</h3>
      			<div class="short_button">
              <a href="{{url('editor/product/add')}}"><i class="fa fa-plus"></i>Add</a>
      			</div>
          </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
              <table id="example" class="table table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Basic Info</th>
                  <th>Old Price</th>
                  <th>New Price</th>
                  <th>Image</th>
                  <th>Quantity</th>
                  <th>Flash Deal</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php
                    $totalqty = 0;
                    $totalprice = 0;
                  @endphp
                	@foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{substr($value->proName,0,20)}}</td>
                  <td><strong>Category =</strong> {{$value->name}}
                  </td>
                  <td> {{$value->proOldprice}}</td>
                  <td> {{$value->proNewprice}}</td>

                  <td>
                  @foreach($productimage as $image)
                    @if($value->id==$image->product_id) <img src="{{asset($image->image)}}" alt="" class="small_image">
                    @endif
                  @endforeach
                  </td>
                  <td> {{$value->proQuantity}}</td>
                  <td>@if($value->flashdeal !=null)
                    {{date('F d, Y', strtotime($value->flashdeal))}}
                    @else
                    Not Assigned
                    @endif
                  </td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>
                  <td>
                  	<ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li>
                              @if($value->status==1)
                              <form action="{{url('editor/product/inactive')}}" method="POST">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{$value->id}}">
                                <button type="submit" class="thumbs_up" title="unpublished"><i class="fa fa-thumbs-up"></i> Active</button> 
                              </form>
                              @else
                                <form action="{{url('editor/product/active')}}" method="POST">
                                  @csrf
                                  <input type="hidden" name="hidden_id" value="{{$value->id}}">
                                  <button type="submit" class="thumbs_down" title="published"><i class="fa fa-thumbs-down"></i> Inactive</button>
                                </form>
                              @endif
                             </li>
                            <li>
                          <li>
                        <a class="edit_icon" href="{{url('editor/product/edit/'.$value->id)}}" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                      </li>
                      <li>
                        <form action="{{url('editor/product/delete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$value->id}}">
                            <button class="trash_icon"  id="delete" title="delete"><i class="fa fa-trash"></i> Delete</button>
                          </form></li>
                        </ul>
                    </ul>
                  </td>
                  
                  @php
                    $totalqty += $value->proQuantity;
                    $totalprice += $value->proNewprice*$value->proQuantity;
                  @endphp
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>{{$totalprice}} Tk</strong></td>
                    <td></td>
                    <td><strong>{{$totalqty}} Tk</strong></td>
                    <td></td>
                    <td></td>
                  </tr>
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