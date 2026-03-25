<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .box {
            text-align: center;
            background: rgba(255,255,255,0.1);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,.3);
            backdrop-filter: blur(10px);
        }
        h1 {
            font-size: 96px;
            margin: 0;
        }
        p {
            font-size: 18px;
            margin: 15px 0 30px;
        }
        a {
            display: inline-block;
            padding: 12px 28px;
            background: #fff;
            color: #764ba2;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s;
        }
        a:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>404</h1>
        <p>Ups! Halaman yang kamu cari nyasar ke dimensi lain 🚀</p>
        <a href="<?=  BASE_URL ?>/dashboard">Balik ke Dashboard</a>
    </div>
</body>
</html>
