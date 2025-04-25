<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Order;


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
                'product_name'=>$product->product_name,
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
        $orderId = 'ORD-' . strtoupper(Str::random(6));
        return view('Admin.CartView',compact('cart','orderId'));
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


    public function updateQuantity(Request $request)
   {
    $id = $request->input('id');
    $action = $request->input('action');

    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        if ($action == 'increase') {
            $cart[$id]['quantity'] += 1;
        } elseif ($action == 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity'] -= 1;
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Quantity updated']);
    }

    return response()->json(['message' => 'Item not found'], 404);
   }


   // Placing an Order (Controller Code)


        public function placeOrder(Request $request)
        {
                // Create a new order
                $order = Order::create([
                    'order_id' => 'ORD-' . strtoupper(uniqid()),
                    'total' => $request->total,
                    'status' => 'pending', // Can be changed as per the status
                    'user_id' => auth()->user()->id, // If you're using authenticated users
                ]);

                // Get the cart from the session
                $cart = session('cart', []);

                // Add products to the order
                foreach ($cart as $id => $item) {
                    $order->products()->attach($id, [
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['final_price'] * $item['quantity']
                    ]);
                }

                // Clear the cart after placing the order
                session()->forget('cart');

              //  return response()->json(['status' => 'success', 'message' => 'Order Placed', 'order_id' => $order->order_id]);
         
              return redirect()->route('order.success')->with('order_id', $order->order_id); 
        }


         public function indexcheckout()
         {
             $cart = session('cart', []);
             $total = 0;
         
             foreach ($cart as $item) {
                 $total += $item['final_price'] * $item['quantity'];
             }
         
             $orderId = 'ORD-' . strtoupper(Str::random(6)); // Generate random order ID
         
             return view('Admin.Checkout', compact('cart', 'total', 'orderId')); // pass $orderId
         }

}



