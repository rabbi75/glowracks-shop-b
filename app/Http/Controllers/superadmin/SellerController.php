<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Seller;
use File;
use DB;


class SellerController extends Controller
{
    public function index(){        
        return view('backEnd.seller.add');

    }
    public function store(Request $request){
        $this->validate($request,[
            'sellerName'=>'required',
            'ownerName'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'status'=>'required',
        ]);

        // image01 upload
        $image = $request->file('image');
        if($image){
        $name =  time().'-'.$image->getClientOriginalName();
        $uploadpath = 'public/uploads/seller/';
        $image->move($uploadpath, $name);
        $imageUrl = $uploadpath.$name;
        }else{
           $imageUrl = NULL; 
        }

        $store_data                    =      new Seller();
        $store_data->sellerName        =      $request->sellerName;
        $store_data->slug              =      Str::slug($request->get('sellerName'));
        $store_data->ownerName         =      $request->ownerName;
        $store_data->phone             =      $request->phone;
        $store_data->email             =      $request->email;
        $store_data->address           =      $request->address;
        $store_data->ratting           =      $request->ratting;
        $store_data->website           =      $request->website;
        $store_data->ownerName         =      $request->ownerName;
        $store_data->image             =      $imageUrl;
        $store_data->status            =      $request->status;
        $store_data->save();
        Toastr::success('message', 'Seller add successfully!');
        return redirect('/superadmin/seller/manage');
    }
     public function manage(){
        $show_data = Seller::
             orderBy('id','DESC')
            ->get();
        return view('backEnd.seller.manage',compact('show_data'));
    }
     public function edit($id){
        $edit_data = Seller::find($id);
        return view('backEnd.seller.edit',compact('edit_data'));
    }
      public function update(Request $request){
        $update_data = Seller::find($request->hidden_id);
        $image = $request->file('image');
           if($image) {
                $image = $request->file('image');
                File::delete(public_path().'public/upload/seller',$update_data->image);
                $name =  time().'-'.$image->getClientOriginalName();
                $uploadpath = 'public/uploads/seller/';
                $image->move($uploadpath, $name);
                $update_fileUrl = $uploadpath.$name;
            }else{
                $update_fileUrl = $update_data->image;
            }

        $update_data->sellerName          =     $request->sellerName;
        $update_data->slug                =     Str::slug($request->get('sellerName'));
        $update_data->ownerName           =     $request->ownerName;
        $update_data->phone               =     $request->phone;
        $update_data->email               =     $request->email;
        $update_data->address             =     $request->address;
        $update_data->ratting             =     $request->ratting;
        $update_data->website             =     $request->website;
        $update_data->ownerName           =     $request->ownerName;
        $update_data->image               =     $update_fileUrl;
        $update_data->status              =     $request->status;
        $update_data->save();
        Toastr::success('message', 'Seller Update successfully!');
        return redirect('superadmin/seller/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Seller::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Seller active successfully!');
        return redirect('/superadmin/seller/manage');
    }

    public function active(Request $request){
        $publishId = Seller::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Seller active successfully!');
        return redirect('/superadmin/seller/manage');
    }
    public function destroy(Request $request){
        $delete_data = Seller::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/logo', $delete_data->image); 
        $delete_data->delete();
        Toastr::success('message', 'Seller  delete successfully!');
        return redirect('/superadmin/seller/manage');
    }
}
