<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Category;

class CategoryController extends Controller
{
    public function index(){
    	return view('backEnd.category.add');
    }
    // public function store(Request $request){
    	// $this->validate($request,[
        //     'name'=>'required',
    	// 	'status'=>'required',
    	// ]);

        // // image upload
        // $file = $request->file('image');
        // $name = time().'-'.$file->getClientOriginalName();
        // $uploadPath = 'public/uploads/category/';
        // $file->move($uploadPath,$name);
        // $fileUrl =$uploadPath.$name;

        // // Icon upload
        // $fileone = $request->file('icon');
        // if($fileone){
        // $nameone = time().'-'.$fileone->getClientOriginalName();
        // $uploadPathone = 'public/uploads/category/';
        // $fileone->move($uploadPathone,$nameone);
        // $fileUrlone =$uploadPathone.$nameone;
        // }else{
        //     $fileUrlone = NULL;
        // }

    	// $store_data                  = new Category();
    	// $store_data->name            = $request->name;
        // $store_data->image           = $fileUrl;
        // $store_data->icon            = $fileUrlone;
        // $store_data->slug            = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '',preg_replace('/\s+/', '-', $request->name)));
        // $store_data->frontProduct    = $request->frontProduct;
        // $store_data->specialCat      = $request->specialCat;
    	// $store_data->status          = $request->status;
    	// $store_data->save();
    	// Toastr::success('message', 'Category add successfully!');
    	// return redirect('/editor/category/manage');
    // }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            // Add 'image' and 'icon' validations if they are required
            // 'image' => 'required|image', 
            // 'icon' => 'image',
        ]);

        // Initialize variables
        $fileUrl = null;
        $fileUrlone = null;

        // Image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/category/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        }

        // Icon upload
        if ($request->hasFile('icon')) {
            $fileone = $request->file('icon');
            $nameone = time() . '-' . $fileone->getClientOriginalName();
            $uploadPathone = 'public/uploads/category/';
            $fileone->move($uploadPathone, $nameone);
            $fileUrlone = $uploadPathone . $nameone;
        }

        $store_data = new Category();
        $store_data->name = $request->name;
        $store_data->image = $fileUrl;
        $store_data->icon = $fileUrlone;
        $store_data->slug = strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '', preg_replace('/\s+/', '-', $request->name)));
        $store_data->frontProduct = $request->frontProduct;
        $store_data->specialCat = $request->specialCat;
        $store_data->status = $request->status;
        $store_data->save();

        Toastr::success('message', 'Category added successfully!');
        return redirect('/editor/category/manage');
    }

    public function manage(){
    	$show_data = Category::orderBy('level','ASC')->get();
    	return view('backEnd.category.manage',['show_data'=>$show_data]);
    }
    public function edit($id){
        $edit_data =   Category::find($id);
        return view('backEnd.category.edit',[
            'edit_data'=>$edit_data
        ]);
    }

    public function update(Request $request){
        $update_data           =   Category::find($request->hidden_id);

        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/category/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_imageone = $request->file('icon');
        if ($update_imageone) {
            $fileone = $request->file('icon');
            $nameone = time().'-'.$fileone->getClientOriginalName();
            $uploadPathone = 'public/uploads/category/';
            $fileone->move($uploadPathone,$nameone);
            $fileUrlone =$uploadPathone.$nameone;
        }else{
            $fileUrlone = $update_data->icon;
        }

        $update_data->name            =   $request->name;
        $update_data->slug            =   strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '',preg_replace('/\s+/', '-', $request->name)));
        $update_data->image           =   $fileUrl;
        $update_data->icon            =   $fileUrlone;
        $update_data->frontProduct    =   $request->frontProduct;
        $update_data->specialCat      =   $request->specialCat;
        $update_data->level           =   $request->hidden_id;
        $update_data->status          =   $request->status;
        $update_data->save();
        Toastr::success('message', 'Category Update successfully!');
        return redirect('editor/category/manage');
    }
    public function inactive(Request $request){
        $Unpublished_data           =   Category::find($request->hidden_id);
        $Unpublished_data->status   =   0;
        $Unpublished_data->save();
        Toastr::success('message', 'Category inactive successfully!');
        return redirect('editor/category/manage');   
    }
    public function active(Request $request){
        $published_data         =   Category::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Category active successfully!');
        return redirect('editor/category/manage');   
    }
    public function menusort($id){
        $change_level =   Category::find($id);
        return view('backEnd.category.menusort',compact('change_level'));
    }

    public function menusortupdate(Request $request){

        $update_level           =   Category::find($request->hidden_id);
        
        $update_level->name            =   $request->name;
        $update_level->slug            =   strtolower(preg_replace('/[^a-zA-Z0-9\-]/', '',preg_replace('/\s+/', '-', $request->name)));
        $update_level->image           =   $request->image;
        $update_level->icon            =   $request->icon;
        $update_level->frontProduct    =   $request->frontProduct;
        $update_level->specialCat      =   $request->specialCat;
        $update_level->level           =   $request->level;
        $update_level->status          =   $request->status;
        // return $update_level;
        $update_level->save();

        
        Toastr::success('message', 'Category Update successfully!');
        return redirect('editor/category/manage');
    }
   
}
