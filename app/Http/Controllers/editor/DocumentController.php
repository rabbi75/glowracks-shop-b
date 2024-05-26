<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Document;
use File;

class DocumentController extends Controller
{
    public function index(){
    	return view('backEnd.document.add');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'file'=>'required',
    		'status'=>'required',
    	]);

    	// file upload
    	$file = $request->file('file');
    	$name = time().'-'.$file->getClientOriginalName();
    	$uploadPath = 'public/uploads/document/';
    	$file->move($uploadPath,$name);
    	$fileUrl =$uploadPath.$name;

    	$store_data = new Document();
    	$store_data->content     =  $request->content;
    	$store_data->file        =  $fileUrl;
    	$store_data->status      =  $request->status;
    	$store_data->save();
        Toastr::success('message', 'Document add successfully!');
    	return redirect('/editor/document/manage');
    }
    public function manage(){
    	$show_data = Document::orderBy('id','DESC')->get();
        return view('backEnd.document.manage', [
            'show_data'=> $show_data,
        ]);
    }
    public function edit($id){
        $edit_data = Document::find($id);
        return view('backEnd.document.edit', ['edit_data'=>$edit_data]);
    }
     public function update(Request $request){
        $this->validate($request,[
            'status'=>'required',
        ]);

        $update_data = Document::find($request->hidden_id);

        $update_file = $request->file('file');
        if ($update_file) {
           $file = $request->file('file');
            File::delete(public_path() . 'public/uploads/document', $update_data->file); 
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/document/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->file;
        }
        
        $update_data->content     =  $request->content;
        $update_data->file       =  $fileUrl;
        $update_data->status      =  $request->status;
        $update_data->save();
        Toastr::success('message', 'Document update successfully!');
        return redirect('/editor/document/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Document::find($request->hidden_id);
        $unpublish_data->status = 0;
        $unpublish_data->save();
        Toastr::success('message', 'Document inactive successfully!');
        return redirect('/editor/document/manage');
    }

    public function active(Request $request){
        $publishId = Document::find($request->hidden_id);
        $publishId->status = 1;
        $publishId->save();
        Toastr::success('message', 'Document active successfully!');
        return redirect('/editor/document/manage');
    }
    public function destroy(Request $request){
        $delete_data = Document::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/document', $delete_data->file); 
        $delete_data->delete();
        Toastr::success('message', 'Document delete successfully!');
        return redirect('/editor/document/manage');
    }
}
