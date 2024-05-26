<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Logo;
use App\Product;
use App\Brand;
use App\Seller;
use App\Customer;
use App\District;
use App\Area;
use App\Productimage;
use App\Pagecategory;
use App\Socialmedia;
use App\Blogcategory;
use App\Createpage;
use App\Ordertype;
use App\Comment;
use App\Contact;
use App\Expencecategory;
use App\Deliveryman;
use App\Ticket;
use App\Generalsetting;
use DB;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        // main logo here
            $mainlogo=Logo::where('status',1)->orderBy('id','DESC')->limit(1,0)->get(); 
            view()->share(compact('mainlogo'));
            // mainlogo
            $categories = Category::where('status',1)->orderBy('level')->get();
            view()->share(compact('categories'));
            // category
            $contactinfoes = Contact::where('status',1)->get();
            view()->share(compact('contactinfoes'));
            // category
            $frontcategories = Category::where(['status'=>1,'frontProduct'=>1])->get();
            view()->share(compact('frontcategories'));
            // Front category
            $hcategories = Category::where('status',1)->orderBy('id','ASC')->get();
            view()->share(compact('hcategories'));
            // category
            $sidebarmenu = Category::where('status',1)->get();
            view()->share(compact('sidebarmenu'));
            // brand
            $brands = Brand::where('status',1)->get();
            view()->share(compact('brands'));
            // product image
            $productimage =Productimage::orderBy('id','DESC')
            ->get();
             view()->share(compact('productimage'));
            // district
             $districts = District::where('status',1)->get();
             view()->share(compact('districts'));
             // area
            $areas = Area::where('status',1)->get();
             view()->share(compact('areas'));
             // all page
             $allpage = Createpage::where(['status'=>1])->get();
            view()->share(compact('allpage'));
            // footrleftmenu
            $footermenuleft = Pagecategory::where(['status'=>1,'menu_id'=>1])->get();
            view()->share(compact('footermenuleft'));
            // footerrightmenu
            $footermenuright = Pagecategory::where(['status'=>1,'menu_id'=>2])->get();
            view()->share(compact('footermenuright'));
            // social icon
            $socialicons = Socialmedia::where(['status'=>1])-> orderBy('id','DESC')->get();
            view()->share(compact('socialicons'));
            // Blog Categories 
            $ordertypes = Ordertype::get();
            view()->share(compact('ordertypes'));
            // order type
            $expencetypes = Expencecategory::where('status',1)->get();
            view()->share(compact('expencetypes'));
            $deliveryman = Deliveryman::where('status', 1)->get();
            view()->share(compact('deliveryman'));
            // order type 
            $pendingtickets=Ticket::where('status',1)->orderBy('id','DESC')->count();
            view()->share(compact('pendingtickets'));
            $closetickets=Ticket::where('status',0)->orderBy('id','DESC')->count();
            view()->share(compact('closetickets'));
            // general settings
            $generalInfoes = Generalsetting::where('status', 1)->get();
            view()->share(compact('generalInfoes'));
            // unseen comments
            $unseencomments=Comment::where('status',0)->orderBy('id','DESC')->get();
            view()->share(compact('unseencomments'));
            $allcomments=Comment::orderBy('id','DESC')->get();
            view()->share(compact('allcomments'));
    }
}
