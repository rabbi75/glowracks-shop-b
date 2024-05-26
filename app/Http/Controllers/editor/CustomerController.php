<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Clientfeedback;
use App\Customer;
use App\Shipping;
use App\Order;
use App\Ticket;
use App\Ticketdetails;
use App\Subscription;
use DB;
use Auth;
use Mail;
class CustomerController extends Controller
{
    // customer option start
    public function customer(){
        $show_data = Customer::orderBy('id','DESC')->get();
        return view('backEnd.customer.customers',compact('show_data'));
    }
    public function activecustomer(){
        $show_data = Customer::where('status',1)->orderBy('id','DESC')->get();
        return view('backEnd.customer.active',compact('show_data'));
    }
    public function inactivecustomer(){
        $show_data = Customer::where('status',0)->orderBy('id','DESC')->get();
        return view('backEnd.customer.inactive',compact('show_data'));
    }
    public function unverified(){
        $show_data = Customer::where('verifyToken','!=',1)->orderBy('id','DESC')->get();
        return view('backEnd.customer.unverified',compact('show_data'));
    }
    public function emailsend(){
        return view('backEnd.customer.emailsend');
    }
    public function postemail(Request $request){
       $customers = Customer::where('status',1)->orderBy('id','DESC')->get();
       foreach ($customers as $key => $value) {
           $data = array(
             'email'    => $value->email,
             'text'     => $value->text,
             'subject'  => $request->subject,
            );
          $send = Mail::send('backEnd.customer.etemplate', $data, function($textmsg) use ($data){
              $textmsg->to($data['email']);
              $textmsg->subject($value->subject);
            });
       }
      Toastr::success('message', 'Customer email send successfully!');
        return redirect()->back();
    }
    public function smssend(){
        return view('backEnd.customer.smssend');
    }
    public function postsms(Request $request){
       $customers = Customer::where('status',1)->orderBy('id','DESC')->get();
       foreach ($customers as $key => $value) {
           $url = "https://msg.elitbuzz-bd.com/smsapi";
          $data = [
            "api_key" => "C200795560afdc9116bd26.38126411",
            "type" => "text",
            "contacts" => $value->phoneNumber,
            "senderid" => "8809612436177",
            "msg" => "$request->subject\r\n$request->text\r\nThanks for using Metro Express",
          ];
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $response = curl_exec($ch);
          
       }
      Toastr::success('message', 'Customer sms send successfully!');
        return redirect()->back();
    }
    public function customerprofile($id){
        $profileInfo = Customer::find($id);
        $totalshipping = Shipping::where('customerId',$id)->sum('shippingfee');
        $totaltransection = Order::where('customerId',$id)->sum('orderTotal');
        $totalorder = Order::where('customerId',$id)->count();
        return view('backEnd.customer.profile',compact('profileInfo','totalshipping','totaltransection','totalorder'));
    }
    public function customerupdate(Request $request){
        $update             = Customer::find($request->hidden_id);
        $update->fullName   = $request->fullName;
        $update->email      = $request->email;
        $update->phoneNumber= $request->phoneNumber;
        $update->address    = $request->address;
        $update->status     = 1;
        $update->verifyToken= 1;
        $update->save();
        Toastr::success('message', 'Customer profile update successfully!');
        return redirect()->back();
    }
    public function customeractive(Request $request){
        $publishId = Customer::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Customer active successfully!');
        return redirect()->back();
    }
    public function customerinactive(Request $request){
        $publishId = Customer::find($request->hidden_id);
        $publishId->status=0;
        $publishId->save();
        Toastr::success('message', 'Customer inactive successfully!');
        return redirect()->back();
    }

    // Custome Ticket manage
    public function allticket(){
        $show_data = DB::table('tickets')
            ->join('customers', 'tickets.customerId', '=', 'customers.id')
            ->select('tickets.*', 'customers.fullName','customers.phoneNumber')
            ->orderBy('id','DESC')
            ->get();
        return view('backEnd.ticket.allticket',compact('show_data'));
    }
    public function pendingticket(){
        $show_data = DB::table('tickets')
            ->join('customers', 'tickets.customerId', '=', 'customers.id')
            ->select('tickets.*', 'customers.fullName','customers.phoneNumber')
            ->orderBy('tickets.id','DESC')
            ->where('tickets.status',1)
            ->get();
        return view('backEnd.ticket.pendingticket',compact('show_data'));
    }
    public function closeticket(){
        $show_data = DB::table('tickets')
            ->join('customers', 'tickets.customerId', '=', 'customers.id')
            ->select('tickets.*', 'customers.fullName','customers.phoneNumber')
            ->orderBy('tickets.id','DESC')
            ->where('tickets.status',0)
            ->get();
        return view('backEnd.ticket.closeticket',compact('show_data'));
    }
    public function answerticket(){
        $show_data = DB::table('tickets')
            ->join('customers', 'tickets.customerId', '=', 'customers.id')
            ->select('tickets.*', 'customers.fullName','customers.phoneNumber')
            ->orderBy('tickets.id','DESC')
            ->where('tickets.status','!=','1')
            ->get();
        return view('backEnd.ticket.answerticket',compact('show_data'));
    }
     public function ticketview($id){
        $ticket = Ticket::where(['id'=>$id])->first();
        $cmessages = Ticketdetails::where(['ticketId'=>$id])->get();
         return view('backEnd.ticket.ticketview',compact('cmessages','ticket'));
    }
    public function ticketreplay(Request $request){
        $this->validate($request,[
            'message'=>'required',
        ]);
        $ticketupdate = Ticket::find($request->ticketId);
        if($ticketupdate->status==1){
            $ticketupdate->status = 2;
            $ticketupdate->save();
        }
       // file processing 
        $file = $request->file('file');
        if($file==NULL){
            $fileUrl = NULL;
        }else{
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/ticket/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }
       $ticket              = new Ticketdetails();
       $ticket->message     = $request->message;
       $ticket->customerId  = $request->customerId;
       $ticket->adminId     = Auth::user()->id;
       $ticket->ticketId    = $request->ticketId;
       $ticket->file        = $fileUrl;
       $ticket->isAdmin     = 1;
       $ticket->status      = 0;
       $ticket->save();
       Toastr::success('Success, Replay send successfully','Success!!');
       return redirect()->back();

    }

    public function ticketclose(Request $request){
        $ticketupdate = Ticket::find($request->hidden_id);
            $ticketupdate->status = 0;
            $ticketupdate->save();
       Toastr::success('Success, Ticket close successfully','Success!!');
       return redirect('editor/ticket/all');

    }

    // feedback option start
    public function clientfeedbacklist(){
        $show_data = Clientfeedback::orderBy('id','DESC')->get();
        return view('backEnd.customer.clientfeedback',compact('show_data'));
    }
    
    public function clientfeedbackactive(Request $request){
        $publishId = Clientfeedback::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Clientfeedback active successfully!');
        return redirect()->back();
    }
     public function clientfeedbackinactive(Request $request){
        $publishId = Clientfeedback::find($request->hidden_id);
        $publishId->status=0;
        $publishId->save();
        Toastr::success('message', 'Clientfeedback inactive successfully!');
        return redirect()->back();
    }
    public function subscription(){
        $show_data = Subscription::get();
        return view('backEnd.customer.subscription',compact('show_data'));
    }
    public function sdelete(Request $request){
        $delete_data = Subscription::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('message', 'Subscription  delete successfully!');
        return redirect()->back();
    }
    public function submail($id){
      $customerInfo = Subscription::find($id);
      return view('backEnd.customer.submail',compact('customerInfo'));
    }
    public function submailpost(Request $request){
       $data = array(
         'email'   => $request->email,
         'text'    => $request->text,
         'subject' => $request->subject,
        );
      $send = Mail::send('backEnd.customer.etemplate', $data, function($textmsg) use ($data){
          $textmsg->to($data['email']);
          $textmsg->subject($data['subject']);
        });
      Toastr::success('message', 'Subscription email send successfully!');
        return redirect()->back();
    }
}
