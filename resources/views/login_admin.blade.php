<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - BUMDes Spirit Mejabar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('/images/bg-login.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .form-control {
            height: 45px;
            font-size: 16px;
        }

        .btn-primary {
            width: 100%;
            font-size: 18px;
        }

        .text-link {
            text-decoration: none;
            color: #007bff;
        }

        .text-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        @if (session('success'))
            <div class="alert alert-success text-center" style="margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-center mb-3">MASUK</h3>
        <form action="{{ route('login.admin') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="#" class="text-link">Lupa Password?</a>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Masuk</button>
        </form>
        <div class="text-center mt-3">
            <small>Bukan Pengurus? <a href="{{ route('warga.login') }}" class="text-link">Masuk Sebagai Warga</a></small>
        </div>
    </div>

</body>

</html>