<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pesanan</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Riwayat Pesanan</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">Back to Dashboard</a>
        <!-- Tabel Riwayat Pesanan -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nama Makanan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pesan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->menu->nama }}</td> <!-- Menampilkan nama makanan -->
                        <td>{{ $order->quantity }}</td> <!-- Menampilkan jumlah pesanan -->
                        <td>Rp{{ number_format($order->menu->harga * $order->quantity, 0, ',', '.') }}</td> <!-- Harga total -->
                        <td>{{ $order->user->name }}</td> <!-- Menampilkan nama pelanggan -->
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td> <!-- Menampilkan tanggal pesanan -->
                        <td>{{ ucfirst($order->status) }}</td> <!-- Menampilkan status pesanan -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Skrip JavaScript Bootstrap (Optional, jika kamu membutuhkan interaksi tambahan) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
