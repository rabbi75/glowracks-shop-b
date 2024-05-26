@extends('backEnd.layouts.master')
@section('title','Product Edit')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Product Edit</h3>
          <div class="short_button">
            <a href="{{url('/editor/product/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="custom-bg">
                    <form action="{{url('/editor/product/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                      @csrf
                      <div class="row">
                        <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">
                        <div class="col-sm-4">
                               <div class="form-group">
                                <label for="title">Category <span>*</span></label>
                                <select class="form-control select2{{ $errors->has('proCategory') ? ' is-invalid' : '' }}" value="{{ old('proCategory') }}" id="proCategory" name="proCategory">
                                    <option value="">====Select your category====</option>
                                    @foreach($category as $key=>$value) 
                                    <option value="{{$value->id}}" required>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                  @if ($errors->has('proCategory'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('proCategory') }}</strong>
                                  </span>
                                  @endif
                             </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-4">
                           <div class="form-group">
                                <label for="title">Subcategory (Option)</label>
                                <select name="proSubcategory" id="proSubcategory" class="form-control {{ $errors->has('proSubcategory') ? ' is-invalid' : '' }}" value="{{ old('proSubcategory') }}">
                                   @foreach($subcategory as $key=>$value)
                                     <option value="{{$value->id}}">{{$value->subcategoryName}}</option>
                                  @endforeach
                                </select>
                                 @if ($errors->has('proSubcategory'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('proSubcategory') }}</strong>
                                  </span>
                                  @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-4">
                           <div class="form-group">
                            <label for="title">Child Category  (Optional)</label>
                                <select name="proChildcategory" id="proChildcategory" class="form-control{{ $errors->has('proChildcategory') ? ' is-invalid' : '' }}" value="{{ old('proChildcategory') }}">
                                  @foreach($childcategory as $key=>$value)
                                     <option value="{{$value->id}}">{{$value->childcategoryName}}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('proChildcategory'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('proChildcategory') }}</strong>
                                  </span>
                                  @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-8">
                            <div class="form-group">
                              <label>Product Name <span>*</span></label>
                              <input type="text" name="proName" class="form-control{{ $errors->has('proName') ? ' is-invalid' : '' }}" value="{{ $edit_data->proName}}">

                              @if ($errors->has('proName'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proName') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-4">
                            <div class="form-group">
                              <label>Purchase Price <span>*</span></label>
                              <input type="number" name="proPurchaseprice" class="form-control{{ $errors->has('proPurchaseprice') ? ' is-invalid' : '' }}" value="{{$edit_data->proPurchaseprice}}">

                              @if ($errors->has('proPurchaseprice'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proPurchaseprice') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Old Product (Optional)</label>
                              <input type="number" name="proOldprice" class="form-control{{ $errors->has('proOldprice') ? ' is-invalid' : '' }}" value="{{ $edit_data->proOldprice}}">

                              @if ($errors->has('proOldprice'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proOldprice') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>New Price <span>*</span></label>
                          <input type="number" name="proNewprice" class="form-control{{ $errors->has('proNewprice') ? ' is-invalid' : '' }}" value="{{$edit_data->proNewprice}}">

                          @if ($errors->has('proNewprice'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('proNewprice') }}</strong>
                          </span>
                          @endif
                        </div>
                    </div>
                  <!-- /.form-group -->
                   <div class="col-sm-4">
                        <div class="form-group">
                          <label for="image"> Product Image <span>*</span></label>

                            <div class="clone hide" style="display: none;">
                              <div class="control-group input-group" >
                                <input type="file" name="image[]" class="form-control">
                                <div class="input-group-btn"> 
                                  <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                                </div>
                              </div>
                            </div>

                            <div class="input-group control-group increment" >
                              <input type="file" name="image[]" class="form-control">
                              <div class="input-group-btn"> 
                                <button class="btn btn-success" type="button"><i class="fa fa-plus"></i></button>
                              </div>
                            </div>
                            @foreach($productimage as $image)
                               @if($edit_data->id==$image->product_id) 
                                <div class="edit-img">
                                  <input type="hidden" class="form-control" value="{{$image->id}}" name="hidden_img">
                                 <img src="{{asset($image->image)}}" class="editimage" alt="">
                                  <a href="{{url('editor/product/image/delete/'.$image->id)}}" class="btn btn-danger">Delete</a>
                                </div>
                               @endif
                            @endforeach
                          @if ($errors->has('image'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <!-- col end -->

                      <div class="col-sm-4">
                            <div class="form-group">
                              <label>Product Quantity (Optional)</label>
                              <input type="number" name="proQuantity" class="form-control{{ $errors->has('proQuantity') ? ' is-invalid' : '' }}" value="{{$edit_data->proQuantity}}">

                              @if ($errors->has('proQuantity'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proQuantity') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-4">
                            <div class="form-group">
                              <label>Product Max Quantity (Optional)</label>
                              <input type="number" name="maxqty" class="form-control{{ $errors->has('maxqty') ? ' is-invalid' : '' }}" value="{{$edit_data->maxqty}}">

                              @if ($errors->has('maxqty'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('maxqty') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-4">
                            <div class="form-group">
                              <label>Product Unit (Optional)</label>
                              <input type="text" name="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" value="{{$edit_data->unit}}" min="1">

                              @if ($errors->has('unit'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('unit') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-4">
                            <div class="form-group">
                              <label>Flash Deal (Optional)</label>
                              <input type="text" name="flashdeal" class="form-control{{ $errors->has('flashdeal') ? ' is-invalid' : '' }} flash" value="{{$edit_data->flashdeal}}" min="1">
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-4">
                        <div class="form-group">
                        <label for="title">Product size (Optional)</label>
                            <select name="proSize[]" class="form-control select2{{ $errors->has('proSize') ? ' is-invalid' : '' }}"  multiple="multiple">
                              @foreach($totalsizes as $totalsize)
                                  <option value="{{$totalsize->id}}" @foreach($selectsizes as $selectsize) @if($totalsize->id == $selectsize->size_id)selected="selected"@endif @endforeach>{{$totalsize->sizeName}}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('proSize'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proSize') }}</strong>
                              </span>
                              @endif
                        </div>
                      </div>
                        <!-- form group end -->
                      <div class="col-sm-4">
                        <div class="form-group">
                        <label for="title">Product color (Optional)</label>
                            <select name="proColor[]" class="form-control select2{{ $errors->has('proColor') ? ' is-invalid' : '' }}"  multiple="multiple">
                              @foreach($totalcolors as $totalcolor)
                                  <option value="{{$totalcolor->id}}" @foreach($selectcolors as $selectcolor) @if($totalcolor->id == $selectcolor->color_id)selected="selected"@endif @endforeach>{{$totalcolor->colorName}}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('proColor'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proColor') }}</strong>
                              </span>
                              @endif
                        </div>
                      </div>
                        <!-- form group end -->
                      <div class="col-sm-4">
                        <div class="form-group">
                        <label for="title">Product Brand (Optional)</label>
                            <select name="proBrand" class="form-control select2{{ $errors->has('proBrand') ? ' is-invalid' : '' }}" >
                              @foreach($probrand as $key=>$value)
                              <option value="{{$value->id}}">{{$value->brandName}}</option>
                              @endforeach
                          </select>
                            @if ($errors->has('proBrand'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proBrand') }}</strong>
                              </span>
                              @endif
                        </div>
                      </div>
                        <!-- form group end -->
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label for="deliveryarea">Delivery Address <span>*</span></label>
                              <input type="text" name="deliveryarea" class="form-control{{ $errors->has('deliveryarea') ? ' is-invalid' : '' }}" value="{{ $edit_data->deliveryarea}}">

                              @if ($errors->has('deliveryarea'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deliveryarea') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-4">
                            <div class="form-group">
                              <label for="pdate">Return Date <span>*</span></label>
                              <input type="text" name="pdate" class="form-control{{ $errors->has('pdate') ? ' is-invalid' : '' }}" value="{{ $edit_data->pdate}}">

                              @if ($errors->has('pdate'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pdate') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-12">
                        <div class="form-group ">
                                <label for="shortDescription">Short Description</label>
                                    <textarea name="shortDescription" class="summernote form-control{{ $errors->has('shortDescription') ? ' is-invalid' : '' }}" value="{{ old('shortDescription') }}" rows="10">{{$edit_data->shortDescription}}</textarea>
                                @if ($errors->has('shortDescription'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('shortDescription') }}</strong>
                                   </span>
                                   @endif
                              </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="col-sm-12">
                        <div class="form-group ">
                                <label for="Picture">Description <span>*</span></label>
                                    <textarea name="proDescription" class="summernote form-control{{ $errors->has('proDescription') ? ' is-invalid' : '' }}" value="{{ old('proDescription') }}" rows="10">{{$edit_data->proDescription}}</textarea>
                                @if ($errors->has('proDescription'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('proDescription') }}</strong>
                                   </span>
                                   @endif
                              </div>
                            <!-- form-group end -->
                      </div>
                       <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="topSell">Top Sale Product (Optional)</label>
                             <input type="checkbox" class="{{ $errors->has('topSell') ? ' is-invalid' : '' }}" value="1"  name="topSell" id="topSell" @if($edit_data->topSell) checked @endif>
                             @if ($errors->has('topSell'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('topSell') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>
                       <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="warranty">Warranty (Optional) </label>
                             <input type="checkbox" class="{{ $errors->has('warranty') ? ' is-invalid' : '' }}" value="1"  name="warranty" id="warranty" @if($edit_data->warranty) checked @endif>
                             @if ($errors->has('warranty'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('warranty') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>
                       <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="homedelivery"> Delivery System (Optional) </label>
                             <input type="checkbox" class="{{ $errors->has('homedelivery') ? ' is-invalid' : '' }}" value="1"  name="homedelivery" id="homedelivery" @if($edit_data->homedelivery) checked @endif>
                             @if ($errors->has('homedelivery'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('homedelivery') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>

                       <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="returnwarranty"> Return (Optional) </label>
                             <input type="checkbox" class="{{ $errors->has('returnwarranty') ? ' is-invalid' : '' }}" value="1"  name="returnwarranty" id="returnwarranty" @if($edit_data->returnwarranty) checked @endif>
                             @if ($errors->has('returnwarranty'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('returnwarranty') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>

                      <!--<div class="col-sm-3">-->
                      <!--    <div class="form-group">-->
                      <!--      <label class="custom-label" for="featured">Featured (Optional)</label>-->
                      <!--       <input type="checkbox" class="{{ $errors->has('featured') ? ' is-invalid' : '' }}" value="1"  name="featured" id="featured" @if($edit_data->featured) checked @endif>-->
                      <!--       @if ($errors->has('featured'))-->
                      <!--          <span class="invalid-feedback">-->
                      <!--            <strong>{{ $errors->first('featured') }}</strong>-->
                      <!--          </span>-->
                      <!--        @endif-->
                      <!--    </div>-->
                      <!--  </div>-->

                     
                        <div class="col-sm-12">
                          <div class="form-group">
                            <div class="custom-cart-title">
                                <label>Product Status <span>*</span></label>
                              </div>
                               <ul>
                                  <li><input type="radio" id="active" class="{{ $errors->has('status') ? ' is-invalid' : '' }}" value="1" name="status">
                                    <label for="active">Active</label>
                                  </li>
                  
                                  <li><input type="radio" id="inactive" class="{{ $errors->has('status') ? ' is-invalid' : '' }}" value="2" name="status">
                                    <label for="inactive">Inactive</label>
                                  </li>
                              </ul>
                                @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- form group -->
                        </div>

                            <div class="col-sm-6 mrt-15">
                                <div class="form-group">
                                    <button type="submit" class="btn submit-button">submit</button>
                                    <button type="reset" class="btn btn-default">clear</button>
                                </div>
                            </div>
                            <!-- /.form-group -->
                    </div>
                </div>
              </div>
            <!-- /.col -->
              </form>
          </div>
        <!--card-body-->
      </div>
      <!--card-->
    </div>
  <!--container-fluid-->
      <script type="text/javascript">
          document.forms['editForm'].elements['proSubcategory'].value="{{$edit_data->proSubcategory}}"
          document.forms['editForm'].elements['proCategory'].value="{{$edit_data->proCategory}}"
          document.forms['editForm'].elements['proBrand'].value="{{$edit_data->proBrand}}"
          document.forms['editForm'].elements['status'].value="{{$edit_data->status}}"
       </script>
  </section>
  <!-- /.content -->
@endsection