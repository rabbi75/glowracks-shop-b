<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Deliveryman;
use App\Order;
use DB;
use File;

class DeliverymanManageController extends Controller
{
    public function add(){
        return view('backEnd.deliveryman.add');
    }
     public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phonenumber'=>'required',
            'email'=>'required',
            'status'=>'required',
        ]);

        // image upload
        $file = $request->file('image');
        $name = time().'-'.$file->getClientOriginalName();
        $uploadPath = 'public/uploads/deliveryman/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

        $store_data = new Deliveryman();
        $store_data->image = $fileUrl;
        $store_data->name = $request->name;
        $store_data->phonenumber = $request->phonenumber;
        $store_data->email = $request->email;
        $store_data->address = $request->address;
        $store_data->commission = $request->commission;
        $store_data->commissiontype = $request->commissiontype;
        $store_data->password = bcrypt(request('password'));
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'Deliveryman  add successfully!');
        return redirect('superadmin/deliveryman/manage');
    }
    public function manage(){
        $show_data = Deliveryman::orderBy('id','DESC')->get();
        return view('backEnd.deliveryman.manage', [
            'show_data'=> $show_data,
        ]);
    }
    public function edit($id){
        $edit_data = Deliveryman::find($id);
        return view('backEnd.deliveryman.edit', ['edit_data'=>$edit_data]);
    }
     public function update(Request $request){
        $this->validate($request,[
            'status'=>'required',
        ]);

        $update_data = Deliveryman::find($request->hidden_id);
        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            File::delete(public_path() . 'public/uploads/slider', $update_data->image); 
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/deliveryman/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_data->image = $fileUrl;
        $update_data->name = $request->name;
        $update_data->phonenumber = $request->phonenumber;
        $update_data->email = $request->email;
        $update_data->address = $request->address;
        $update_data->commission = $request->commission;
        $update_data->commissiontype = $request->commissiontype;
        $update_data->password = bcrypt(request('password'));
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'Deliveryman  update successfully!');
        return redirect('superadmin/deliveryman/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Deliveryman::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Deliveryman  inactive successfully!');
        return redirect('superadmin/deliveryman/manage');
    }

    public function active(Request $request){
        $publishId = Deliveryman::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Deliveryman  active successfully!');
        return redirect('superadmin/deliveryman/manage');
    }
     public function destroy(Request $request){
        $deleteId = Deliveryman::find($request->hidden_id);
         File::delete(public_path() . 'public/uploads/slider', $deleteId->image);
        $deleteId->delete();
        Toastr::success('message', 'Deliveryman  delete successfully!');
        return redirect('superadmin/deliveryman/manage');
    }

    public function deprofile($id){
        $profileInfo = Deliveryman::find($id);
        $deliverdpercel = Order::where('deliveryman_id', $id)->where('orderStatus', 6)->count();
        $allpercel = Order::where('deliveryman_id', $id)->count();
        // return $deliverdpercel;
        return view('backEnd.deliveryman.profile',compact('profileInfo', 'deliverdpercel', 'allpercel'));
    }
   
}
