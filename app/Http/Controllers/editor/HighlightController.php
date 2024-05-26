<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Highlight;
use File;

class HighlightController extends Controller
{
    public function index(){
        return view('backEnd.highlight.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'desc'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);

        // image upload
        $file = $request->file('image');
        $name = time().'-'.$file->getClientOriginalName();
        $uploadPath = 'public/uploads/highlight/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

        $store_data                  = new Highlight();
        $store_data->desc            = $request->desc;
        $store_data->image           = $fileUrl;
        $store_data->serial          = 0;
        $store_data->status          = $request->status;
        $store_data->save();
        Toastr::success('message', 'Highlight add successfully!');
        return redirect('/editor/highlight/manage');
    }
    public function manage(){
        $show_data = Highlight::orderBy('serial','ASC')->get();
        return view('backEnd.highlight.manage',['show_data'=>$show_data]);
    }
    public function edit($id){
        $edit_data = Highlight::find($id);
        return view('backEnd.highlight.edit',[
            'edit_data'=>$edit_data
        ]);
    }

    public function update(Request $request){
        $update_data  = Highlight::find($request->hidden_id);
        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/highlight/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_data->desc            =   $request->desc;
        $update_data->image           =   $fileUrl;
        $update_data->serial          =   $request->serial;
        $update_data->status          =   $request->status;
        $update_data->save();
        Toastr::success('message', 'Highlight Update successfully!');
        return redirect('editor/highlight/manage');
    }
    public function inactive(Request $request){
        $Unpublished_data           =   Highlight::find($request->hidden_id);
        $Unpublished_data->status   =   0;
        $Unpublished_data->save();
        Toastr::success('message', 'Highlight inactive successfully!');
        return redirect('editor/highlight/manage');   
    }
    public function active(Request $request){
        $published_data         =   Highlight::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Highlight active successfully!');
        return redirect('editor/highlight/manage');   
    }
    public function destroy(Request $request){
        $delete_data = Highlight::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('message', 'Highlight deleted successfully!');
        return redirect('editor/highlight/manage');   
    } 

}
