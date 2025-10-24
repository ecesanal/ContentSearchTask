<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <style>
        body { font-family: Arial; background:#f5f7fa; margin:0; }
        .header { background:#007bff; color:#fff; padding:20px; position:relative; }
        .header h1 { margin:0; text-align:center; }
        .logout { position:absolute; right:20px; top:20px; color:#fff; text-decoration:none; font-weight:600; }
        .logout:hover { text-decoration:underline; }
        .container { max-width: 1100px; margin: 30px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,.08); }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #e5e7eb; padding:10px; text-align:left; }
        th { background:#f3f4f6; }
        .actions { display:flex; gap:8px; align-items:center; }
        .btn { padding:6px 10px; border-radius:6px; text-decoration:none; font-size:14px; }
        .btn-edit { background:#2563eb; color:#fff; }
        .btn-del { background:#dc2626; color:#fff; border:none; cursor:pointer; }
        .flash { margin-bottom:12px; padding:10px; border-radius:8px; }
        .flash-success { background:#e7f6ec; color:#18794e; }
        .flash-error { background:#fde8e8; color:#b42318; }
    </style>
</head>
<body>
<div class="header">
    <h1>Admin Paneli</h1>
    <a class="logout" href="{{ route('admin.logout') }}">Çıkış Yap</a>
</div>

<div class="container">
    @if(session('success')) <div class="flash flash-success">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="flash flash-error">{{ session('error') }}</div>   @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Başlık</th>
                <th>Dil</th>
                <th>Oluşturan</th>
                <th>Oluşturma</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
        @php use Illuminate\Support\Str; @endphp
        @forelse($contents as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td title="{{ $c->title }}">{{ Str::limit($c->title, 50) }}</td>
                <td>{{ optional($c->language)->name ?? '—' }}</td>
                <td>{{ optional($c->user)->name ?? '—' }}</td>
                <td>{{ $c->created_at->format('d.m.Y H:i') }}</td>
                <td class="actions">
                    <a class="btn btn-edit" href="{{ route('admin.editContent', $c->id) }}">Düzenle</a>
                    <form method="POST" action="{{ route('admin.deleteContent', $c->id) }}" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-del">Sil</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">İçerik bulunamadı.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
