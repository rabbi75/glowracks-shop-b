<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Deliveryman;
use App\Order;
use Auth;

class DeliverymanController extends Controller
{
     public function login(){
        return view('frontEnd.layouts.pages.deliveryman.login');
    }
    public function riderLogin(Request $request){
        $this->validate($request, [
            'phone'   => 'required',
            'password' => 'required|min:6'
        ]);

        $validAuth = Deliveryman::where('phonenumber',$request->phone)->first();
        if($validAuth){
            if (Auth::guard('deliveryman')->attempt(['phonenumber' => $request->phone, 'password' => $request->password])) {
                Toastr::success('congratulation you login successfully', 'success!');
                return redirect('deliveryman/account');
            }
            Toastr::error('message', 'Opps! your password wrong');
            return redirect()->back();
        }else{
            Toastr::error('message', 'Sorry! You have no account');
            return redirect()->back();
        }
    }
    public function account(){
        $order_accepted = Order::where(['deliveryman_id'=>Auth::guard('deliveryman')->user()->id, 'orderStatus'=>'1'])->count();
        $order_picked = Order::where(['deliveryman_id'=>Auth::guard('deliveryman')->user()->id, 'orderStatus'=>'3'])->count();
        $order_delivered = Order::where(['deliveryman_id'=>Auth::guard('deliveryman')->user()->id, 'orderStatus'=>'5'])->count();
        $order_returned = Order::where(['deliveryman_id'=>Auth::guard('deliveryman')->user()->id, 'orderStatus'=>'7'])->count();
        $order_list = Order::where('deliveryman_id',Auth::guard('deliveryman')->user()->id)->orderBy('orderIdPrimary', 'DESC')->limit(7)->with('customer')->get();
        return view('frontEnd.layouts.pages.deliveryman.dashboard', compact('order_accepted','order_picked', 'order_delivered', 'order_returned', 'order_list'));
    }

    public function profile(){
        $profile = Deliveryman::where('id',Auth::guard('deliveryman')->user()->id)->first();
        return view('frontEnd.layouts.pages.deliveryman.profile', compact('profile'));
    }
    public function myorder() {
        $order_list = Order::where('deliveryman_id',Auth::guard('deliveryman')->user()->id)->with('customer')->get();
        return view('frontEnd.layouts.pages.deliveryman.myorder', compact('order_list'));
    }

    public function forgetpassword(){
        return view('frontEnd.layouts.pages.forgetpassword');
    }

     public function changepassword(){
        return view('frontEnd.layouts.pages.deliveryman.changepassword');
    }

    public function resetpassword(Request $request){
        $this->validate($request, [
            'old_password'=>'required',
            'new_password'=>'required',
        ]);

        $deliveryman = Deliveryman::find(Auth::guard('deliveryman')->user()->id);
        $hashPass = $deliveryman->password;
        if (Hash::check($request->old_password, $hashPass)) {
            $deliveryman->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            Toastr::success('success', 'Done !,Your Password Change Success');
            return redirect('/deliveryman/account');
        }else{
           Toastr::error('warning', 'Opps!,Old Password Not Match');
           return redirect()->back();
        }

    }


public function orderstatus($id,$status){
        $published_data = Order::where('orderIdPrimary',$id)->update(['orderStatus' => $status]);
        Toastr::success('message', 'Order status change successfully!');
        return redirect()->back();
    }
    public function riderLogout(){
        Auth::guard('deliveryman')->logout();
        Toastr::success('You are logout successfully', 'success!');
        return redirect('/deliveryman/login');
    }
}
