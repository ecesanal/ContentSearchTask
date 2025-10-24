<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni İçerik Ekle</title>
    <style>
        body { font-family:'Segoe UI', sans-serif; background:#f4f7fa; margin:0; padding:0; }
        .container { max-width:600px; margin:50px auto; background:white; padding:30px; border-radius:20px; box-shadow:0 8px 20px rgba(0,0,0,0.1); }
        h2 { color:#007bff; text-align:center; margin-bottom:20px; }
        input, textarea { width:100%; padding:12px 15px; margin-bottom:15px; border:2px solid #ddd; border-radius:10px; outline:none; transition:0.3s; }
        input:focus, textarea:focus { border-color:#007bff; }
        button { width:100%; padding:12px; background:#007bff; color:white; border:none; border-radius:10px; cursor:pointer; font-size:16px; transition:0.3s; }
        button:hover { background:#0056b3; }
    </style>
</head>
<body>
<div class="container">
    <h2>Yeni İçerik Ekle</h2>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Başlık" required>
        <textarea name="content" rows="6" placeholder="İçerik" required></textarea>
        <button type="submit">Kaydet</button>
    </form>
</div>
</body>
</html>
