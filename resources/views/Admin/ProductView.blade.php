@extends('Admin.layouts.app')
@section('content')

<body class="bg-light">

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">🛍️ All Products</h2>
            <a href="{{ url('admin/cart') }}" class="btn btn-outline-primary">🛒 View Cart</a>
        </div>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="https://via.placeholder.com/400x200?text=Product+Image" class="card-img-top" alt="Product Image">

                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $product->product_name }}</h5>
                            <p class="card-text text-muted">{{ $product->description }}</p>
                            <hr>
                            <p><strong>Price:</strong> ₹{{ $product->price }}</p>
                            <p><strong>Discount:</strong> {{ $product->discount }}%</p>
                            <p>
                                <strong>Final Price:</strong> 
                                <span class="text-danger">
                                    ₹{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}
                                </span>
                            </p>
                        </div>

                        <div class="card-footer bg-transparent border-top-0 text-center">
                            <button class="btn btn-success w-100" onclick="addToCart({{ $product->id }})">🛒 Add To Cart</button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>
    </div>

    <!-- Toast Container -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
        <div id="toast" class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    Product added to cart!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function addToCart(id) {
            $.ajax({
                url: '/admin/add-to-cart',
                method: 'POST',
                data: { id: id },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if (res.status === 'success') {
                        showToast();
                        setTimeout(() => {
                            window.location.href = res.redirect_url;
                        }, 1000);
                    } else {
                        alert(res.message);
                    }
                }
            });
        }

        function showToast() {
            const toast = new bootstrap.Toast(document.getElementById('toast'));
            toast.show();
        }
    </script>

</body>
@endsection
