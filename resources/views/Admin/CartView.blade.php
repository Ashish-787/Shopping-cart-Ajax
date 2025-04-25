<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ✅ Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            padding: 50px 20px;
        }
        table th, table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="container cart-container">

    <h2 class="text-center mb-4">🛒 Your Cart</h2>

    <div class="mb-3">
        <a href="{{ route('productView') }}" class="btn btn-outline-primary">← Back to Products</a>
    </div>

    @php
        $cart = session('cart', []);
        $total = 0;
    @endphp

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Original Price</th>
                        <th>Discount %</th>
                        <th>Final Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cart as $id => $item)
                    @php
                        $subtotal = $item['final_price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item['product_name'] ?? 'N/A' }}</td>
                        <td>₹{{ $item['price'] ?? 0 }}</td>
                        <td>{{ $item['discount'] ?? 0 }}%</td>
                        <td>₹{{ $item['final_price'] ?? 0 }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-sm btn-outline-secondary me-1" onclick="updateQuantity({{ $id }}, 'decrease')">−</button>
                                <span class="mx-2">{{ $item['quantity'] }}</span>
                                <button class="btn btn-sm btn-outline-secondary ms-1" onclick="updateQuantity({{ $id }}, 'increase')">+</button>
                            </div>
                        </td>
                        <td>₹{{ number_format($subtotal, 2) }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="removeItem({{ $id }})">Remove</button>
                        </td>
                    </tr>
                @endforeach

                <tr class="table-info fw-bold">
                    <td colspan="5" class="text-end">Total</td>
                    <td colspan="2">₹{{ number_format($total, 2) }}</td>
                </tr>
                </tbody>
            </table>

            <form action="{{ route('place.order') }}" method="POST">

        
                @csrf
                <input type="hidden" name="order_id" value="{{ $orderId }}">
                <br>
                <button type="submit">✅ Place Order</button>
            </form>
        </div>
    @else
        <div class="alert alert-info text-center mt-4">
            Your cart is empty!
        </div>
    @endif
</div>

<!-- ✅ jQuery & Bootstrap Bundle -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function removeItem(id) {
        $.ajax({
            url: '/admin/remove-cart',
            method: 'POST',
            data: { id: id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                alert(res.message);
                location.reload();
            }
        });
    }
</script>


<script>
    function updateQuantity(id, action) {
        $.ajax({
            url: '/admin/update-cart-quantity',
            method: 'POST',
            data: {
                id: id,
                action: action
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                location.reload(); // Refresh to reflect updated quantity
            },
            error: function(err) {
                alert("Something went wrong!");
            }
        });
    }
</script>


</body>
</html>
