<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Expence;
use App\Orderdetails;
use App\Order;
use Carbon\Carbon;
use DB;
class DashboardController extends Controller
{
  public function index(Request $request){
        if($request->filter && $request->start && $request->end){
            $start = $request->start;
            $end = $request->end;
            $query = $request->filter;
        }elseif($request->filter && $request->start==NULL && $request->end==NULL){
            $query = $request->filter;
            $start = NULL;
            $end = NULL;
        }else{
            $query = 1;
            $start = NULL;
            $end = NULL;
        }
         $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
        // return $query;
        $todayexpence = Expence::whereDate('created_at',Carbon::today())->sum('ammount');
        $totalstock = Product::sum('proQuantity');
        $todaysalesamount = Orderdetails::whereDate('created_at',Carbon::today())->get()->sum(function($stotal){
                return $stotal->productPrice * $stotal->productQuantity; });
        $monthlysale = Order::select(DB::raw('DATE(created_at) as date','created_at'))->selectRaw("SUM(orderTotal) as orderTotal")->where('orderStatus',6)->groupBy('date')->limit(30)->get();
        return view('backEnd.superadmin.dashboard',compact('query','start','end','todayexpence','totalstock','todaysalesamount', 'show_data','monthlysale'));
    	
    }
}
