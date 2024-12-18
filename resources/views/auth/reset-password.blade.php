<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <h2 class="text-center text-success mb-4">Reset Password</h2>

            <form method="POST" action="{{ route('password.reset') }}">
    @csrf
    <!-- Hidden Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Masukkan Email Anda</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <!-- New Password -->
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <p>Belum Memiliki Akun?<a href="{{ route('register') }}" class="text-decoration-none"> Register</a></p>
    <a href="{{ route('login') }}" class="text-decoration-none">Kembali</a></p>
    <button type="submit" class="btn btn-success w-100">Reset Password</button>
</form>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
