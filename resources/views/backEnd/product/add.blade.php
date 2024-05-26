@extends('backEnd.layouts.master')
@section('title','Product Add')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Product information</h3>
          <div class="short_button">
            <a href="{{url('/editor/product/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="custom-bg">
                    <form action="{{url('/editor/product/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-sm-4">
                               <div class="form-group">
                                <label for="title">Category <span>*</span></label>
                                <select class="form-control select2{{ $errors->has('proCategory') ? ' is-invalid' : '' }}" value="{{ old('proCategory') }}" id="proCategory" name="proCategory">
                                    <option value="">====Select your category====</option>
                                    @foreach($categories as $key=>$value) 
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
                                <label for="title">Subcategory (Optional)</label>
                                <select name="proSubcategory" id="proSubcategory" class="form-control {{ $errors->has('proSubcategory') ? ' is-invalid' : '' }}" value="{{ old('proSubcategory') }}">
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
                                <select name="proChildcategory" id="proChildcategory" class="form-control{{ $errors->has('proChildcategory') ? ' is-invalid' : '' }}" value="{{ old('proChildcategory') }}" >
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
                              <input type="text" name="proName" class="form-control{{ $errors->has('proName') ? ' is-invalid' : '' }}" value="{{ old('proName') }}">
                              @if ($errors->has('proName'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proName') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                        <!-- form group end -->
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Purchase Price <span>*</span></label>
                              <input type="number" name="proPurchaseprice" class="form-control{{ $errors->has('proPurchaseprice') ? ' is-invalid' : '' }}" value="{{ old('proPurchaseprice') }}">

                              @if ($errors->has('proPurchaseprice'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proPurchaseprice') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Old Price (Optional)</label>
                              <input type="number" name="proOldprice" class="form-control{{ $errors->has('proOldprice') ? ' is-invalid' : '' }}" value="{{ old('proOldprice') }}">

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
                          <label>New Price(Sale) <span>*</span></label>
                          <input type="number" name="proNewprice" class="form-control{{ $errors->has('proNewprice') ? ' is-invalid' : '' }}" value="{{ old('proNewprice') }}">

                          @if ($errors->has('proNewprice'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('proNewprice') }}</strong>
                          </span>
                          @endif
                        </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="col-lg-4">
                    <div class="form-group">
                          <label for="image"> Product Image <span>*</span></label>
                          <input type="file" name="image[]" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image') }}" multiple="multiple">

                          @if ($errors->has('image'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                          </span>
                          @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!--/ .form-group-->
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label>Product Quantity (Optional)</label>
                          <input type="number" name="proQuantity" class="form-control{{ $errors->has('proQuantity') ? ' is-invalid' : '' }}" value="{{ old('proQuantity') }}" min="1">

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
                            <input type="number" name="maxqty" class="form-control{{ $errors->has('maxqty') ? ' is-invalid' : '' }}" value="{{ old('maxqty') }}" min="1">

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
                          <input type="text" name="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" value="{{ old('unit') }}" min="1">

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
                          <input type="date" name="flashdeal" class="form-control{{ $errors->has('flashdeal') ? ' is-invalid' : '' }} flash" value="{{ old('flashdeal') }}">
                        </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="col-sm-4">
                        <div class="form-group">
                        <label for="title">Product size (Optional)</label>
                            <select name="proSize[]" class="form-control select2{{ $errors->has('proSize') ? ' is-invalid' : '' }}" multiple="multiple">
                              @foreach($productSize as $key=>$value)
                              <option value="{{$value->id}}">{{$value->sizeName}}</option>
                              @endforeach
                          </select>
                            @if ($errors->has('proSize'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proSize') }}</strong>
                              </span>
                              @endif
                        </div>
                      </div>
                      <!-- /.form-group -->

                      <div class="col-sm-4">
                        <div class="form-group">
                        <label for="title">Product color (Optional)</label>
                            <select name="proColor[]" class="form-control select2{{ $errors->has('proColor') ? ' is-invalid' : '' }}" multiple="multiple">
                              @foreach($productColors as $key=>$value)
                              <option value="{{$value->id}}">{{$value->colorName}}</option>
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
                              @foreach($productBrand as $key=>$value)
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
                      <!-- /.form-group -->
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label for="deliveryarea">Delivery Address<span>*</span></label>
                              <input type="text" name="deliveryarea" class="form-control{{ $errors->has('deliveryarea') ? ' is-invalid' : '' }}" value="{{ old('deliveryarea') }}">
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
                              <label for="pdate">Return Date<span>*</span></label>
                              <input type="text" name="pdate" class="form-control{{ $errors->has('pdate') ? ' is-invalid' : '' }}" value="{{ old('pdate') }}">
                              @if ($errors->has('pdate'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pdate') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="text">Short Description</label>
                            <textarea name="shortDescription" class="summernote form-control{{ $errors->has('shortDescription') ? ' is-invalid' : '' }}" value="">{{ old('shortDescription') }}</textarea>

                            @if ($errors->has('shortDescription'))
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('shortDescription') }}</strong>
                           </span>
                           @endif
                        </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="text">Description</label>
                            <textarea name="proDescription" class="summernote form-control{{ $errors->has('proDescription') ? ' is-invalid' : '' }}" value="">{{ old('proDescription') }}</textarea>

                            @if ($errors->has('proDescription'))
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('proDescription') }}</strong>
                           </span>
                           @endif
                        </div>
                    </div>
                     <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="topSell"> Top Sale (Optional)</label>
                             <input type="checkbox" class="{{ $errors->has('topSell') ? ' is-invalid' : '' }}" value="1" id="topSell" name="topSell" id="front">
                             @if ($errors->has('topSell'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('topSell') }}</strong>
                                </span>
                              @endif
                          </div>
                      </div>
                     <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="warranty"> Warranty (Optional) </label>
                             <input type="checkbox" class="{{ $errors->has('warranty') ? ' is-invalid' : '' }}" value="1" id="warranty" name="warranty" id="front">
                             @if ($errors->has('warranty'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('warranty') }}</strong>
                                </span>
                              @endif
                          </div>
                      </div>

                     <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="homedelivery">Delivery System (Optional) </label>
                             <input type="checkbox" class="{{ $errors->has('homedelivery') ? ' is-invalid' : '' }}" value="1" id="homedelivery" name="homedelivery" id="front">
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
                             <input type="checkbox" class="{{ $errors->has('returnwarranty') ? ' is-invalid' : '' }}" value="1" id="returnwarranty" name="returnwarranty" id="front">
                             @if ($errors->has('returnwarranty'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('returnwarranty') }}</strong>
                                </span>
                              @endif
                          </div>
                      </div>

                      <!--<div class="col-sm-3">-->
                      <!--    <div class="form-group">-->
                      <!--      <label class="custom-label" for="featured"> Feature (Optional)</label>-->
                      <!--       <input type="checkbox" class="{{ $errors->has('featured') ? ' is-invalid' : '' }}" value="1" id="featured" name="featured" id="front">-->
                      <!--       @if ($errors->has('featured'))-->
                      <!--          <span class="invalid-feedback">-->
                      <!--            <strong>{{ $errors->first('featured') }}</strong>-->
                      <!--          </span>-->
                      <!--        @endif-->
                      <!--    </div>-->
                      <!--</div>-->

                     <div class="col-sm-12">
                        <div class="form-group">
                            <label for="status">Publication Status</label>
                            <div class="box-body pub-stat display-inline">
                            <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" id="active" name="status" value="1">
                            <label for="active">Active</label>
                            @if ($errors->has('status'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('status') }}</strong>
                            </span>
                            @endif
                        </div>
                          <div class="box-body pub-stat display-inline">
                              <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" name="status" value="0" id="inactive">
                              <label for="inactive">Inactive</label>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>
                      </div>
                      <div class="col-sm-12 mrt-30">
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
  </section>
  <!-- /.content -->
@endsection