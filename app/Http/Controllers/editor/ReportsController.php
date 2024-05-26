<?php

namespace App\Http\Controllers\editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Orderdetails;
use App\Prescription;
use App\Customermessage;
use App\Comment;
use App\Order;
use App\Guestorder;
use App\Customerapply;
use App\Sellwithus;
use App\Ordertype;
use App\Product;
use App\Customer;
use App\Payment;
use App\Ordernote;
use App\Expence;
use App\Generalsetting;
use DB;
use Mail;
use Carbon\Carbon;
class ReportsController extends Controller
{
     public function ordermanage($slug,Request $request){
        if(!empty($slug)){
            $status = Ordertype::where('slug',$slug)->first()->id;
            $filter = $request->filter;
        }else{
           $status = $request->status;
           $filter = $request->filter;
        }

         if($status && $request->filter && $request->start && $request->end){
              $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->where('orderStatus',$status)
            ->whereBetween('orders.created_at', [$request->start, $request->end])
            ->get();
         }elseif($status==NULL && $request->filter && $request->start && $request->end){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->whereBetween('orders.created_at', [$request->start, $request->end])
            ->get();
         }elseif($status==NULL && $request->filter==1){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==2){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::today())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            // return $show_data;
         }elseif($status==NULL && $request->filter==3){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::yesterday())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==4){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereMonth('orders.created_at',Carbon::now()->month)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==5){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::now()->subMonth())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            $filter = 1;
            $status = 1;
         }elseif($status==NULL && $request->filter==6){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->year)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==7){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->subYear())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==1){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->where('orders.orderStatus',$status)
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==2){
            //  return $request->all();
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::today())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            // return $show_data;
         }elseif($status && $request->filter==3){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::yesterday())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==4){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereMonth('orders.created_at',Carbon::now()->month)
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==5){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::now()->subMonth())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==6){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->year)
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==7){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->subYear())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }else{
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->where('orders.orderStatus',$status)
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            // return $show_data;
            $filter = 1;
            $status = 1;
            
         }
         return view('backEnd.reports.ordermanage',compact('show_data','filter','status'));
    	
    }
    public function orderreport(){
         $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            return view('backEnd.reports.orderreports', compact('show_data'));
    }

    public function expencereports(){
        $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            return view('backEnd.reports.expencereports', compact('show_data'));

    }
    public function ordercancel(){
        $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->where('cancelRequest',1)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            return view('backEnd.reports.ordercancel',compact('show_data'));
    }
    public function orderFilter(Request $request){
        // return $request->all();
    	$show_data = DB::table('orders')
        ->join('customers','orders.customerId','=','customers.id')
        ->where('orders.orderStatus',$status)
        ->whereDate('orders.created_at','<=',$request->enddate)
        ->whereDate('orders.created_at','>=',$request->startdate)
        ->select('orders.*','customers.fullName','customers.phoneNumber')
        ->orderBy('orders.orderIdPrimary','DESC')
        ->get();
        return view('backEnd.reports.filterorders',compact('show_data'));
    }
      public function stock(){
     	$show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
     	return view('backEnd.inventory.stock',compact('show_data'));
     }
      public function stockout(){
     	$show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->where('products.proQuantity','>', 0)
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
     	return view('backEnd.inventory.stockout',compact('show_data'));
     }
      public function stockwarning(){
        $show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->where('products.proQuantity','<', 6)
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
        return view('backEnd.inventory.stockwarning',compact('show_data'));
     }
      public function stockreort(){
        $show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
        return view('backEnd.reports.stockreports',compact('show_data'));
     }
    public function details($shippingId,$customerId,$orderIdPrimary){
	    	$orderInfo = DB::table('orders')
            ->join('customers', 'orders.customerId', '=', 'customers.id')
            ->join('payments', 'orders.orderIdPrimary', '=', 'payments.orderId')
            ->where('orders.orderIdPrimary', $orderIdPrimary)
            ->select('orders.*', 'customers.fullName', 'customers.phoneNumber', 'customers.address', 'payments.paymentType')
            ->first();
        // dd($orderInfo);
        $paymentmethod = DB::table('payments')
            ->join('orders', 'payments.orderId', '=', 'orders.orderIdPrimary')
            ->where('payments.orderId', $orderIdPrimary)
            ->select('payments.*', 'orders.orderIdPrimary')
            ->first();
            // dd($paymentmethod);
        $shippingInfo = DB::table('shippings')
            ->join('orders', 'shippings.shippingPrimariId', '=', 'orders.shippingId')
            ->where('shippings.shippingPrimariId', $shippingId)
            ->select('shippings.*', 'orders.*')
            ->first();

        $orderDetails = Orderdetails::where('orderdetails.orderId', $orderIdPrimary)->with('image')->get();

        $ordernote = Ordernote::where('orderId', $orderIdPrimary)->orderBy('id', 'DESC')->first();
        return view('backEnd.reports.invoice', compact('orderInfo', 'shippingInfo', 'paymentmethod', 'orderDetails', 'ordernote'));
	    }

	    
	   public function adminmessage(Request $request){
	   	$this->validate($request,[
            'message'=>'required',
        ]);
       $conversion              		=   new Adminmessage();
       $conversion->message     		=   $request->message;
       $conversion->prescription_id     =   $request->prescriptionId;
       $conversion->admin     			=   $request->admin;
       $conversion->save();
       Toastr::success('Message send successfully','success');
       return redirect()->back();
	   }

	   public function comment(){
      $comments = DB::table('comments')
          ->join('customers','comments.customer_id','=','customers.id')
          ->join('products','comments.product_id','=','products.id')
            ->where('comments.status',0)           
             ->select('comments.*','customers.fullName','products.id as product_id','products.slug')
             ->orderBy('id', 'DESC')
            ->get();
      return view('backEnd.comments.comment',compact('comments'));
     }

     public function commentAnswer($id){
      $acomments = DB::table('comments')
          ->join('customers','comments.customer_id','=','customers.id')
          ->join('products','comments.product_id','=','products.id')
            ->where('comments.id',$id)        
             ->select('comments.*','customers.fullName','products.id as product_id')
            ->first();
      return view('backEnd.comments.answer',compact('acomments'));
     }

     public function sendAnswer(Request $request){
        $update_data             =   Comment::find($request->hidden_id);
        $update_data->answer     =    $request->answer;
        $update_data->admin_id   =    $request->admin_id;
        $update_data->status     =    1;
        $update_data->save();
        Toastr::success('message', 'Your message send successfully!');
        return redirect('editor/comment/unread');
    }
       public function allComments(){
      $allComments = DB::table('comments')
          ->join('customers','comments.customer_id','=','customers.id')
          ->join('products','comments.product_id','=','products.id')      
          ->join('users','comments.admin_id','=','users.id')      
             ->select('comments.*','customers.fullName','products.id as product_id','users.name','products.slug')
             ->orderBy('id', 'DESC')
            ->get();
      return view('backEnd.comments.allcomment',compact('allComments'));
     }
     public function deleteComment(Request $request){
        $delete_data = Comment::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('message', 'Comment delete successfully!');
        return redirect('/editor/comment/all');
    }
    
    public function orderstatus($id,$status){
        $published_data = Order::where('orderIdPrimary',$id)->update(['orderStatus' => $status]);

            $ordertype = Ordertype::find($status);
            
            $note = new Ordernote();
            $note->orderId = $id;
            $note->note = "Your order has been $ordertype->name";
            // return ($note);
            $note->save();


        if($status==2){
         $orderInfo = Order::where('orderIdPrimary',$id)->first();
         $findcustomer = Customer::find($orderInfo->customerId);
            if($findcustomer->email !=NULL){
               $data = $findcustomer->toArray();
                $send = Mail::send('frontEnd.emails.orderaccept', $data, function($textmsg) use ($data){
                  $textmsg->to($data['email']);
                  $textmsg->subject('Order Accept Successfully');
                });
            }
         }elseif($status==4){
         $orderInfo = Order::where('orderIdPrimary',$id)->first();
         $findcustomer = Customer::find($orderInfo->customerId);
            if($findcustomer->email !=NULL){
               $data = $findcustomer->toArray();
                $send = Mail::send('frontEnd.emails.orderpicked', $data, function($textmsg) use ($data){
                  $textmsg->to($data['email']);
                  $textmsg->subject('Order Picked Successfully');
                });
            }
         }elseif($status==6){
             $paymentStatus = Payment::where('orderId',$id)->update(['paymentStatus' => 'Paid']);
             $orderDetails = orderDetails::where('orderId',$id)->get();
            //  return $orderDetails;
             foreach($orderDetails as $orderDetail){
                $product = Product::find($orderDetail->ProductId);
                $product->proQuantity = $product->proQuantity - $orderDetail->productQuantity;
                $product->save();
            }
            $orderInfo = Order::where('orderIdPrimary',$id)->first();
            $findcustomer = Customer::find($orderInfo->customerId);
            $findcustomer->point = $findcustomer->point + $orderInfo->point;
            $findcustomer->point = $findcustomer->point - $orderInfo->pointamount;
            $findcustomer->save();
            
            if($findcustomer->email !=NULL){
                    $data = array(
                     'email' => $findcustomer->email,
                     'order_id'    => $id,
                    );
                  $send = Mail::send('frontEnd.emails.ordernotification', $data, function($textmsg) use ($data){
                  $textmsg->to($data['email']);
                  $textmsg->subject('Order Delivered Suscusfull');
                  });
            }
            
        }
        Toastr::success('message', 'Order status change successfully!');
        return redirect()->back();
    }
    
     public function orderlist($status){
        $ordertype = Ordertype::find($status);
        $show_data = DB::table('orders')
        ->join('customers','orders.customerId','=','customers.id')
        ->select('orders.*','customers.fullName','customers.phoneNumber')
        ->where('orderStatus',$status)
        ->orderBy('orderIdPrimary','DESC')
        ->get();
        return view('backEnd.reports.orderlist',compact('show_data','ordertype'));
    }

    public function destroy(Request $request){
      $deleteId = Customerapply::find($request->hidden_id);
        $deleteId->delete();
        Toastr::success('message', 'reports  delete successfully!');
        return redirect('/editor/register/manage');
    }
   
    public function customerlist(){
        $show_data = Customer::orderBy('id','DESC')->get();
        return view('backEnd.reports.customerlist',compact('show_data'));
    }
     public function deliverymanAssign(Request $request){
        $order_assign = Order::find($request->hidden_id);
        $order_assign->deliveryman_id = $request->deliveryman_id;
        $order_assign->save();
        return redirect()->back();

     }
      public function generalsetting(){
        $edit_data = Generalsetting::find(1);
        return view('backEnd.general.edit', compact('edit_data'));
    }
     public function update(Request $request){

        $update_data                        =      Generalsetting::find($request->hidden_id);
        $update_data->sitename              =      $request->sitename;
        $update_data->metadescrp            =      $request->metadescrp;
        $update_data->metatag               =      $request->metatag;
        $update_data->googleanyh            =      $request->googleanyh;
        $update_data->googleanybo           =      $request->googleanybo;
        $update_data->googleconh            =      $request->googleconh;
        $update_data->googleconbo           =      $request->googleconbo;
        $update_data->facebookmessh         =      $request->facebookmessh;
        $update_data->facebookmessbo        =      $request->facebookmessbo;
        $update_data->facebookpixh          =      $request->facebookpixh;
        $update_data->facebookpixbo         =      $request->facebookpixbo;
        $update_data->status                =      $request->status;
        $update_data->save();
        Toastr::success('message', 'Generalsetting Update successfully!');
        return redirect()->back();
    }

    
}
