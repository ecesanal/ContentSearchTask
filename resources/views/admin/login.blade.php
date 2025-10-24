<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
    <style>
        body { font-family: 'Segoe UI',sans-serif; background:#f4f7fa; margin:0; }
        .wrap { max-width:480px; margin:60px auto; background:#fff; padding:32px; border-radius:16px; box-shadow: 0 8px 20px rgba(0,0,0,.1); }
        h1 { margin:0 0 16px; text-align:center; color:#333; }
        form { display:flex; flex-direction:column; gap:12px; }
        input { padding:12px 14px; border:2px solid #ddd; border-radius:10px; font-size:16px; }
        input:focus { border-color:#007bff; outline:none; }
        button { padding:12px 16px; background:#007bff; color:#fff; border:none; border-radius:10px; cursor:pointer; font-size:16px; }
        button:hover { background:#0056b3; }
        .alert { margin-bottom:10px; padding:10px 12px; border-radius:10px; }
        .alert.error { background:#fde8e8; color:#b42318; }
        .alert.success { background:#e7f6ec; color:#18794e; }
        .muted { text-align:center; margin-top:10px; color:#666; }
    </style>
</head>
<body>
<div class="wrap">
    <h1>Admin Giriş</h1>

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <input type="email" name="email" placeholder="E-posta" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit">Giriş Yap</button>
    </form>

    <div class="muted">
        <a href="{{ route('index') }}">← Aramaya geri dön</a>
    </div>
</div>
</body>
</html>
