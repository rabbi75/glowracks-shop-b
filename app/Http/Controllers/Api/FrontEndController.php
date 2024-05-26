<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logo;
use App\Category;
use App\Subcategory;
use App\Childcategory;
use App\Slider;
use App\Product;
use App\Advertisement;
use App\Brand;
use App\Contact;
use App\Pagecategory;
use App\Socialmedia;
use App\Review;
use App\Comment;
use App\Createpage;
use App\Blog;
use App\Blogcategory;
use App\Highlight;
use App\Order;
use App\District;
use App\Area;
use App\Couponcode;
use App\Productcolor;
use App\Productsize;
use App\Productimage;
use App\Seller;
use App\Clientfeedback;
use App\Gallery;
use App\Document;
use App\Generalsetting;
use Carbon\Carbon;
use Auth;
use Response;
use Cart;
use DB;
class FrontEndController extends Controller
{
    // Config Data
    public function logo()
    {
        $logo = Logo::latest()->get();
        return response()->json(compact('logo'), 200);
    }

    // Main Page Start
    public function index()
    {
        $frontcategories = Category::where(['frontProduct' => 1, 'status' => 1])
            ->orderBy('level')
            ->limit(6)
            ->with(['products', 'products.image'])
            ->get()
            ->map(function ($query) {
                $query->setRelation('products', $query->products->take(6));
                return $query;
            });
        $specialcat = Category::where(['specialCat' => 1, 'status' => 1])
            ->orderBy('level')
            ->limit(1)
            ->with(['products', 'products.image'])
            ->get()
            ->map(function ($query) {
                $query->setRelation('products', $query->products->take(6));
                return $query;
            });
        return response()->json(compact('frontcategories', 'specialcat'), 200);
    }
    public function home (){
         $sliders = Slider::where(['status'=>1, 'type'=> 1])->select('id','image')->get();
         $slidermobile = Slider::where(['status'=>1, 'type'=> 2])->select('id', 'image')->get();
         $latests = Product::where(['status' => 1])
        ->where('proQuantity', '>', 0)
        ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
        ->orderBy('id','DESC')
        ->with('image')
        ->limit(6)
        ->get();
        $currentdata = Carbon::now()->format('Y-m-d');
        $flashdeal = Product::where(['status' => 1])
            ->where('flashdeal', '>=', $currentdata)
            ->select('id','slug','proName','proOldprice','proNewprice','proQuantity', 'flashdeal')
            ->orderBy('id','DESC')
            ->with('image')
            ->limit(4)
            ->get();
        $homeallproducts = Product::where(['status' => 1])
            ->orderBy('id', 'DESC')
            ->with('image')
            ->limit(6)
            ->get();
        
        return response()->json(compact('sliders', 'slidermobile', 'latests', 'flashdeal', 'homeallproducts'),200);
    }
     public function hometopsell(){
        $topsell = Product::where(['topSell' => 1, 'status' => 1])
            ->where('proQuantity', '>', 0)
            ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
            ->with('image')
            ->limit(6)
            ->get();
        return response()->json(compact('topsell'), 200);
    }
  
     public function alltopsells(){
        $products = Product::where(['status' => 1, 'topSell' => 1,])
        ->where('proQuantity', '>', 0)
        ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
        ->orderBy('id','DESC')
        ->with('image')
        ->get();
        return response()->json(compact('products'), 200);
    }
     public function allnewarrival(){
        $products = Product::where(['status' => 1])
        ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
        ->orderBy('id','DESC')
        ->with('image')
        ->get();
        return response()->json(compact('products'), 200);
    }
     public function allflashdeal (Request $request){
        $currentdata = Carbon::now()->format('Y-m-d');
        $paginate = $request->show?$request->show:10;
        if (isset($request->sort) && empty($request->minprice)) {
            // sorting code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('flashdeal', '>=', $currentdata)
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('flashdeal', '>=', $currentdata)
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('flashdeal', '>=', $currentdata)
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            }
        }elseif ($request->minprice && $request->maxprice) {
            // min price - max price code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('flashdeal', '>=', $currentdata)
                    ->orderBy('proNewprice', 'DESC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('flashdeal', '>=', $currentdata)
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('flashdeal', '>=', $currentdata)
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            }
        } else {
            $products = Product::where(['status' => 1])
                ->where('flashdeal', '>=', $currentdata)
                ->select('id','slug','proName','proOldprice','proNewprice','proQuantity', 'flashdeal')
                ->orderBy('id','DESC')
                ->with('image')
                ->paginate($paginate);
        }

        return response()->json(compact('products'), 200);
    }
     
     public function homeFeatured(){
        $features = Product::where(['featured' => 1, 'status' => 1])
            ->where('proQuantity', '>', 0)
            ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
            ->with('image')
            ->limit(12)
            ->get();
        return response()->json(compact('features'), 200);
    }
     public function homeLatest(){
        $latests = Product::where(['status' => 1])
        ->where('proQuantity', '>', 0)
        ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
        ->orderBy('id','DESC')
        ->with('image')
        ->limit(6)
        ->get();
        return response()->json(compact('latests'), 200);
    }
     public function flashDeal(){
        $currentdata = Carbon::now()->format('Y-m-d');
        $flashdeal = Product::where(['status' => 1])
            ->where('flashdeal', '>=', $currentdata)
            ->select('id','slug','proName','proOldprice','proNewprice','proQuantity', 'flashdeal')
            ->orderBy('id','DESC')
            ->with('image')
            ->limit(6)
            ->get();
        return response()->json(compact('flashdeal'), 200);
    }

    public function clientfeedback()
    {
        $feedbacks = Clientfeedback::where('status',1)->limit(10)->get();
        return response()->json(compact('feedbacks'), 200);
    }
    public function allfeedback()
    {
        $feedbacks = Clientfeedback::where('status',1)->get();
        return response()->json(compact('feedbacks'), 200);
    }
    public function gallery()
    {
        $galleris = Gallery::where('status',1)->get();
        return response()->json(compact('galleris'), 200);
    }
    public function sliders()
    {
        $sliders = Slider::where('status', 1)->select('id','image')->get();
        return response()->json(compact('sliders'),200);
    }
    public function category(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        $paginate = $request->show?$request->show:10;
        if (isset($request->sort) && empty($request->minprice)) {
            // sorting code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1, 'proCategory' => $category->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1, 'proCategory' => $category->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1, 'proCategory' => $category->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            }
        }elseif ($request->minprice && $request->maxprice) {
            // min price - max price code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1, 'proCategory' => $category->id])
                    ->orderBy('proNewprice', 'DESC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1, 'proCategory' => $category->id])
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1, 'proCategory' => $category->id])
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            }
        } else {
            $products = Product::where(['status' => 1, 'proCategory' => $category->id])
                ->where('proQuantity', '>', 0)
                ->orderBy('id', 'DESC')
                ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                ->with('image')
                ->paginate($paginate);
        }
        $subcategories = Subcategory::where(['category_id' => $category->id, 'status' => 1])
            ->withCount('productcount')
            ->get();
        return response()->json(compact('products', 'category', 'subcategories'));
    }

    public function brands()
    {
        $brands = Brand::where('status', 1)->get();
        return response()->json(compact('brands'), 200);
    }

    public function sidebar()
    {
        $sidecategories = Category::where('status', 1)
            ->with('subcategories', 'subcategories.childcategories')
            ->get();
        return response()->json(compact('sidecategories'), 200);
    }
    public function subcategory(Request $request, $slug)
    {
        $subcategory = Subcategory::where('slug', $slug)->first();        
        $paginate = $request->show?$request->show:10;

        if (isset($request->sort) && empty($request->minprice)) {
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1, 'proSubcategory' => $subcategory->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1, 'proSubcategory' => $subcategory->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('products.id', 'ASC')
                    ->select('products.*')
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1, 'proSubcategory' => $subcategory->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('products.proName', 'ASC')
                    ->select('products.*')
                    ->orderBy('id', 'DESC')
                    ->with('image')
                    ->paginate(40);
            }
        } elseif ($request->minprice && $request->maxprice) {
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1, 'proSubcategory' => $subcategory->id])
                ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->select('products.*')
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1, 'proSubcategory' => $subcategory->id])
                    ->orderBy('proNewprice', 'ASC')
                    ->select('products.*')
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1, 'proSubcategory' => $subcategory->id])
                    ->orderBy('proNewprice', 'ASC')
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            }
        } else {
            $products = Product::where(['status' => 1, 'proSubcategory' => $subcategory->id])
            ->where('proQuantity', '>', 0)
                ->orderBy('id', 'DESC')
                ->with('image')
                ->paginate($paginate);
        }
        $categories = Category::where('status', 1)->get();
        return response()->json(compact('products', 'subcategory', 'categories'));
    }
    public function products(Request $request, $slug, $id)
    {
        $childcategory = Childcategory::where(['id'=>$id])->first();
        $paginate = $request->show?$request->show:10;

        if (isset($request->sort) && empty($request->minprice)) {
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1, 'proChildCategory' => $subcategory->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1, 'proChildCategory' => $subcategory->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('products.id', 'ASC')
                    ->select('products.*')
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1, 'proChildCategory' => $subcategory->id])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('products.proName', 'ASC')
                    ->select('products.*')
                    ->orderBy('id', 'DESC')
                    ->with('image')
                    ->paginate(40);
            }
        } elseif ($request->minprice && $request->maxprice) {
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1, 'proChildCategory' => $subcategory->id])
                ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->select('products.*')
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1, 'proChildCategory' => $subcategory->id])
                    ->orderBy('proNewprice', 'ASC')
                    ->select('products.*')
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1, 'proChildCategory' => $subcategory->id])
                    ->orderBy('proNewprice', 'ASC')
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            }
        } else {
            $products = Product::where(['status' => 1, 'proChildCategory' => $subcategory->id])
            ->where('proQuantity', '>', 0)
                ->orderBy('id', 'DESC')
                ->with('image')
                ->paginate($paginate);
        }
        $sort = $request->sort;
        return response()->json(compact('products', 'childcategory', 'sort'));
    }
    
    public function childcatcolors($slug){
        $colors = Childcategory::where('slug',$slug)->first()->childcatcolors()->get();
         return response()->json(compact('colors'));  
    }
    public function childcatsizes($slug){
        $sizes = Childcategory::where('slug',$slug)->first()->childcatsizes()->get();
         return response()->json(compact('sizes'));  
    }
    
    public function offerproduct(Request $request)
    {
        if (isset($request->sort)) {
            // sorting code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                    ->whereNotNull('proOldprice')
                    ->orderBy('id', 'DESC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                    ->whereNotNull('proOldprice')
                    ->orderBy('id', 'ASC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 3) {
                $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                    ->whereNotNull('products.proOldprice')
                    ->orderBy('proNewprice', 'DESC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 4) {
                $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                    ->whereNotNull('products.proOldprice')
                    ->orderBy('proNewprice', 'ASC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 5) {
                $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                    ->whereNotNull('products.proOldprice')
                    ->orderBy('proName', 'DESC')
                    ->with('image')
                    ->paginate(40);
            } else {
                $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                    ->whereNotNull('products.proOldprice')
                    ->orderBy('proName', 'ASC')
                    ->with('image')
                    ->paginate(40);
            }
        } elseif ($request->minprice && $request->maxprice) {
            $products = Product::where(['status' => 1])
            ->where('proQuantity', '>', 0)
                ->whereNotNull('products.proOldprice')
                ->orderBy('proNewprice', 'ASC')
                ->where('proNewprice', '<=', $request->maxprice)
                ->where('proNewprice', '>', $request->minprice)
                ->with('image')
                ->paginate(40);
        } else {
            $products = Product::where(['status' => 1])
            ->where('proQuantity', '>', 0)
                ->whereNotNull('products.proOldprice')
                ->orderBy('id', 'DESC')
                ->with('image')
                ->paginate(40);
        }
        $brands = Brand::where('status', 1)->get();
        return response()->json(compact('products', 'brands'));
    }
    public function combo(Request $request)
    {
        if (isset($request->sort)) {
            // sorting code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1, 'combo' => 1])
                ->where('proQuantity', '>', 0)
                    ->orderBy('id', 'DESC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1, 'combo' => 1])
                ->where('proQuantity', '>', 0)
                    ->orderBy('id', 'ASC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 3) {
                $products = Product::where(['status' => 1, 'combo' => 1])
                ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 4) {
                $products = Product::where(['status' => 1, 'combo' => 1])
                ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')
                    ->with('image')
                    ->paginate(40);
            } elseif ($request->sort == 5) {
                $products = Product::where(['status' => 1, 'combo' => 1])
                ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'DESC')
                    ->with('image')
                    ->paginate(40);
            } else {
                $products = Product::where(['status' => 1, 'combo' => 1])
                ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'ASC')
                    ->with('image')
                    ->paginate(40);
            }
        } elseif ($request->minprice && $request->maxprice) {
            $products = Product::where(['status' => 1, 'combo' => 1])
            ->where('proQuantity', '>', 0)
                ->orderBy('proNewprice', 'ASC')
                ->where('proNewprice', '<=', $request->maxprice)
                ->where('proNewprice', '>', $request->minprice)
                ->with('image')
                ->paginate(40);
        } else {
            $products = Product::where(['status' => 1, 'combo' => 1])
            ->where('proQuantity', '>', 0)
                ->orderBy('id', 'DESC')
                ->with('image')
                ->paginate(40);
        }
        return response()->json(compact('products'));
    }
    public function contact()
    {
        $socialicons = Socialmedia::where(['status' => 1])
            ->orderBy('id', 'DESC')
            ->get();
        $contact = Contact::where('status', 1)->get();
        return response()->json(compact('contact', 'socialicons'));
    }
    // advertisement under all products
    public function topbanner()
    {
        $topbanner = Advertisement::where(['status' => 1, 'adcategory_id' => 1])
            ->orderBy('id', 'DESC')
            ->limit(2)
            ->get();
        return response()->json(compact('topbanner'));
    }
    public function aboutcompany()
    {
        $footermenuleft = Pagecategory::where(['status' => 1, 'menu_id' => 1])->get();
        $footermenuright = Pagecategory::where(['status' => 1, 'menu_id' => 2])->get();
        return response()->json(compact('footermenuleft', 'footermenuright'));
    }

    public function categorylist()
    {
        $categorylists = Category::where(['status' => 1])
            ->orderBy('level', 'ASC')
            ->with('subcategories', 'subcategories.childcategories')
            ->get();
        return response()->json(compact('categorylists'));
    }

    public function allcategory()
    {
        $categories = Category::where(['status' => 1])
            ->orderBy('level', 'ASC')
            ->with('subcategories', 'subcategories.childcategories')
            ->withCount('products')
            ->get();
        return response()->json(compact('categories'));
    }
    
    public function onlycategory()
    {
        $onlycategories = Category::where(['status' => 1])
            ->orderBy('level', 'ASC')
            ->get();
        return response()->json(compact('onlycategories'));
    }
  

    public function brandproduct(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        $paginate = $request->show?$request->show:10;
        if (isset($request->sort) && empty($request->minprice)) {
            // sorting code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('proBrand', $brand->id)
                    ->whereNotNull('proOldprice')
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('proBrand', $brand->id)
                    ->whereNotNull('proOldprice')
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('proBrand', $brand->id)
                    ->whereNotNull('proOldprice')
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            }
        }elseif ($request->minprice && $request->maxprice) {
            // min price - max price code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('proBrand', $brand->id)
                    ->whereNotNull('proOldprice')
                    ->orderBy('proNewprice', 'DESC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('proBrand', $brand->id)
                    ->whereNotNull('proOldprice')
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('proBrand', $brand->id)
                    ->whereNotNull('proOldprice')
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            }
        } else {
            $products = Product::where(['status' => 1])
                ->where('proBrand', $brand->id)
                ->whereNotNull('proOldprice')
                ->select('id','slug','proName','proOldprice','proNewprice','proQuantity', 'flashdeal')
                ->orderBy('id','DESC')
                ->with('image')
                ->paginate($paginate);
        }

        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where('status', 1)->get();
        return response()->json(compact('products', 'categories', 'brands', 'brand'));
    }

    public function allproduct(Request $request)
    {
        $paginate = $request->show?$request->show:10;
        if (isset($request->sort) && empty($request->minprice)) {
            // sorting code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'ASC')
                    ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
                    ->with('image')
                    ->paginate($paginate);
            }
        }elseif ($request->minprice && $request->maxprice) {
            // min price - max price code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')                    
                    ->where('proNewprice', '<=', $request->maxprice)
                    ->where('proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            }
        } else {
            $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                ->orderBy('id', 'DESC')
                ->with('image')
                ->paginate($paginate);
        }
        
        return response()->json(compact('products'));
    }
    public function details($slug)
    {
        $details = Product::where(['status' => 1, 'products.slug' => $slug])
            ->with('category','brand', 'subcategory', 'childCategory')
            ->first();
        $images = Productimage::where('product_id',$details->id)->get();
     
        if ($details) {
            return response()->json(compact('details','images'));
        } else {
            return response()->json('error', 'Something wrong');
        }
    }

    public function relatedProduct($slug){
        $products_id = Product::select('proCategory')->where('slug',$slug)->first();
        $relatedproduct = Product::where(['status'=>1, 'proCategory'=>$products_id->proCategory])
            ->select('id','slug','proName','proQuantity','proOldprice','proNewprice','proQuantity')
            ->withCount('reviews')->limit(12)->with('image')->get();
        $recomandproduct = Product::where(['status'=>1, 'proCategory'=>$products_id->proCategory])
            ->select('id','slug','proName','proQuantity','proOldprice','proNewprice','proQuantity')
            ->withCount('reviews')->limit(4)->with('image')->get();
        return response()->json(compact('relatedproduct','recomandproduct'));
    }
    
    
    public function proreview($slug){
        $product_id = Product::where('slug',$slug)->first()->id;
        $reviews = Review::where(['product_id'=>$product_id])->with('customer')->get();
            return response()->json(compact('reviews'),200);
    }
    public function procolor($slug){
        $product_id = Product::where('slug',$slug)->first()->id;
        $colors = Productcolor::where(['product_id'=>$product_id])->with('color')->get();
            return response()->json(compact('colors'),200);
    }
    public function prosize($slug){
        $product_id = Product::where('slug',$slug)->first()->id;
        $sizes = Productsize::where(['product_id'=>$product_id])->with('size')->get();
            return response()->json(compact('sizes'),200);
    }
    public function procomment($id){
        $comments = Comment::where(['product_id'=>$id])->with('customer')->get();
            return response()->json(compact('comments'),200);
    }
    public function morepage($slug)
    {
        $pagecategory = Pagecategory::where('slug', $slug)->first();
        $content = Createpage::where(['page_id' => $pagecategory->id, 'status' => 1])->first();
        return response()->json(compact('content'));
    }
    public function search(Request $request, $keyword)
    {            
        $paginate = $request->show ? $request->show : 10;        
        if (isset($request->sort) && empty($request->minprice)) {
            // sorting code
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->where('proName', 'LIKE', '%' . $keyword . "%")
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')
                    ->where('proName', 'LIKE', '%' . $keyword . "%")
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'ASC')
                    ->where('proName', 'LIKE', '%' . $keyword . "%")
                    ->with('image')
                    ->paginate($paginate);
            }
        } elseif ($request->minprice && $request->maxprice) {
            if ($request->sort == 1) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'DESC')
                    ->where('proName', 'LIKE', '%' . $keyword . "%")
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } elseif ($request->sort == 2) {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proNewprice', 'ASC')
                    ->where('proName', 'LIKE', '%' . $keyword . "%")
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            } else {
                $products = Product::where(['status' => 1])
                    ->where('proQuantity', '>', 0)
                    ->orderBy('proName', 'ASC')
                    ->where('proName', 'LIKE', '%' . $keyword . "%")
                    ->where('products.proNewprice', '<=', $request->maxprice)
                    ->where('products.proNewprice', '>', $request->minprice)
                    ->with('image')
                    ->paginate($paginate);
            }
        } else {
            $products = Product::where(['status' => 1])
                ->where('proQuantity', '>', 0)
                ->orderBy('id', 'DESC')
                ->where('proName', 'LIKE', '%' . $keyword . "%")
                ->with('image')
                ->paginate($paginate);
        }
        $categories = Category::where('status', 1)->get();
        return response()->json(compact('products', 'categories'));
    }
    public function blogcategories()
    {
        $blogcategories = Blogcategory::where('status', 1)->withCount('blogs')->get();
        return response()->json(compact('blogcategories'));
    }
    public function blog()
    {
        $blogs = Blog::where('status', 1)
            ->latest()
            ->get();
        return response()->json(compact('blogs'));
    }
    public function latestblog()
    {
        $latestblog = Blog::where('status', 1)
            ->latest()
            ->limit(4)
            ->get();
        return response()->json(compact('latestblog'));
    }
    public function blogcategory($id, $slug)
    {
        $blogcat = Blogcategory::where('id', $id)->first();
        $blogs = Blog::where(['status' => 1, 'blogcategory_id' => $id])->get();
        return response()->json(compact('blogs', 'blogcat'));
    }
    public function blogdetails($id, $slug)
    {
        $details = Blog::where(['id'=> $id ])->with('blogcategory')->first();
        return response()->json(compact('details'), 200);
    }
    public function orderTrack(Request $request)
    {
        $this->validate($request, [
            'track_id' => 'required',
        ]);
        $orderfinds = Order::where('trackingId', $request->track_id)
            ->with('ordertype')
            ->first();
        if ($orderfinds) {
            return response()->json(['status' => 'success', 'orderstatus' => $orderfinds->ordertype->name, 'trackId' => $orderfinds->trackingId]);
        } else {
            return response()->json(['status' => 'error'], 402);
        }
    }
    
    public function districts()
    {
        $districts = District::where('status', 1)
            ->orderBy('name', 'ASC')
            ->get();
        return response()->json(compact('districts'), 200);
    }
    public function areas($district_id)
    {
        $areas = Area::where(['status' => 1, 'district_id' => $district_id])->get();
        return response()->json(compact('areas'), 200);
    }
    public function shippingfee($area_id)
    {
        $shippingfee = Area::find($area_id);
        return response()->json(compact('shippingfee'), 200);
    }

    public function coupon()
    {
        $couponcodes = Couponcode::where('status', 1)->get();
        return response()->json(compact('couponcodes'));
    }
    public function allshops()
    {
        $allshops = Seller::where('status', 1)->get();
        return response()->json(compact('allshops'));
    }
    public function shopspro(Request $request, $slug)
    {
        $shops = Seller::where('slug', $slug)->first();
        $products = Product::where(['status' => 1])
            ->where('proShop', $shops->id)
            ->whereNotNull('proOldprice')
            ->orderBy('id', 'DESC')
            ->with('image')
            ->paginate(40);

        return response()->json(compact('products', 'shops'));
    }

    public function modalproduct($id){
        $modalproduct = Product::where(['status' => 1, 'id' => $id])
            ->withCount('reviews')
            ->with('brand','images')
            ->withCount('reviews')
            ->first();
            return response()->json(compact('modalproduct'));        
    }

    public function config()
    {
        $config = Generalsetting::where('status', 1)->get();

        return response()->json(compact('config'));
    }

    public function highlight()
    {
        $highlight = Highlight::where('status', 1)->orderBy('serial', 'ASC')->get();
        return response()->json(compact('highlight'));
    }
    public function documents()
    {
        $documents = Document::where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json(compact('documents'));
    }
}
