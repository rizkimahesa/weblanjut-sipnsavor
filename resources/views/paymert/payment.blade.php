<!-- resources/views/paymert/payment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-success">Payment Page</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="alert alert-info mt-4">
            <p>Pesanan Anda telah berhasil dibuat. Harap selesaikan pembayaran untuk mengonfirmasi pesanan Anda.</p>
        </div>

        <!-- Display QR code for payment -->
        <div class="text-center mt-5">
            <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode($paymentUrl) }}&size=200x200" alt="QR Code" />
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
