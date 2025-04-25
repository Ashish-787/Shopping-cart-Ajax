<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #fff3e0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            padding: 30px;
        }

        .emoji {
            font-size: 80px;
        }

        .order-id {
            font-size: 20px;
            color: #555;
        }

        .btn-custom {
            background-color: #00bcd4;
            border: none;
            padding: 10px 30px;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #0097a7;
        }
    </style>
</head>
<body>
    <div class="card text-center">
        <div class="emoji">🎉</div>
        <h2 class="text-success mb-3">Thank You for Your Order!</h2>
        <p class="order-id">🧾 Your Order ID: <strong>{{ session('order_id') }}</strong></p>
        <p>We've received your order and are processing it. You'll receive a confirmation email shortly.</p>
        <a href="{{ route('productView') }}" class="btn btn-custom mt-4">🔙 Back to Shopping</a>
    </div>
</body>
</html>
