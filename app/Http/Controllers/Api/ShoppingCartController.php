<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Wishlist;
use App\Compare;
use DB;
use Response;
class ShoppingCartController extends Controller
{
    // Shopping Cart
    public function cartshow(Request $request)
    {
       $customer_id = getallheaders()['customer_id'];
       return Cart::with('product','product.image')
            ->where('customer_id',$customer_id) 
            ->orderBy('created_at', 'desc')
            ->get();
    }
    //  Check Out
    public function checkout(Request $request)
    {
       $customer_id = getallheaders()['customer_id'];
       return Cart::with('product','product.image')
            ->where('customer_id',$customer_id) 
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function detailscart(Request $request)
    {
        $customer_id = getallheaders()['customer_id'];
        $item = Cart::where(['product_id'=>$request->product_id,
            'customer_id'=>$customer_id]);
        if ($item->count()) {
            $item->increment('quantity');
            $item = $item->first();
        } else {
            $item = Cart::forceCreate([
                'product_id'    => $request->product_id,
                 'product_size'  => $request->product_size?$request->product_size:'R',
                'product_color' => $request->product_color?$request->product_color:'R',
                'customer_id'   => $customer_id,
                'quantity'      => $request->quantity?$request->quantity:1,
            ]);
        }
        return response()->json([
            'status' => 'success',
            'quantity' => $item->quantity,
            'product' => $item->product
        ],200);
    }
    public function cartstore(Request $request)
    {
        $customer_id = getallheaders()['customer_id'];
        $item = Cart::where(['product_id'=>$request->product_id,
            'customer_id'=>$customer_id]);
        if ($item->count()) {
            $item->increment('quantity');
            $item = $item->first();
        } else {
            $item = Cart::forceCreate([
                'product_id'    => $request->product_id,
                'product_size'  => $request->product_size?$request->product_size:'R',
                'product_color' => $request->product_color?$request->product_color:'R',
                'customer_id'   => $customer_id,
                'quantity'      => $request->quantity?$request->quantity:1,
            ]);
        }
        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product
        ]);
    }
    public function cartincrement($product_id,$product_size)
    {
       
        $customer_id = getallheaders()['customer_id'];
        $item = Cart::where(['product_size'=>$product_size,'product_id'=>$product_id,'customer_id'=>$customer_id]);
        if ($item->count()) {
            $item->increment('quantity');
            $item = $item->first();
        }
        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product,
            'id' => $item->id,
        ]);
    }
    public function cartdecrement($product_id,$product_size)
    {
        $customer_id = getallheaders()['customer_id'];
        $item = Cart::where(['product_size'=>$product_size,'product_id'=>$product_id,'customer_id'=>$customer_id]);
        if ($item->count()) {
            $item->decrement('quantity');
            $item = $item->first();
        }
        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product,
            'id' => $item->id,
        ]);
    }
    public function cartdestroy($product_id,$product_size)
    {
        
        $customer_id = getallheaders()['customer_id'];
        $item =  Cart::where(['product_size'=>$product_size,'product_id'=>$product_id,'customer_id'=>$customer_id])->delete();
        return response(['status'=>'success','message'=>'cart item delete']);
    }
    public function cartEmpty(Request $request)
    {
        $customer_id = getallheaders()['customer_id'];
        $productcarts = Cart::where('customer_id', $customer_id)->get();
        foreach ($productcarts as $cartitem) {
            // cart delete
            Cart::where(['customer_id' => $customer_id, 'product_id' => $cartitem->product_id])->delete();
        }
        return response(['status'=>'success','message'=>'cart item cleared']);
    }
    
    // Wishlist  manage
    public function wishshow()
    {
         
        $customer_id = getallheaders()['customer_id'];
        return Wishlist::with('product','product.image')
                ->orderBy('created_at', 'desc')
                ->where('customer_id',$customer_id)
                ->get();
    }
    
    public function wishstore(Request $request)
    {
        $customer_id = getallheaders()['customer_id'];
        $item = Wishlist::where(['product_id'=> $request->product_id, 'customer_id'=>$customer_id]);
        if ($item->count()) {
            $item->increment('quantity');
            $item = $item->first();
        }else{
            $item = Wishlist::forceCreate([
                'product_id' => $request->product_id,
                'customer_id' => $customer_id,
                'quantity' => 1,
            ]);
        }
        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product,
            'image' => $item->product->image
        ]);
    }
    
    public function wishdestroy($productId)
    {
        $item = Wishlist::where('product_id', $productId)->delete();
        return response(null, 200);
    }
    

     // Compare  manage
    public function compareshow()
    {
        return Compare::with('product','product.image')
                ->orderBy('created_at', 'desc')
                ->get();
    }
    public function comparestore(Request $request)
    {
        $item = Compare::where('product_id', $request->product_id);
        if ($item->count()) {
            $item->increment('quantity');
            $item = $item->first();
        }else{
            $item = Compare::forceCreate([
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }
        return response()->json([
            'quantity' => $item->quantity,
            'product' => $item->product
        ]);
    }
    public function comparedestroy($productId)
    {
        $item = Compare::where('product_id', $productId)->delete();
        return response(null, 200);
    }

}
