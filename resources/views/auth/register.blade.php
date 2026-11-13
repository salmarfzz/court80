<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Court80</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f0; font-family: monospace; }
        .brutal-card { border: 3px solid #000; box-shadow: 4px 4px 0px #000; background: #fff; }
        .brutal-btn { border: 3px solid #000; box-shadow: 3px 3px 0px #000; font-weight: bold; transition: 0.1s; }
        .brutal-btn:active { transform: translate(2px, 2px); box-shadow: 1px 1px 0px #000; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="card brutal-card p-4" style="width: 400px;">
        <h3 class="fw-bold mb-3 text-center">DAFTAR AKUN</h3>

        @if($errors->any())
            <div class="alert alert-danger border border-dark p-2 fs-7 mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control border-dark" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control border-dark" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control border-dark" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control border-dark" required>
            </div>
            <button type="submit" class="btn btn-warning w-100 brutal-btn py-2">DAFTAR</button>
        </form>
        <div class="text-center mt-3">
            <a href="/login" class="text-decoration-none text-dark fw-bold">Sudah punya akun? Login</a>
        </div>
    </div>

</body>
</html>