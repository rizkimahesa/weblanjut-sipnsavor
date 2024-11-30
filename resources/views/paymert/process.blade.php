<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Process</title>
</head>
<body>
    <h3>Payment for Order #{{ $order_id }}</h3>
    <p>Total Amount: Rp{{ number_format($amount, 0, ',', '.') }}</p>
    <!-- Di sini kamu bisa menambahkan QR code atau integrasi pembayaran -->
</body>
</html>
