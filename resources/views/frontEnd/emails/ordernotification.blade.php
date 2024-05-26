<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Order Notification</title>
</head>
<body class="bg-white">
<div style="padding:30px;">
      @php
        $order = App\Order::where('orderIdPrimary',$order_id)->first();
        $shipping = App\Shipping::where('shippingPrimariId',$order->shippingId)->first();
        $orderdetails = App\Orderdetails::where('orderId',$order_id)->with('image')->get();
        $paymentstype = App\Payment::where('orderId',$order_id)->first();
       @endphp
    <!-- email template -->
    <table class="body-wrap" style="background:#fff; width: 100%; margin: 0;">
        <tbody style="background:#FF1593;">
            <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 25px; margin: 0;border:0">
                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                   <h3 style="color:#fff;text-align:center;padding:20px 0">Thank for your order</h3>
                 </td>
            </tr>
        </tbody>
    </table>
    <table class="body-wrap" style="background:#fff; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;  font-size: 16px; width: 100%; margin: 0;">
        <tbody style="background:#fff">
            <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;border:0">
                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; padding-top: 15px;">
                    Hi Dear {{$shipping->name}}
                 </td>
            </tr>
            <tr>
                <td style="padding:30px 0;border:0">Thanks for your order. It's on-hold untill we confirm that payment has been received. In the meantime, here's a reminder of what you ordered.</td></br>
            </tr>
            <tr>
                 <td style="padding-bottom:30px">Thanks for purchasing through @if($paymentstype->paymentType=='cod')Cash On Delivery @else {{$paymentstype->paymentType}} @endif We will check and give you update as soon as possible.</td>
            </tr>
        </tbody>
    </table>
     <table class="body-wrap" style="background:#fff; width: 100%; margin: 0;">
        <tbody>
            <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 25px; margin: 0;border:0">
                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                   <h3 style="color:#FF1593;padding-bottom:10px">[Order # {{$order->trackingId}}] ({{$order->created_at}})</h3>
                 </td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%;border:1px solid #ddd">
       <thead>
           <tr>
               <td style="border:1px solid #ddd;padding:10px;font-weight:800">Product</td>
               <td style="border:1px solid #ddd;padding:10px;font-weight:800">Image</td>
               <td style="border:1px solid #ddd;padding:10px;font-weight:800">Color</td>
               <td style="border:1px solid #ddd;padding:10px;font-weight:800">Size</td>
               <td style="border:1px solid #ddd;padding:10px;font-weight:800">Quantity</td>
               <td style="border:1px solid #ddd;padding:10px;font-weight:800">Price</td>
           </tr>
       </thead>
       <tbody>
           @foreach($orderdetails as $pdetails)
            <tr>
                <td style="border:1px solid #ddd;padding:10px;width:20.66%">{{$pdetails->productName}}</td>
                <td style="border:1px solid #ddd;padding:10px;width:20.66%"><img src="{{asset($pdetails->image->image)}}" alt="" style="height:80px !important;"></td>
                <td style="border:1px solid #ddd;padding:10px;width:12.66%">{{$pdetails->productColor}}</td>
                <td style="border:1px solid #ddd;padding:10px;width:12.66%">{{$pdetails->productSize}}</td>
                <td style="border:1px solid #ddd;padding:10px;width:16.66%">{{$pdetails->productQuantity}}</td>
                <td style="border:1px solid #ddd;padding:10px;width:16.66%">{{$pdetails->productPrice}} TK</td>
            </tr>
            @endforeach
       </tbody>
    </table>
    
    <table style="width:100%;border:1px solid #ddd;border-top: 0px solid #fff;">
       <tbody>
            <tr>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;border-right: 0px solid #fff;font-weight:800">Subtotal</td>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;border-left: 0px solid #fff;"></td>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;">{{$order->orderTotal - $shipping->shippingfee}} TK</td>
            </tr>
            <tr>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;border-right: 0px solid #fff;font-weight:800">Shipping Charge</td>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;border-left: 0px solid #fff;"></td>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;">{{$shipping->shippingfee}} TK</td>
            </tr>
            
            <tr>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;border-right: 0px solid #fff;font-weight:800">Total</td>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;border-left: 0px solid #fff;"></td>
                <td style="border:1px solid #ddd;padding:10px;width:33.33%;border-top: 0px solid #fff;">{{$order->orderTotal}} TK</td>
            </tr>
       </tbody>
    </table>
    <!-- ./ email template -->
    <table>
        <tbody>
            <tr>
                <td style="padding:20px 0;font-weight:800;color:#FF1593;font-size:22px">Billing Address</td>
            </tr>
            <tr><td>{{$shipping->address}}</td></tr>
            <tr><td>{{$shipping->phone}}</td></tr>
            <tr><td>{{$shipping->name}}</td></tr>
        </tbody>
    </table>
</div>
</body>
</html>