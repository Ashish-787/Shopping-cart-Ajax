<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
</head>
<body class="bg-light">

        <div class="container my-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h2>🛍️ All Products</h2>
              <a href="{{url('admin/cart')}}" class="btn btn-primary">🛒 View Cart</a>
            </div>
            
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->product_name}}</h5>
                                <p class="card-text">{{$product->description }}</p> 
                                <p><span>Price:</span> ₹{{$product->price}}</p>
                                <p><span>Discount:</span> {{$product->discount}}%</p>
                                <p><span>Final Price:</span> ₹{{$product->price - ($product->price * $product->discount/100)}}</p>
                               <button class="btn btn-success" onclick="addToCart({{$product->id}})">Add To Cart</button>
                            
                            </div>

                        </div>
                         
                    </div>  
                  
                @endforeach
            </div>
        

         </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     
       <script>

            function addToCart(id){
                $.ajax({
                     url:'/admin/add-to-cart',
                     method:'Post',
                     data:{id:id},
                     headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                     },
                     success: function(res){
                            if(res.status === 'success'){
                                // Redirect to cart page
                                window.location.href = res.redirect_url;
                            } else {
                                alert(res.message);
                            }
                        }
                });
            }

        </script>
      

    
</body>
</html>