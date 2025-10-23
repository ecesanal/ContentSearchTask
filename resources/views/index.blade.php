<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f7fa;
            margin: 0;
        }

        .sidebar {
            width: 220px;
            background: #007bff;
            color: white;
            height: 100vh;
            position: fixed;
            padding: 30px 15px;
        }

        .sidebar h2 {
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            margin: 8px 0;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.2);
        }

        .content {
            margin-left: 240px;
            padding: 40px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>⚙️ Admin Paneli</h2>
    <a href="{{ route('admin.contents') }}">📄 İçerikler</a>
    <a href="{{ route('admin.languages') }}">🌐 Diller</a>
    <a href="{{ route('home') }}">🏠 Siteye Dön</a>
</div>

<div class="content">
    <h1>Hoş geldin, Admin!</h1>
    <p>Buradan içerikleri ve dilleri yönetebilirsin.</p>
    <a href="{{ route('admin.logout') }}">🚪 Çıkış Yap</a>

</div>
</body>
</html>
