<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;


class ProductController extends Controller
{

 //blade file cart me add kne k liye
    public function Create(){

        return view('Admin.CreateProduct');
    }
//store code
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);
    
        $product = Product::create($validated);
    
        return response()->json(['message' => 'Product added successfully!', 'product' => $product]);
    }

 //show all product

    public function productView()
    {
                   
       
        $products  =  Product::all();

        return view('Admin.ProductView',compact('products'));
             
    }



    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product  =  Product::find($id);    
        if(!$product){
            return response()->json(['message'=>'Product Not Found']);
        }      
    // Get the cart array from session, default to an empty array if it doesn't exist
        
        $cart = session()->get('cart',[]);
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                'name'=>$product->name,
                'price'=>$product->price,
                'discount'=>$product->discount,
                'final_price'=>$product->price-($product->price * $product->discount/100),
                'quantity'=>1
            ];
        }

        session()->put('cart',$cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Item Added To Cart',
            'redirect_url' => route('admin.cart')
        ]);
             
    }

    // view to cart

    public function cartView(){

        $cart = session()->get('cart',[]);
        return view('Admin.CartView',compact('cart'));
    }

   public function removeItem(Request $request){
    $cart = session()->get('cart',[]);
    if(isset($cart[$request->id])){
       unset($cart[$request->id]);
      Session()->put('cart',$cart);
    }
  //  return response()->json(['message','item Remove Successfully']);
    return response()->json([
        'message' => 'Item removed from cart!'
    ]);
   }

}



