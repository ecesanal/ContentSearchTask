<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <style>
        body { font-family: Arial; background: #f5f7fa; margin: 0; }
        .header { background: #007bff; color: white; padding: 20px; text-align: center; position: relative; }
        .logout { position: absolute; right: 20px; top: 20px; color: white; text-decoration: none; font-weight: bold; }
        .logout:hover { text-decoration: underline; }
        .container { max-width: 1000px; margin: 40px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f0f0f0; }
        button { background: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #c82333; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Paneli</h1>
        <a class="logout" href="{{ route('admin.logout') }}">Çıkış Yap</a>
    </div>

    <div class="container">
        <h2>İçerikler</h2>

        {{-- Başarı ve hata mesajları --}}
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>İçerik</th>
                    <th>Kullanıcı</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contents as $content)
                    <tr>
                        <td>{{ $content->id }}</td>
                        <td>{{ $content->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($content->content, 50) }}</td>
                        <td>{{ $content->user ? $content->user->name : 'Sistemde kayıtlı değil' }}</td>
                        <td>
                            <a href="{{ route('admin.editContent', $content->id) }}">Düzenle</a> |
                            <form method="POST" action="{{ route('admin.deleteContent', $content->id) }}" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Hiç içerik bulunamadı.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
