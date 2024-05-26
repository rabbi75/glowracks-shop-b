<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gallery;
use File;
use Toastr;

class GalleryController extends Controller
{
    public function add(){
        return view('backEnd.gallery.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);

        // image upload
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $uploadPath = 'public/uploads/gallery/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

        $store_data = new Gallery();
        $store_data->name = $request->name;
        $store_data->image = $fileUrl;
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'gallery  add successfully!');
        return redirect('/editor/gallery/manage');
    }
    public function manage(){
        $show_data = Gallery::all();
        return view('backEnd.gallery.manage', [
            'show_data'=> $show_data,
        ]);
    }
    public function edit($id){
        $edit_data = Gallery::find($id);
        return view('backEnd.gallery.edit', ['edit_data'=>$edit_data]);
    }
     public function update(Request $request){
        $this->validate($request,[
            'status'=>'required',
            'name'=>'required',
        ]);

        $update_data = Gallery::find($request->hidden_id);
        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            File::delete(public_path() . 'public/uploads/gallery', $update_data->image); 
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/gallery/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_data->name = $request->name;
        $update_data->image = $fileUrl;
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'gallery  update successfully!');
        return redirect('/editor/gallery/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Gallery::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'gallery  inactive successfully!');
        return redirect('/editor/gallery/manage');
    }

    public function active(Request $request){
        $publishId = Gallery::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'gallery  active successfully!');
        return redirect('/editor/gallery/manage');
    }
     public function destroy(Request $request){
        $deleteId = Gallery::find($request->hidden_id);
         File::delete(public_path() . 'public/uploads/gallery', $deleteId->image);
        $deleteId->delete();
        Toastr::success('message', 'gallery  delete successfully!');
        return redirect('/editor/gallery/manage');
    }
}
