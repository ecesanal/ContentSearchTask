<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi</title>
    <style>
        body { font-family: Arial; background: #f4f7fa; }
        .login-container {
            max-width: 400px; margin: 100px auto; padding: 30px;
            background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; }
        button { width: 100%; padding: 12px; border: none; border-radius: 5px; background: #007bff; color: white; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Admin Girişi</h2>
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    
    <form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Şifre" required>
    <button type="submit">Giriş Yap</button>
</form>

</div>
</body>
</html>
