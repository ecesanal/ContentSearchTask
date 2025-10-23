<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İçerik Arama & Admin Girişi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        h2 { margin-top: 40px; }
        form { display: flex; justify-content: center; margin-bottom: 20px; gap: 10px; flex-wrap: wrap; }
        input[type="text"], input[type="password"], select {
            padding: 12px 15px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
        }
        input[type="text"]:focus, input[type="password"]:focus, select:focus {
            border-color: #007bff;
        }
        button {
            padding: 12px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }
        button:hover { background: #0056b3; }
        .result, .admin-section { margin-top: 30px; }
        .card {
            background: #f9fafc;
            border-left: 4px solid #007bff;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }
        .card h3 { margin: 0; color: #007bff; }
        .card p { color: #555; margin-top: 8px; line-height: 1.5; }
        .card small { color: #888; }
        .no-result, .login-error {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
        .login-error { color: red; }
        .loading { text-align: center; font-size: 18px; color: #007bff; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h1>🔍 İçerik Arama</h1>

    <form action="{{ route('search') }}" method="GET" onsubmit="showLoading()">
        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Bir şeyler ara...">
        <select name="lang" required>
            <option value="">Dil Seçiniz</option>
            <option value="tr" {{ (request('lang') == 'tr') ? 'selected' : '' }}>Türkçe</option>
            <option value="en" {{ (request('lang') == 'en') ? 'selected' : '' }}>İngilizce</option>
            <option value="es" {{ (request('lang') == 'es') ? 'selected' : '' }}>İspanyolca</option>
        </select>

        <button type="submit">Ara</button>
    </form>

    <div id="loading" class="loading" style="display: none;">Aranıyor...</div>

    <div class="result">
        @if(isset($results) && count($results) > 0)
            @foreach($results as $result)
                <div class="card">
                    <h3>{{ $result->title }}</h3>
                    <p>{{ Str::limit($result->content, 200) }}</p>
                    <small>{{ $result->created_at->format('d.m.Y H:i') }} - Dil: {{ strtoupper($result->language) }}</small>
                </div>
            @endforeach
        @elseif(isset($query))
            <div class="no-result">Sonuç bulunamadı 😕</div>
        @endif
    </div>

    <h2>Admin Girişi</h2>
    <div class="admin-section">
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>

        @if(session('error'))
            <div class="login-error">{{ session('error') }}</div>
        @endif
    </div>
</div>

<script>
    function showLoading() {
        document.getElementById("loading").style.display = "block";
    }
</script>

</body>
</html>
