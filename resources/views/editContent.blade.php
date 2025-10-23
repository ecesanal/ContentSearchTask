<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İçerik Düzenle</title>
    <style>
        body { font-family: Arial; background: #f4f7fa; margin:0; }
        .container { max-width: 600px; margin: 40px auto; padding: 20px; background: white; border-radius: 10px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>İçerik Düzenle</h2>
        <form method="POST" action="{{ route('admin.updateContent', $content->id) }}">
            @csrf
            <input type="text" name="title" value="{{ $content->title }}" required>
            <textarea name="content" rows="6" required>{{ $content->content }}</textarea>
            <button type="submit">Güncelle</button>
        </form>
    </div>
</body>
</html>
