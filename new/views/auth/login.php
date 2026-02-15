<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login | UMKM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link ke AdminLTE dan FontAwesome -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/adminlte.min.css">

    <!-- CSS Custom untuk Desain Modern -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        /* Efek Partikel untuk Background yang Lebih Jelas dan Dinamis */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 10%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
            animation: floatEnhanced 8s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes floatEnhanced {
            0% { transform: translateY(0px) rotate(0deg) scale(1); }
            25% { transform: translateY(-30px) rotate(90deg) scale(1.1); }
            50% { transform: translateY(-10px) rotate(180deg) scale(0.9); }
            75% { transform: translateY(-40px) rotate(270deg) scale(1.05); }
            100% { transform: translateY(0px) rotate(360deg) scale(1); }
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-in-out;
            position: relative;
            z-index: 1;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .login-card-body {
            padding: 40px 30px;
            text-align: center;
        }

        .logo-section img {
            width: 100px;
            height: auto;
            margin-bottom: 15px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .logo-section h5 {
            color: #333;
            font-weight: 700;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px 15px 15px 50px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .input-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
            background: #fff;
        }

        .input-group .input-group-text {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            z-index: 10;
        }

        .btn-login {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.4);
        }

        .alert {
            border-radius: 10px;
            margin-top: 20px;
            animation: slideIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="logo-section">
                    <img src="<?= BASE_URL ?>/assets/img/logo.png" alt="Logo UMKM">
                    <h5><b><?= APP_NAME ?></b></h5>
                </div>

                <form method="POST" action="<?= BASE_URL ?>/auth/login">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="username" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="current-password" required>
                    </div>

                    <button type="submit" class="btn btn-login">Login</button>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger mt-3">
                            <i class="fas fa-exclamation-triangle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk animasi tambahan jika diperlukan -->
    <script src="<?= BASE_URL ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/adminlte.min.js"></script>
</body>
</html>