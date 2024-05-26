<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Category;
use App\Brand;
use App\Subcategory;
use App\Childcategory;
use App\Product;
use App\Productimage;
use App\Size;
use App\Color;
use App\Productcolor;
use App\Productsize;
use DB;
use Alert;
class ProductController extends Controller
{
	// ajax code
	public function getSubcategory(Request $request){
        $category = DB::table("subcategories")
        ->where("category_id",$request->category_id)
        ->pluck('subcategoryName','id');
        return $category;
        return response()->json($category);
    }
    public function getChildcategory(Request $request){
        $childcategory = DB::table("childcategories")
        ->where("subcategory_id",$request->category_id)
        ->pluck("childcategoryName","id");
        return response()->json($childcategory);
    }
	// ajax code
    public function add(){
    	$categories=Category::where('status',1)->get();
        $productSize = Size::where('status',1)->get();
        $productColors = Color::where('status',1)->get();
        $productBrand = Brand::where('status',1)->get();
    	return view('backEnd.product.add',compact('categories','productSize','productColors','productBrand'));
    }
     public function store(Request $request){
        $this->validate($request,[
            'proCategory'		=>	'required',
            'proName'			=>	'required',
    		'proPurchaseprice'	=>	'required',
    		'proNewprice'		=>	'required',
    		'image'				=>	'required',
    		'deliveryarea'    	=>	'required',
    		'proDescription'	=>	'required',
    		'status'		    =>	'required',
    		'pdate'		    =>	'required',

    	]);

    	$store_data           	 		  = 	new Product();
    	$store_data->proCategory      	  = 	$request->proCategory;
    	$store_data->proSubcategory  	  = 	$request->proSubcategory;
    	$store_data->proChildcategory 	  = 	$request->proChildcategory;
        $store_data->proBrand             =     $request->proBrand;
        $store_data->proShop              =     $request->proShop;
    	$store_data->proName  			  = 	$request->proName;
    	$store_data->proCode    		  = 	rand(111111, 999999);
    	$store_data->slug  			      = 	strtolower(preg_replace('/\s+/', '-', $request->proName));
    	$store_data->proPurchaseprice  	  = 	$request->proPurchaseprice;
    	$store_data->proOldprice  		  = 	$request->proOldprice;
    	$store_data->proNewprice  		  = 	$request->proNewprice;
    	$store_data->proDescription       = 	$request->proDescription;
        $store_data->shortDescription     =     $request->shortDescription;
    	$store_data->proQuantity    	  = 	$request->proQuantity;
    	$store_data->maxqty               =     $request->maxqty;
    	$store_data->unit    	          = 	$request->unit;
        $store_data->flashdeal            =     $request->flashdeal;
        $store_data->aditionalshipping    =     $request->aditionalshipping;
        $store_data->deliveryarea         =     $request->deliveryarea;
        $store_data->pdate                =     $request->pdate;
        $store_data->homedelivery         =     $request->homedelivery;
        $store_data->video                =     $request->video;
        $store_data->returnwarranty       =     $request->returnwarranty;
        $store_data->topSell              =     $request->topSell;
        $store_data->warranty             =     $request->warranty;
        $store_data->video                =     $request->video;
        $store_data->featured             =     $request->featured;
    	$store_data->status    		      = 	$request->status;
    	$store_data->save();

        $productId=$store_data->id;
        $images = $request->file('image');
        foreach($images as $image)
        {
           // image01 upload
            $name =  time().'-'.$image->getClientOriginalName();
            $uploadpath = 'public/uploads/product/';
            $image->move($uploadpath, $name);
            $imageUrl = $uploadpath.$name;  

            $proimage= new Productimage();
            $proimage->product_id = $productId;
            $proimage->image=$imageUrl;
            $proimage->save(); 
        }
        
        $store_data->sizes()->attach($request->proSize);
        $store_data->colors()->attach($request->proColor);


    	Toastr::success('message', 'Product information upload successfully!');
    	return redirect('/editor/product/add');
        }
     public function manage(){
     	$show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
        $productimage = DB::table('productimages')
        ->join('products','productimages.product_id','=','products.id')
        ->select('products.proName','productimages.*')
        ->orderBy('productimages.id','DESC')
        ->get();
     	return view('backEnd.product.manage',compact('show_data','productimage'));
     }
     public function edit($id){
     	$edit_data = Product::find($id);

     	$productimage = DB::table('productimages')
        ->join('products','productimages.product_id','=','products.id')
        ->select('products.proName','productimages.*')
        ->orderBy('productimages.id','DESC')
        ->get();

     	$category=Category::where('status',1)->get();
        $categoryId = Product::find($id)->proCategory;
        $subcategory = Subcategory::where('category_id','=',$categoryId)->get();
        $subcategoryId=Product::find($id)->proSubcategory;
        $childcategory = Childcategory::where('subcategory_id','=',$subcategoryId)->get();

        $probrand = Brand::where('status',1)->get();
        $totalsizes = Size::where('status',1)->get();
        $totalcolors = Color::where('status',1)->get();
        $selectcolors = Productcolor::where('product_id',$id)->get();
        $selectsizes = Productsize::where('product_id',$id)->get();

        return view('backEnd.product.edit',compact('category','subcategory','edit_data','productimage','childcategory','totalsizes','totalcolors','selectcolors','selectsizes','probrand'));
     }
     public function update(Request $request){
            $this->validate($request,[
                'proCategory'           =>  'required',
                'proName'               =>  'required',
                'proPurchaseprice'      =>  'required',
                'proNewprice'           =>  'required',
                'proDescription'        =>  'required',
                'deliveryarea'          =>  'required',
                'status'                =>  'required',

            ]);
     	$update_data = Product::find($request->hidden_id);

    	$update_data->proCategory          =     $request->proCategory;
        $update_data->proSubcategory       =     $request->proSubcategory;
        $update_data->proChildcategory     =     $request->proChildcategory;
        $update_data->proShop              =     $request->proShop;
        $update_data->proName              =     $request->proName;
        $update_data->proCode              =     rand(111111, 999999);
        $update_data->proBrand             =     $request->proBrand;
        $update_data->slug                 =     strtolower(preg_replace('/\s+/', '-', $request->proName));
        $update_data->proPurchaseprice     =     $request->proPurchaseprice;
        $update_data->proOldprice          =     $request->proOldprice;
        $update_data->proNewprice          =     $request->proNewprice;
        $update_data->proDescription       =     $request->proDescription;
        $update_data->shortDescription     =     $request->shortDescription;
        $update_data->proQuantity          =     $request->proQuantity;
        $update_data->maxqty               =     $request->maxqty;
        $update_data->unit                 =     $request->unit;
        $update_data->flashdeal            =     $request->flashdeal;
        $update_data->aditionalshipping    =     $request->aditionalshipping;
        $update_data->deliveryarea         =     $request->deliveryarea;
        $update_data->pdate                =     $request->pdate;
        $update_data->homedelivery         =     $request->homedelivery;
        $update_data->video                =     $request->video;
        $update_data->returnwarranty       =     $request->returnwarranty;
        $update_data->topSell              =     $request->topSell;
        $update_data->warranty             =     $request->warranty;
        $update_data->video                =     $request->video;
        $update_data->featured             =     $request->featured;
        $update_data->status               =     $request->status;
    	$update_data->save(); 

    	$productId=$update_data->id;
    	$update_images=Productimage::where('product_id',$productId)->get();
		$images = $request->file('image');
		if($images){
	        foreach($images as $image)
		        {
		           // image01 upload
		        $name =  time().'-'.$image->getClientOriginalName();
		        $uploadpath = 'public/uploads/product/';
		        $image->move($uploadpath, $name);
		        $imageUrl = $uploadpath.$name;	

	             $proimage= new Productimage();
		         $proimage->product_id = $productId;
		         $proimage->image=$imageUrl;
		         $proimage->save(); 
		        }
        }else{
        	foreach($update_images as $update_image){
        	$uimage=$update_image->image;
        	$update_image->image 	=	$uimage;
			$update_image->save();
        	}
        }
        $update_data->sizes()->sync($request->proSize);
        $update_data->colors()->sync($request->proColor);
       
    	Toastr::success('message', 'Product information update successfully!');
    	return redirect('/editor/product/manage');
     }
      public function inactive(Request $request){
		$Unpublished_data			=	Product::find($request->hidden_id);
		$Unpublished_data->status 	=	0;
		$Unpublished_data->save();
		Toastr::success('message', 'Product unpublished successfully!');
		return redirect('editor/product/manage');	
	}
	public function active(Request $request){
		$published_data			=	Product::find($request->hidden_id);
		$published_data->status 	=	1;
		$published_data->save();
		Toastr::success('message', 'Product published successfully!');
		return redirect('editor/product/manage');	
	}
     public function productimgdel($id){
        $delete_img = Productimage::find($id);
        $delete_img->delete();
        Toastr::success('message', 'advertisments image  delete successfully!');
        return redirect()->back();
    }
	public function destroy(Request $request){
		$delete_data = Product::find($request->hidden_id);
		$delete_data->delete();
		Toastr::success('message', 'Product delete successfully!');
		return redirect('editor/product/manage');	
	}
    
}
