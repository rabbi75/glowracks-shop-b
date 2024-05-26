<?php

namespace App\Http\Controllers\editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Logo;
use File;

class LogoController extends Controller
{
    public function add(){
    	return view('backEnd.logo.add');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'image'=>'required',
    		'status'=>'required',
    	]);

    	// image upload
    	$file = $request->file('image');
    	$name = time().'-'.$file->getClientOriginalName();
    	$uploadPath = 'public/uploads/logo/';
    	$file->move($uploadPath,$name);
    	$fileUrl =$uploadPath.$name;

        // favicon image
        $file2 = $request->file('favicon');
        $name2 = time().'-'.$file2->getClientOriginalName();
        $uploadPath2 = 'public/uploads/logo/';
        $file2->move($uploadPath2,$name2);
        $fileUrl2 =$uploadPath2.$name2;

        // invoice logo
        $file3 = $request->file('invoice');
        $name3 = time().'-'.$file3->getClientOriginalName();
        $uploadPath3 = 'public/uploads/logo/';
        $file3->move($uploadPath3,$name3);
        $fileUrl3 =$uploadPath3.$name3;

    	$store_data = new Logo();
    	$store_data->image = $fileUrl;
        $store_data->favicon = $fileUrl2;
        $store_data->invoice = $fileUrl3;
    	$store_data->status = $request->status;
    	$store_data->save();
        Toastr::success('message', 'Logo add successfully!');
    	return redirect('/editor/logo/manage');
    }
    public function manage(){
    	$show_data = Logo::orderBy('id','DESC')->get();
        return view('backEnd.logo.manage', [
            'show_data'=> $show_data,
        ]);
    }
    public function edit($id){
        $edit_data = Logo::find($id);
        return view('backEnd.logo.edit', ['edit_data'=>$edit_data]);
    }
     public function update(Request $request){
        $this->validate($request,[
            'status'=>'required',
        ]);

        $update_data = Logo::find($request->hidden_id);

        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            File::delete(public_path() . 'public/uploads/logo', $update_data->image); 
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/logo/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        // favicon image update
        $update_image2 = $request->file('favicon');
        if ($update_image2) {
           $file2 = $request->file('favicon');
            File::delete(public_path() . 'public/uploads/logo', $update_data->favicon); 
            $name2 = time().'-'.$file2->getClientOriginalName();
            $uploadPath2 = 'public/uploads/logo/';
            $file2->move($uploadPath2,$name2);
            $fileUrl2 =$uploadPath2.$name2;
        }else{
            $fileUrl2 = $update_data->favicon;
        }

        // invoice image update
        $update_image3 = $request->file('invoice');
        if ($update_image3) {
            $file3 = $request->file('invoice');
            File::delete(public_path() . 'public/uploads/logo', $update_data->invoice); 
            $name3 = time().'-'.$file3->getClientOriginalName();
            $uploadPath3 = 'public/uploads/logo/';
            $file3->move($uploadPath3,$name3);
            $fileUrl3 =$uploadPath3.$name3;
        } else {
            $fileUrl3 = $update_data->favicon;
        }

        $update_data->image = $fileUrl;
        $update_data->favicon = $fileUrl2;
        $update_data->invoice = $fileUrl3;
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'Logo update successfully!');
        return redirect('/editor/logo/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Logo::find($request->hidden_id);
        $unpublish_data->status = 0;
        $unpublish_data->save();
        Toastr::success('message', 'Logo  inactive successfully!');
        return redirect('/editor/logo/manage');
    }

    public function active(Request $request){
        $publishId = Logo::find($request->hidden_id);
        $publishId->status = 1;
        $publishId->save();
        Toastr::success('message', 'Logo  active successfully!');
        return redirect('/editor/logo/manage');
    }
    public function destroy(Request $request){
        $delete_data = Logo::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/logo', $delete_data->image); 
        $delete_data->delete();
        Toastr::success('message', 'Logo delete successfully!');
        return redirect('/editor/logo/manage');
    }
}
