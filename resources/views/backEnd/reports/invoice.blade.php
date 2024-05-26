@extends('backEnd.layouts.master')
@section('title','Order Invoice')
@section('main_content')
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
      @page { size: auto;  margin: 0mm; }
       
    .invoice-box {
        max-width: 950px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        position: relative;
        overflow: hidden;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    .table td, .table th {
        padding: 8px 10px;
    }
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .paidbar {
        display: inline-block;
        position: absolute;
        right: -60px;
        top: 25px;
        background: #08c437;
        transform: rotate(45deg);
        width: 220px;
        text-align: center;
        color: #fff;
        padding: 7px;
    }
    .paidbar h4 {
        margin: 0;
    }




    .invoice-box table thead {
        background: #dddddd;
        color: #fff;
    }
    .invoice-box table thead td {
        color: #1f7637;
        font-weight: 700;
        white-space: nowrap;
    }
    .bill-to-box p,
    .bill-from-box p {
        margin: 0;
        max-width: 350px;
    }
    h4.bill-from-title {
        color: #20AA6B;
        margin: 0;
        font-size: 1.2rem;
    }
    .invoice-logo-part, .invoice-info-part, .invoice-total-part {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }
    .order-info-box {
        text-align: right;
    }
    .order-info-box p strong {
        font-size: 1rem;
        color: #20AA6B;
    }
    .payment-due {
        display: flex;
        justify-content: flex-end;
        background-color: #ddd;
        align-items: center;
        padding-right: 10px;
        width: 520px;
        height: 37px;
    }
    .payment-due p, 
    .payment-due h3 {
        margin: 0;
    }
    .payment-due strong {
        color: #20AA6B;
        padding: 0 5px;
    }
    h3.cod {
        font-size: 1rem;
        padding-left: 5px;
        padding-right: 5px;
        font-weight: 700;
    }
    .total-box p {
        text-align: right;
    }
    .total-box p strong {
        color: #20AA6B;
    }
    .order-note-box p {
        margin-top: 20px;
    }
    .thanks-giving {
        border-bottom: 1px solid #ddd;
        border-top: 1px solid #ddd;
        padding: 25px 0;
        margin: 25px 0;
    }
    .thanks-giving p {
        margin: 0;
        text-align: center;
    }
    .powered-by .powered,
    .powered-by .domain {
        text-align: center;
        font-size: 1.1rem;
        color: #20AA6B;
        margin-top: 20px;
        font-weight: 900;
    }
    .powered-by .domain {
        font-size: 0.9rem;
        margin-top: 0;
    }
    </style>
</head>

<body>
<div style="width:100%;text-align-center">
       <button onclick="myFunction()" style="color: #fff;border: 0;padding: 6px 12px;background: green;border-radius: 5px;margin: 0 auto;
    margin-bottom: 0px;text-align: center;display: block;margin-bottom: 15px;cursor: pointer;" class="no-print"><i class="fa fa-print"></i></button>
</div>
    <p style="margin-bottom:10px;text-align: center;">আপনি যদি পিডিএফ আকারে ইনভয়েসটি ডাউনলোড করতে চান তাহলে প্রিন্ট এ  ক্লিক করে  Save As PDF এ সেভ করুন </p>
    <div class="invoice-box" id="printDivone">
        <div class="invoice-logo-part">
            @foreach($contactinfoes as $key=>$value)                    
            <div class="bill-from-box">
                <h4 class="bill-from-title">BILL FROM:</h4>
                <b>@foreach($generalInfoes as $sitename) {{ $sitename->sitename }} @endforeach</b>
                <p>{{ $value->address }}</p>
                <p>{{ $value->email }}</p>
                <p>{{ $value->phone }}</p>
            </div>
            @endforeach
            <div class="invoice-logo">
                @foreach($mainlogo as $logo)
                <img src="{{asset($logo->image)}}" style="max-width: 150px; height: auto;display:block !important;margin-bottom: 20px;margin-top: 10px;padding-right: 30px;">
                @endforeach
            </div>
        </div>


        
        <div class="invoice-info-part">
            <div class="bill-to-box">
                <h4 class="bill-from-title">BILL TO:</h4>
                <b>{{ $shippingInfo->name }}</b>
                <p>{{ $orderInfo->address }}</p>
                <p>Delivery Location: <strong>{{ $shippingInfo->address}}</strong></p>
                <p>{{ $orderInfo->phoneNumber }}</p>
            </div>
            <div class="order-info-box">
                <p class="order-number">
                    <strong>ORDER NUMBER: </strong>
                    #{{ $orderInfo->orderIdPrimary }}
                </p>
                <p class="order-date">
                    <strong>ORDER DATE:</strong>
                    {{ date('M d, Y', strtotime($orderInfo->created_at))}}
                </p>
                <div class="payment-due">
                    <strong class="method">Payment Method: </strong>
                    @if($paymentmethod->paymentType == 'cod')
                    <h3 class="cod">Cash On Delivery</h3>
                    @else
                    <h3 class="text-uppercase bkash-rocket">{{ $orderInfo->paymentType }}</h3>
                    @endif
                    - 
                    <strong class="due">AMOUNT DUE: </strong>
                    @if($paymentmethod->paymentStatus == 'paid')
                    <span class="amount">Tk 0</span>
                    @else
                    <span class="amount" >Tk {{ $orderInfo->orderTotal}}</span>
                    @endif
                </div>
            </div>
        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <td>Item</td>
                    <td>Image</td>
                    <td>Color</td>
                    <td>Size</td>
                    <td>Sale Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $key=>$value)
                <tr style="border-bottom: 1px solid #ddd">
                    <td>{{ $value->productName }}</td>
                    <td><img src="{{asset($value->image->image)}}" alt="" style="height:50px !important;"></td>
                    <td>{{ $value->productColor }}</td>
                    <td>{{ $value->productSize }}</td>
                    <td>Tk {{ $value->productPrice }} </td>
                    <td>{{ $value->productQuantity }}</td>
                    <td style="white-space: nowrap;">Tk {{ $value->productPrice * $value->productQuantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-total-part">

            <div class="order-note-box" v-for="(info, index) in contact">
                <h4 class="bill-from-title">Order Note :</h4>
                @if($ordernote !=NULL)
                <p>{{ $ordernote->note }}</p>
                @endif
                <p>Created by: @foreach($generalInfoes as $sitename) {{ $sitename->sitename }} @endforeach</p> 
            </div>
            <div class="total-box">
                <p>
                    <strong>Subtotal : </strong>
                    Tk {{ $orderInfo->orderTotal - $shippingInfo->shippingfee + $orderInfo->discount }}
                </p>
                <p>
                    <strong>Shipping (+) :</strong>
                    Tk {{ $shippingInfo->shippingfee }}
                </p>
                <p>
                    <strong>Discount (-) :</strong>
                    Tk {{ $orderInfo->discount }}
                </p>
                <div class="payment-due">
                    <p>                                                     
                        <strong>Total : </strong>Tk {{ $orderInfo->orderTotal }}
                    </p>
                </div>
            </div>
        </div>
        <div class="thanks-giving">
            <p>Thank you for ordering from @foreach($generalInfoes as $sitename) {{ $sitename->sitename }} @endforeach. We offer a 3-day return policy on all products. If you have any complaint about this order, Please call or email us. </p>
        </div>
        <div class="powered-by">
            <p class="powered">Powered by @foreach($generalInfoes as $sitename) {{ $sitename->sitename }} @endforeach</p>
            <!-- <p class="domain">@foreach($generalInfoes as $sitename) {{ $sitename->sitename }} @endforeach</p> -->
        </div>

        <div class="paidbar">
            <h4>{{$paymentmethod->paymentStatus}}</h4>
        </div>
    </div>
    <script>
        function myFunction() {
            window.print();
        }
    </script>
</body>
</html>
@endsection
