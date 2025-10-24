<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İçerik Arama</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7fa; margin:0; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,.1); }
        h1 { text-align: center; color:#333; }
        form { display:flex; gap:10px; flex-wrap:wrap; justify-content:center; margin-bottom: 20px; }
        input[type=text], select { padding:12px 15px; font-size:16px; border:2px solid #ddd; border-radius:10px; outline:none; }
        input[type=text]:focus, select:focus { border-color:#007bff; }
        button { padding:12px 20px; background:#007bff; color:#fff; border:none; border-radius:10px; cursor:pointer; }
        button:hover { background:#0056b3; }
        .card { background:#f9fafc; border-left:4px solid #007bff; border-radius:10px; margin-bottom:20px; padding:20px; }
        .card h3 { margin:0; color:#007bff; }
        .card p { color:#555; margin-top:6px; line-height:1.5; }
        .muted { color:#888; font-size: 13px; }
        .admin-link { text-align:center; margin-top: 30px; }
        .admin-link a { color:#007bff; text-decoration:none; font-weight:600; }
        .admin-link a:hover { text-decoration:underline; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔍 İçerik Arama</h1>

    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Bir şeyler ara...">
        <select name="lang">
            <option value="">Dil Seçiniz</option>
            @foreach($languages as $lng)
                <option value="{{ $lng->id }}" {{ (isset($langId) && $langId == $lng->id) ? 'selected' : '' }}>
                    {{ $lng->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Ara</button>
    </form>

    <div class="result">
        @php use Illuminate\Support\Str; @endphp
        @if(isset($results) && $results->count())
            @foreach($results as $item)
                <div class="card">
                    <h3>{{ $item->title }}</h3>
                    <p>{{ Str::limit($item->content, 220) }}</p>
                    <div class="muted">
                        {{ optional($item->language)->name }} • {{ $item->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>
            @endforeach
        @elseif(request()->has('lang'))
            <p class="muted" style="text-align:center">Bu dilde sonuç bulunamadı.</p>
        @endif
    </div>

    <div class="admin-link">
        <p>👤 Admin misiniz? <a href="{{ route('admin.login') }}">Giriş yapın</a></p>
    </div>
</div>
</body>
</html>
