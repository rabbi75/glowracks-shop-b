@extends('backEnd.layouts.master')
@section('title','Ticket Replay')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Ticket - [Support Ticket - #{{$ticket->id}} ] {{$ticket->subject}}</h3>
            <form action="{{url('editor/ticket/close/update')}}" method="POST" class="text-right">
              @csrf
              <input type="hidden" name="hidden_id" value="{{$ticket->id}}">
              <button type="submit" onclick="return confirm('Are you want close ticket')" class="btn btn-danger" title="Ticket close"><i class="fa fa-times-circle"></i> Close Ticket</button> 
            </form>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <div class="chat-body">
                  <div class="cartTable support-sms-body" id="messageBottom">
                      @foreach($cmessages as $key=>$value)
                      @if($value->isCustomer!=NULL)
                      @php
                          $customerInfo = App\Customer::find($value->isCustomer);
                      @endphp
                      <div class="support-message">
                          <div class="row">
                              <div class="col-sm-1 col-2">
                                  <div class="cuser-logo">
                                      <img src="{{asset($customerInfo->image)}}" alt="">
                                  </div>
                              </div>
                              <div class="col-sm-9 col-8">
                                  <div class="cuser-message employee-sms">
                                      <p>{{$value->message}}</p>
                                      <strong>
                                        {{date('F d, Y', strtotime($value->created_at))}},{{date('h:i:s a', strtotime($value->created_at))}}</strong>
                                  </div>
                                  @if($value->file)
                                  <div class="ticket-img">
                                    <img src="{{asset($value->file)}}" alt="">
                                  </div>
                                  @endif
                              </div>
                          </div>
                      </div>
                      @else
                      <div class="support-message">
                          <div class="row">
                            <div class="col-sm-1 col-2"></div>
                              <div class="col-sm-9 col-8">
                                  <div class="cuser-message admin-sms">
                                      <p>{{$value->message}}</p>
                                      <strong>
                                        {{date('F d, Y', strtotime($value->created_at))}},{{date('h:i:s a', strtotime($value->created_at))}}</strong>
                                  </div>
                                  @if($value->file)
                                  <div class="ticket-img">
                                    <img src="{{asset($value->file)}}" alt="">
                                  </div>
                                  @endif
                              </div>
                              <div class="col-1">
                                  <div class="admin-logo">  
                                    @foreach($mainlogo as $key=>$mlogo)
                                      <img src="{{asset($mlogo->image)}}" alt="">
                                    @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                      @endif
                      @endforeach
                  </div>
                  <!-- chat-body end -->
                  <div class="row">
                      <div class="col-sm-12">
                          <form action="{{url('editor/ticket/replay')}}" id="ticketForm" class="row support-textarea" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$ticket->id}}" name="ticketId">
                            <input type="hidden" value="{{$ticket->customerId}}" name="customerId">
                            <div class="col-sm-3 col-3">
                              <input type="file" name="file">
                            </div>
                              <div class="col-sm-7 col-7">
                                <div class="form-group">
                                  <textarea type="text" name="message"  class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}"  value="{{ old('message') }}" placeholder="Message" required=""></textarea>
                                   @if ($errors->has('message'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('message') }}</strong>
                                  </span>
                                  @endif
                                </div>
                              </div>
                              <div class="col-sm-2 col-4">
                                  <button type="submit" class="support-btn">Send</button>
                              </div>
                          </form>
                      </div>
                  </div>

              </div>
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