<?php 
require_once __DIR__ . '/../Core/Controller.php'; // Adjust the path if needed
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Warga.php';

    class AuthController extends Controller {

        public function login() {
            // kalau sudah login, jangan buka halaman login lagi
            if (isset($_SESSION['user'])) {
                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            }

            // pakai layout auth (tanpa sidebar/navbar)
            $this->view('auth/login', [], 'auth');
        }

        public function doLogin() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                $_SESSION['error'] = 'Username dan password wajib diisi';
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }

            // cek admin
            // ================= ADMIN =================
            $userModel = new User();
            $user = $userModel->findByUsername($username);
            if ($user) {
                // CASE 1: password sudah di-hash
                if (password_verify($password, $user['Password'])) {
                    $_SESSION['user'] = [
                        'id'   => $user['Id'],
                        'nama' => $user['Nama_pengguna'],
                        'rolesId' => $user['RolesId'],
                        'roleName' => $user['RoleName']
                    ];
                    $_SESSION['info'] = 'Selamat Datang ' . $user['Nama_pengguna'];
                    header('Location: ' . BASE_URL . '/dashboard');
                    exit;
                }
            }
            // CASE 2: password masih plaintext → upgrade
            if ($password === $user['Password']) {

                $hash = password_hash($password, PASSWORD_DEFAULT);
                $userModel->updatePassword($user['Id'], $hash);
                $_SESSION['user'] = [
                    'id'   => $user['Id'],
                    'nama' => $user['Nama_pengguna'],
                    'rolesId' => $user['RolesId'],
                    'roleName' => $user['RoleName']
                ];

                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            }

            // // ================= WARGA =================
            // $wargaModel = new Warga();
            // $warga = $wargaModel->findByUsername($username);

            // if ($warga) {

            //     if (password_verify($password, $warga['password'])) {

            //         $_SESSION['user'] = [
            //             'id'   => $warga['id'],
            //             'nama' => $warga['nama_warga'],
            //             'role' => 'warga'
            //         ];

            //         header('Location: ' . BASE_URL . '/dashboard');
            //         exit;
            //     }

            //     if ($password === $warga['password']) {

            //         $hash = password_hash($password, PASSWORD_DEFAULT);
            //         $wargaModel->updatePassword($warga['id'], $hash);

            //         $_SESSION['user'] = [
            //             'id'   => $warga['id'],
            //             'nama' => $warga['nama_warga'],
            //             'role' => 'warga'
            //         ];

            //         header('Location: ' . BASE_URL . '/dashboard');
            //         exit;
            //     }
            // }

            // $userModel = new User();
            // $user = $userModel->findByUsername($username);

            // if (!$user || !password_verify($password, $user['password'])) {
            //     $_SESSION['error'] = 'Username atau password salah';
            //     header('Location: /auth/login');
            //     exit;
            // }

            // set session (VERSI MVC)
            // $_SESSION['user'] = [
            //     'id'       => $user['id'],
            //     'username' => $user['username'],
            //     'nama'     => $user['nama'],
            //     'role'     => $user['level']
            // ];

            $_SESSION['error'] = 'Username atau password salah';
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        public function logout() {
            session_start();
            session_destroy();
            header('Location: ' . BASE_URL . '/auth/login');
        }
    }

?>