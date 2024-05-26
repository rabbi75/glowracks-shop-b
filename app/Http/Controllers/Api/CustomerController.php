<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\Couponcode;
use App\Cart;
use Carbon\Carbon;
use App\Shipping;
use App\Area;
use App\Order;
use App\Payment;
use App\Orderdetails;
use App\Ordernote;
use App\Review;
use App\Comment;
use App\Product;
use Mail;
use DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer', ['except' => ['login', 'register', 'verify', 'resendverify', 'forgetpassword', 'fpassreset', 'trackOrder', 'trackResult', 'couponapply', 'customerReview','relatedProAccount']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'email' => 'nullable|email|unique:customers',
            'phoneNumber' => 'required|unique:customers',
            'password' => 'required|same:confirmed',
            'confirmed' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ],
                200
            );
        }

        $verifyToken = rand(1111, 9999);
        $store_data = new Customer();
        $store_data->fullName = $request->fullName;
        $store_data->phoneNumber = $request->phoneNumber;
        $store_data->email = $request->email;
        $store_data->verifyToken = $verifyToken;
        $store_data->status = 1;
        $store_data->password = bcrypt(request('password'));
        $store_data->save();

        $url = "https://880sms.com/smsapi";
        $data = [
            "api_key" => "C2007721600cf90bc526d4.64142197",
            "type" => "Text",
            "contacts" => $request->phoneNumber,
            "senderid" => "8809612446331",
            "msg" => "Dear $request->fullName, Your account verify Token is $verifyToken ,Thanks for using Memo Australia",
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        // return $response;
        curl_close($ch);

        return response()->json(['status' => 'success', 'verifyphone' => $request->phoneNumber, 'initpass' => $request->password]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'required',
            'password' => 'required',
        ]);
        $credentials = request(['phoneNumber', 'password']);
        if ($token = Auth::guard('customer')->attempt($credentials)) {
            return response()->json(['status' => 'success', 'token' => $token]);
        }
        return response()->json(['status' => 'Error']);
    }

    public function account()
    {
        $customer = Auth::guard('customer')->user();
        $areas = Area::where('district_id', $customer->district_id)->get();
        return response()->json(['status' => 'success', 'customer' => $customer, 'areas' => $areas]);
    }
    public function accountoverview()
    {
        $customerId = Auth::guard('customer')->user()->id;
        $order_accepted = Order::where(['customerId' => $customerId, 'orderStatus' => '1'])->count();
        $order_running = Order::where(['customerId' => $customerId, 'orderStatus' => '3'])->count();
        $order_cancel = Order::where(['customerId' => $customerId, 'orderStatus' => '7'])->count();
        return response()->json(['status' => 'success', 'order_accepted' => $order_accepted, 'order_running' => $order_running, 'order_cancel' => $order_cancel]);
    }
    public function editprofile()
    {
        $customer = Auth::guard('customer')->user();
        $areas = Area::where('district_id', $customer->district_id)->get();
        return response()->json(['status' => 'success', 'customer' => $customer, 'areas' => $areas]);
    }
    public function profileUpdate(Request $request)
    {
        $update = Customer::find(Auth::guard('customer')->user()->id);
        $update_image = $request->file('image');
        if ($update_image) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/customer/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $update->image;
        }
        $update->fullName             = $request->fullName;
        $update->phoneNumber          = $request->phoneNumber;
        $update->email                = $request->email;
        $update->address              = $request->address;
        $update->district_id          = $request->district_id;
        $update->area_id              = $request->area_id;
        $update->image                = $fileUrl;
        // return $update;
        $update->save();
        return response()->json(['status' => 'success', 'update' => $update]);
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'verifyPin' => 'required',
        ]);
        $customerphone = getallheaders()['verifyphone'];
        $password = getallheaders()['initpass'];
        $verified = Customer::where('phoneNumber', $customerphone)->first();
        $verifydbtoken = $verified->verifyToken;
        $verifyformtoken = $request->verifyPin;
        if ($verifydbtoken == $verifyformtoken) {
            $verified->verifyToken = 1;
            $verified->status = 1;
            $verified->save();
            $credentials = ['phoneNumber' => $customerphone, 'password' => $password];
            try {
                if (!($token = Auth::guard('customer')->attempt($credentials))) {
                    return response()->json(
                        [
                            'error' => 'Invalid Credentials',
                        ],
                        401
                    );
                }
            } catch (JWTException $e) {
                return response()->json(
                    [
                        'error' => 'Could not create token',
                    ],
                    500
                );
            }
            return response()->json(
                [
                    'status' => 'success',
                    'token' => $token,
                ],
                200
            );
        }
    }

    public function resendverify(Request $request)
    {
        $customerphone = getallheaders()['verifyphone'];
        $findcustomer = Customer::where('phoneNumber', $customerphone)->first();
        $verifyToken = rand(111111, 999999);
        $findcustomer->verifyToken = $verifyToken;
        $findcustomer->save();

        $url = "https://880sms.com/smsapi";
        $data = [
            "api_key" => "C2007721600cf90bc526d4.64142197",
            "type" => "Text",
            "contacts" => $findcustomer->phoneNumber,
            "senderid" => "8809612446331",
            "msg" => "Hi $findcustomer->fullName, Your account verify Token is $verifyToken ,Thanks for using Ecommerce",
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        // return $response;
        curl_close($ch);
        return response()->json(['status' => 'success']);
    }

    public function forgetpassword(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'required',
        ]);
        $checkCustomer = Customer::where('phoneNumber', $request->phoneNumber)->first();
        if ($checkCustomer) {
            $passResetToken = rand(111111, 999999);
            $checkCustomer->passResetToken = $passResetToken;
            $checkCustomer->save();

            $url = "https://880sms.com/smsapi";
            $data = [
                "api_key" => "C2007721600cf90bc526d4.64142197",
                "type" => "Text",
                "contacts" => $checkCustomer->phoneNumber,
                "senderid" => "8809612446331",
                "msg" => "Hi $checkCustomer->fullName, Your account verify Token is $passResetToken ,Thanks for using Ecommerce",
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            // return $response;
            curl_close($ch);

            $customerphone = $checkCustomer->phoneNumber;
            return response()->json(['status' => 'success', 'customerphone' => $customerphone]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function passwordchange(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = Customer::find(Auth::guard('customer')->user()->id);
        $hashPass = $user->password;
        if (Hash::check($request->old_password, $hashPass)) {
            $user
                ->fill([
                    'password' => Hash::make($request->new_password),
                ])
                ->save();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function fpassreset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'password' => 'required',
        ]);
        $customerphone = getallheaders()['customerphone'];
        $customerInfo = Customer::where('phoneNumber', $customerphone)->first();
        if ($customerInfo->passResetToken == $request->token) {
            $customerInfo->password = bcrypt(request('password'));
            $customerInfo->passResetToken = null;
            $customerInfo->save();

            $credentials = ['phoneNumber' => $customerphone, 'password' => $request->password];
            try {
                if (!($token = Auth::guard('customer')->attempt($credentials))) {
                    return response()->json(
                        [
                            'error' => 'Invalid Credentials',
                        ],
                        401
                    );
                }
            } catch (JWTException $e) {
                return response()->json(
                    [
                        'error' => 'Could not create token',
                    ],
                    500
                );
            }
            return response()->json(
                [
                    'status' => 'success',
                    'token' => $token,
                ],
                200
            );
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return response()->json(['status' => 'success']);
    }
    public function orderSave(Request $request){
          
        $this->validate($request,[
            'paymentType'=>'required',
            'fullName'=>'required',
            'phoneNumber'=>'required',
            'district'=>'required',
            'area'=>'required',
            'address'=>'required',
        ]);
        
        if($request->paymentType !='cod'){
            if($request->transectionId == null && $request->senderId == null){
                return response()->json(['status' => 'transactionerror']);
            }
        }
        
        $customer_id = getallheaders()['customer_id'];
        $productcarts = Cart::with('product')->where('customer_id', $customer_id)->get();
        $subtotal = Cart::with('product')
            ->where('customer_id', $customer_id)
            ->get()
            ->sum(function($total){ 
                return $total->product->proNewprice * $total->quantity; 
            }); 
        // point amount 
       $pointamount = getallheaders()['pointamount'];
       if($pointamount > 0){
           $pointamount = getallheaders()['pointamount'];
       }else{
           $pointamount = 0;
       }
       $couponamount = 0;
        if($productcarts !=NULL){
            $shippingfee = Area::find($request->area)->shippingfee;
            $area = Area::find($request->area);
           $shipping              =   new Shipping();
           $shipping->name        =   $request->fullName;
           $shipping->phone       =   $request->phoneNumber;
           $shipping->address     =   $request->address;
           $shipping->district    =   $request->district;
           $shipping->shippingfee =   $shippingfee;
           $shipping->area        =   $request->area;
           $shipping->note        =   $request->note;
           $shipping->customerId  =   Auth::guard('customer')->user()->id;
           $shipping->save();
           // return $shipping;

           //   which transection id
            if ($request->paymentType == "cod") {
                $paymentStatus = 'unpaid';
            } else {
                $paymentStatus = 'in-review';
            }
            if ($request->paymentType == "bkash" || $request->paymentType == "roket" || $request->paymentType == "nagad") {
                $bkashFee = null;
                $paymentStatus = 'in-review';
            } else {
                $bkashFee = null;
                $paymentStatus = 'unpaid';
            }
               

            $order = new Order();
            $order->customerId       =    Auth::guard('customer')->user()->id;
            $order->shippingId       =    $shipping->shippingPrimariId;
            $order->orderTotal       =    ($subtotal + $shippingfee) - $couponamount;
            $order->discount         =    0;           
            $order->point            =    $subtotal / 100;
            $order->pointamount      =    $pointamount;
            $order->trackingId       =    rand(111111,999999);
            $order->created_at       =    Carbon::now();
            // dd($pointamount);
            $order->save();


            $payment = new Payment();
            $payment->orderId = $order->orderIdPrimary;
            $payment->paymentType = $request->paymentType;
            $payment->senderId = $request->senderId;
            $payment->transectionId = $request->transectionId;
            $payment->paymentStatus = $paymentStatus;
            $payment->save();
            
          

            foreach($productcarts as $cartitem){
                $orderDetails                   =   new Orderdetails();
                $orderDetails->orderId          =   $order->orderIdPrimary;
                $orderDetails->ProductId        =   $cartitem->product_id;
                $orderDetails->productName      =   $cartitem->product->proName;
                $orderDetails->productPrice     =   $cartitem->product->proNewprice;
                $orderDetails->productSize      =   $cartitem->product_size?$cartitem->product_size:'';
                $orderDetails->productColor     =   $cartitem->product_color?$cartitem->product_color:'';
                $orderDetails->proPurchaseprice =   $cartitem->product->proPurchaseprice;
                $orderDetails->productQuantity  =   $cartitem->quantity;
                $orderDetails->created_at       =   Carbon::now();
                $orderDetails->save();

                // cart delete
                Cart::where(['customer_id'=>$customer_id,'product_id'=>$cartitem->product_id])->delete();
            }
            $note = new Ordernote();
            $note->orderId = $order->orderIdPrimary;
            $note->note = 'Your order placed successfully!';
            $note->save();

            
          $data = array(
             'email' => 'rabbicse10@gmail.com',
             'order_id'    =>  $order->orderIdPrimary,
            );
          $send = Mail::send('frontEnd.emails.ordernotification', $data, function($textmsg) use ($data){
          $textmsg->to($data['email']);
          $textmsg->subject('A New Order Place');
          });
          
          $data2 = array(
             'email' => Auth::guard('customer')->user()->email,
             'order_id'    =>  $order->orderIdPrimary,
            );
          $send = Mail::send('frontEnd.emails.ordernotification', $data2, function($textmsg) use ($data2){
          $textmsg->to($data2['email']);
          $textmsg->subject('A New Order Place');
          });
          
          return response()->json(['status'=>'success']);

        }else{
            return response()->json(['status'=>'error']);
        }
    }
    public function myorder()
    {
        $orders = Order::where('customerId', Auth::guard('customer')->user()->id)
            ->with('ordertype', 'payment')
            ->get();
        return response()->json(['status' => 'success', 'orders' => $orders]);
    }
    public function ordernote($id)
    {
        $notes = Ordernote::where('orderId', $id)->get();
        return response()->json(['status' => 'success', 'notes' => $notes]);
    }
    public function orderInvoice($order_id)
    {
        $orderInfo = Order::where(['orderIdPrimary' => $order_id, 'customerId' => Auth::guard('customer')->user()->id])
            ->with('ordertype', 'customer', 'orderdetails', 'payment', 'shipping', 'orderdetails.image')
            ->first();
        $note = Ordernote::where('orderId', $order_id)
            ->orderBy('id', 'DESC')
            ->first();
        if ($orderInfo != null) {
            return response()->json(compact('orderInfo', 'note'), 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid order id'], 422);
        }
    }
     public function customerReview(Request $request)
    {
        $this->validate($request, [
            'review' => 'required',
        ]);
            $review              = new Review();
            $review->product_id  = $request->product_id;
            $review->customer_id = Auth::guard('customer')->user()->id;
            $review->ratting     = $request->ratting;
            $review->review      = $request->review;
            $review->status      = 0;
            $review->created_at  = Carbon::now();
            $review->save();
    
            $reviews = Review::where(['product_id'=>$request->product_id])->with('customer')->get();
            
        return response()->json(['status'=>'success','reviews'=>$reviews]);
    }
     public function reviews()
    {
        $reviews = Review::distinct()->where(['customer_id'=>Auth::guard('customer')->user()->id])->with('product','product.image')->orderBy('id','DESC')->get()->keyBy('order_id');
        return response()->json(compact('reviews'));
    }
    public function customerComment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $comment                        = new Comment();
        $comment->product_id            = $request->product_id;
        $comment->comment               = $request->comment;
        $comment->customer_id           = Auth::guard('customer')->user()->id;
        $comment->created_at            = Carbon::now();
        $comment->save();

        return response()->json(['status' => 'success', 'comment' => $comment]);
    }

    public function pointapply(Request $request)
    {
        $this->validate($request, [
            'point' => 'required',
        ]);
        $findcustomer = Customer::find(Auth::guard('customer')->user()->id);
        if ($findcustomer->point >= 300) {
            if ($findcustomer->point <= $request->point) {
                return response()->json(['status' => 'overpoint']);
            }
            $pointamount = $request->point;
            return response()->json(['status' => 'success', 'pointamount' => $pointamount]);
        } else {
            return response()->json(['status' => 'lowamount', 'message' => 'Your apply point not available']);
        }
        return response()->json(['status' => 'success', 'comment' => $comment]);
    }


    public function trackOrder(Request $request)
    {
        $this->validate($request, [
            'trackId' => 'required',
        ]);
        $orderinfo = DB::table('orders')
            ->join('shippings', 'orders.shippingId', '=', 'shippings.shippingPrimariId')
            ->where(['orders.trackingId' => $request->trackId])
            ->first();
        if ($orderinfo != NULL) {
            return response()->json(['status' => 'success', 'orderinfo' => $orderinfo]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
    public function trackResult($trackId)
    {
        $orderinfo = Order::with('ordernotes')
            ->where('trackingId', $trackId)
            ->first();
        if ($orderinfo) {
            return response()->json(['status' => 'success', 'orderinfo' => $orderinfo]);
        } else {
            return response()->json(['status' => 'error'], 402);
        }
    }

    public function couponapply(Request $request)
    {
        $findcoupon = Couponcode::where('couponcode', $request->couponcode)->first();
        if ($findcoupon == null) {
            return response()->json(['status' => 'invalid', 'message' => 'Opps! Your enter coupon code not valid']);
        } else {
            $cartamount = $request->cartamount;
            $currentdata = date('Y-m-d');
            $expairdate = $findcoupon->expairdate;
            if ($currentdata <= $expairdate) {
                $cartamount = getallheaders()['cartamount'];
                if ($cartamount >= $findcoupon->buyammount) {
                    if ($cartamount >= $findcoupon->buyammount) {
                        if ($findcoupon->offertype == 1) {
                            $discountammount = ($cartamount * $findcoupon->amount) / 100;
                            return response()->json(['status' => 'success', 'message' => 'Success! Your coupon code accepted', 'amount' => $discountammount, 'couponcode' => $findcoupon->couponcode]);
                        } else {
                            $discountammount = $findcoupon->amount;
                            return response()->json(['status' => 'success', 'message' => 'Success! Your coupon code accepted', 'amount' => $discountammount, 'couponcode' => $findcoupon->couponcode]);
                        }
                    }
                } else {
                    return response()->json(['status' => 'lowamount', 'message' => 'Opps!  Your total shopping amount not available for offer']);
                }
            } else {
                return response()->json(['status' => 'expaire', 'message' => 'Opps! Sorry your promo code date expaire']);
            }
        }
    }
    
    public function relatedProAccount(){
        $relatedproduct = Product::where(['status'=>1])
            ->select('id','slug','proName','proQuantity','proOldprice','proNewprice','proQuantity')
            ->orderBy('id', 'DESC')
            ->withCount('reviews')
            ->limit(5)
            ->with('image')
            ->get();
        return response()->json(compact('relatedproduct'));
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>
                $this->guard()
                    ->factory()
                    ->getTTL() *
                60 *
                24 *
                365,
        ]);
    }
    public function guard()
    {
        return Auth::guard('customer');
    }
}
