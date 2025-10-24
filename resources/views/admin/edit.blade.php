<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İçerik Düzenle</title>
    <style>
        body { font-family: Arial; background:#f5f7fa; margin:0; }
        .wrap { max-width: 800px; margin: 40px auto; background:#fff; padding:24px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,.08); }
        label { display:block; margin:10px 0 6px; font-weight:600; }
        input[type=text], textarea, select { width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; }
        textarea { min-height: 200px; resize: vertical; }
        .row { display:flex; gap:12px; }
        .row > div { flex: 1; }
        .actions { margin-top: 16px; display:flex; gap:10px; }
        .btn { padding:10px 14px; border:none; border-radius:8px; cursor:pointer; }
        .btn-primary { background:#2563eb; color:#fff; }
        .btn-muted { background:#e5e7eb; color:#111827; text-decoration:none; padding:10px 14px; border-radius:8px; }
    </style>
</head>
<body>
<div class="wrap">
    <h2>İçerik Düzenle</h2>

    <form method="POST" action="{{ route('admin.updateContent', $content->id) }}">
        @csrf
        <div class="row">
            <div>
                <label>Başlık</label>
                <input type="text" name="title" value="{{ old('title', $content->title) }}" required>
            </div>
            <div>
                <label>Dil</label>
                <select name="language_id" required>
                    @foreach($languages as $lng)
                        <option value="{{ $lng->id }}" {{ $content->language_id == $lng->id ? 'selected' : '' }}>
                            {{ $lng->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <label>İçerik</label>
        <textarea name="content" required>{{ old('content', $content->content) }}</textarea>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-muted">İptal</a>
        </div>
    </form>
</div>
</body>
</html>
