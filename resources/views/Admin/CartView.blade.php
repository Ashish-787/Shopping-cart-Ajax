<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>🛒 Your Cart</h2>
    <a href="/">← Back to Products</a>

    @php $total = 0; @endphp
<!--  -->
    @if(count($cart) > 0)
        <table border="1" cellpadding="10">
            <tr>
                <th>Product</th>
                <th>Original Price</th>
                <th>Discount %</th>
                <th>Final Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>

            @foreach($cart as $id => $item)
                @php
                    $subtotal = $item['final_price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>₹{{ $item['price'] }}</td>
                    <td>{{ $item['discount'] }}%</td>
                    <td>₹{{ $item['final_price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>₹{{ $subtotal }}</td>
                    <td><button onclick="removeItem({{ $id }})">Remove</button></td>
                </tr>
            @endforeach

            <tr>
                <td colspan="5"><strong>Total</strong></td>
                <td colspan="2"><strong>₹{{ $total }}</strong></td>
            </tr>
        </table>
    @else
        <p>Your cart is empty!</p>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function removeItem(id) {
            $.ajax({
                url: '/admin/remove-cart',
                method: 'POST',
                data: { id: id },
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
</body>
</html>
